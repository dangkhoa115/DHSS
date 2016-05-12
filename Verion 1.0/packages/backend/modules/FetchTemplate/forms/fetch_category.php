<?php
class FetchCategoryForm extends Form{
	function FetchCategoryForm(){
		Form::Form('FetchCategoryForm');	
		$this->add('url',new TextType(true,'invalid_url',0,2000)); 
		$this->link_css('skins/default/css/cms.css');
	}	
	function parse_content($url){
		if(preg_match('/http:\/\//',$url) and $content=file_get_contents($url)){			
			$this->crawler_category($content,Url::get('action'));
			/*$pattern_name='/<h1 id="title" class="title">([^\<]+)\<\/h1\>/';
			$pattern_brief='<IMG class=logo src="/common/v3/images/vietnamnet.gif" >&nbsp;';
			$pattern_description='<P align=justify>';			
			if(preg_match_all($pattern_name,$content,$match_name)){
				$name=$match_name[1][0];				
			}		
			$finish = 0;
			if($start=strpos($content,$pattern_brief)+strlen($pattern_brief) and $finish=strpos($content,'</STRONG></FONT></P>',$start)){	
				$brief=substr($content,$start,$finish-$start);	
			}			
			if($start=strpos($content,$pattern_description,$finish)+strlen($pattern_description) and $finish=strpos($content,'<DIV align=justify><FONT size=2>',$start)){	
				$description=substr($content,$start,$finish-$start);	
			}			
			if(isset($name)){
				$languages = DB::select_all('language');
				foreach($languages as $language){
					$item['name_'.$language['id']]=$name;
					$item['brief_'.$language['id']]=isset($brief)?$brief:'';
					$item['description_'.$language['id']]=isset($description)?$description:'';
				}								
				$item['portal_id']=Url::get('portal_id')?Url::get('portal_id'):PORTAL_ID;
				$item['type']='NEWS';
				$item['time']=time();
				$item['status']='SHOW';
				$item['user_id']=Session::get('user_id');
				require_once 'packages/core/includes/utils/vn_code.php';
				$name_id = convert_utf8_to_url_rewrite($item['name_1']);
				$item['name_id'] = $name_id;
				if(!DB::fetch('select name_id from news where name_id="'.$name_id.'"')){
					if(Url::get('image_url')){						
						$image_url=Url::get('image_url');
						$name_image=substr($image_url,strrpos($image_url,'/')+1);				
						@copy($image_url,'upload/'.substr(PORTAL_ID,1).'/content/'.$name_image);
						$image_url='upload/'.substr(PORTAL_ID,1).'/content/'.$name_image;
					}else{
						$image_url='';
					}
					$position = DB::fetch('select max(position)+1 as id from news where type="NEWS"');
					$item['position'] = $position['id'];			
					$item['image_url']=isset($image_url)?$image_url:'';
					DB::insert('news',$item);		
				}else{
					$this->error('duplicate_news','duplicate_news');
					return ;
				}
				Url::redirect_current(array('cmd'=>'fetch_vnnet'));
			}*/
		}else{
			echo '<script>alert("'.Portal::language('link_no_exists').'")</script>';
		}	
	}	
	function on_submit(){
		if($this->check()){
			$this->parse_content(Url::get('url'));
		}
	}
	function draw(){		
		$categories = FetchTemplateDB::get_category();
		$this->map['category_id_list'] = String::get_list($categories);
		require_once 'packages/core/includes/utils/category.php';
		category_indent($categories);
		$this->map['categories'] = $categories;
		$this->map['action_list'] = array(
			'1'=>'Thay thế toàn bộ',
			'0'=>'Thêm vào tiếp danh mục'
		);
		require_once 'cache/config/status.php';
		$this->map['status_list'] = $status;
		$this->parse_layout('fetch_category',$this->map);
	}	
	function crawler_category($content,$action=0){
		require_once 'packages/core/includes/utils/vn_code.php';
		if($action == 1){
			DB::delete('item_category','structure_id <> '.ID_ROOT.'');
		}
		$parttern_lv1 = '/\<a style=\'color: #ffffff; \' href=\'([a-zA-Z0-9-\/]+)\'\>([^\<]+)\<\/a\>/';
		$parttern_lv2 = '/\<a href=\"([a-zA-Z0-9-\/]+)\"                target=\"_parent\" class=\"lnk_sup_mn_2\"\>([^\<]+)\<\/a\>/';
		$lv1 = array();
		if(preg_match_all($parttern_lv1,$content,$matchs)){
			if(isset($matchs[2])){
				$lv1 = $matchs[2];
			}
		}
		$lv2 = array();
		$href_lv2 = array();
		if(preg_match_all($parttern_lv2,$content,$matchs)){
			if(isset($matchs[1])){
				$href_lv2 = $matchs[1];
			}
			if(isset($matchs[2])){
				$lv2 = $matchs[2];
			}
		}
		foreach($lv1 as $key=>$value){
			$childs = array();
			foreach($href_lv2 as $k=>$v){
				if(preg_match('/'.convert_utf8_to_url_rewrite($value).'/i',$v)){
					$childs[$k]['id'] = $k;
					$childs[$k]['name'] = $lv2[$k];
					$childs[$k]['crawler_url'] = $v;
				}
			}
			$this->save_item($value,$childs);
		}
	}
	function save_item($name,$childs){
		require_once 'packages/core/includes/utils/vn_code.php';
		//$content = str_replace(array("\n"),array('. '),$content);
		$name_id = convert_utf8_to_url_rewrite($name);
		$new_row = array(
			'name'=>$name,
			'name_id'=>$name_id,
			'crawler_url'=>'/'.$name_id.'/',
			'status'=>Url::get('status')
		);
		require_once 'packages/core/includes/system/si_database.php';
		$id = DB::insert('item_category', $new_row+array('structure_id'=>si_child('item_category',ID_ROOT)));			
		foreach($childs as $key=>$value){
			$new_row = array(
				'name'=>$value['name'],
				'name_id'=>convert_utf8_to_url_rewrite($value['name']),
				'crawler_url'=>$value['crawler_url'],
				'status'=>Url::get('status')
			);
			DB::insert('item_category', $new_row+array('structure_id'=>si_child('item_category',DB::fetch('select structure_id from item_category where id ='.$id.'','structure_id'))));
		}
	}
}
?>