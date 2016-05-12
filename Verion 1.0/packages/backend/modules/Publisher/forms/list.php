<?php
class PublisherForm extends Form
{
	function PublisherForm()
	{
		Form::Form('PublisherForm');
		$this->link_css('skins/default/css/cms.css');
	}	
	function save()
	{
		if(Url::get('ids'))
		{
			DB::update('news',array('publish'=>'0'),'id in ('.Url::get('ids').')');
			DB::update('news',array('front_page'=>'0'),'id in ('.Url::get('ids').')');
		}	
		require_once 'packages/backend/includes/php/nguoi_choi.php';
		require_once 'packages/backend/includes/php/igold.php';
		foreach($_REQUEST as $key=>$value)
		{			
			if(preg_match('/status_([0-9]+)/',$key,$match))
			{
				DB::update_id('news',array('status'=>$value),$match[1]); 						
			}
			if(preg_match('/front_page_([0-9]+)/',$key,$match1))
			{				
				DB::update_id('news',array('front_page'=>1),$match1[1]); 						
			}
			if(preg_match('/publish_([0-9]+)/',$key,$match2))
			{	
				if($match2[1] and $news = DB::select('news','id='.$match2[1])){
					DB::update_id('news',array('publish'=>1),$match2[1]);
					if(!$news['got_igold'] and $news['author'] and Url::get('category_id') <> 294){//294: muc cam nhan
						$igold = get_igold_by_level($news['user_id']);
						DB::update('news',array('got_igold'=>$igold),'id='.$news['id']);
						iGold::receive_igold($news['user_id'],$igold,'Đăng tin bài');
						$this->send_email_to_user($news['user_id'],$igold);
					}
				}
			}
		}
	}
	function send_email_to_user($user_id,$igold){
		$party = DB::fetch('select email,user_id,full_name from party where user_id="'.$user_id.'"');
		if($party['email']){
			$content = file_get_contents('cache/email_template/duyet_bai_viet.html');
			$data = array(
				'[[|full_name|]]',
				'[[|igold|]]',
				'[[|date|]]'
			);
			$replace = array(
				$party['full_name'],
				$igold,
				date('d/m/Y')
			);
			$content = str_replace($data,$replace,$content);
			$subject = 'Duyệt bài viết - Sieusaongoaihang.vn';
			System::send_mail('sieusaogiaingoaihang@gmail.com',$party['email'],$subject,$content);
		}
	}
	function delete()
	{
		if(isset($_REQUEST['selected_ids']) and  count($_REQUEST['selected_ids'])>0)
		{
			foreach($_REQUEST['selected_ids'] as $key)
			{
				if($item = DB::exists_id('news',$key))
				{
					save_recycle_bin('news',$item);
					DB::delete_id('news',$key);
					save_log($key);
				}	
			}
		}
	}
	function on_submit()
	{
		if(Url::get('cmd'))
		{
			switch(Url::get('cmd'))
			{
				case 'delete':
					$this->delete();
					break;	
				default:
					$this->save();
					break;	
			}
		}
		Url::redirect_current();
	}	
	function draw()
	{		
		require_once 'packages/core/includes/utils/paging.php';
		require_once 'cache/config/status.php';
		$table = 'news';
		$cond = '1 and news.type="NEWS"';
		if(Session::get('doc_gia')==1)
		{
			$cond.= ' and news.author <> ""';
		}else{
			$cond.= ' and news.author = ""';
		}
		$order_by = 'id DESC';
		$item_per_page = 50;
		$count = PublisherDB::GetTotal($table,$cond);
		$paging = paging($count['acount'],$item_per_page,10,false,'page_no',array('type'));
		$items = User::check_categories(PublisherDB::GetItems($table,$cond,$order_by,$item_per_page),false);
		$this->parse_layout('list',array(
			'items'=>$items,
			'paging'=>$paging,
			'total'=>$count['acount'],
			'status'=>$status
		));
	}
}
?>