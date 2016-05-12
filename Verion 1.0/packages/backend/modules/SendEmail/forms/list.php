<?php
class ListSendEmailForm extends Form{
	function ListSendEmailForm(){
		Form::Form('ListSendEmailForm');
		$this->add('duration',new IntType(true,'invalid_duration',0,2000));
		$this->link_css('skins/default/css/cms.css');
		$this->link_js('packages/core/includes/js/jquery/datepicker.js');
		$this->link_css(Portal::template('').'css/jquery/datepicker.css');		
		$this->link_js('packages/core/includes/js/jquery/jquery.blockUI.js');
	}
	function on_submit(){
		if(Url::get('cmd')=='search'){
			Url::redirect_current(array('is_active'=>Url::get('is_active'),'zone_id','account_id','month'));
		}
		if($this->check() and Url::get('cmd')=='send_email'){
			$status = false;
			if(isset($_REQUEST['selected_ids']) and count($_REQUEST['selected_ids'])>0){
				set_time_limit(0);
				$item = SendEmailDB::get_template(intval(Url::get('email_template')));
				$ids = implode(',',$_REQUEST['selected_ids']);
				$items = SendEmailDB::get_all_item('party.id in ('.$ids.')');
				foreach($items as $key=>$value){
					if($this->check_email($value['email']) && $this->check_sentbox($value['email'])){
						$array_name = array('[[|name|]]');
						$array_replace = array($value['name']);
						$content = str_replace($array_name,$array_replace,$item['note']);
						$url = array();
						if($item['url'] and file_exists($item['url'])){
							$url[1] = $item['url'];
						}
						$sent = System::send_mail('sieusaogiaingoaihang@gmail.com',$value['email'],$item['title'],$content);//,Portal::get_setting('email_webmaster'),Portal::get_setting('pass_email_webmaster')
						if($sent and $value['email']){
							echo $value['email'];exit();
							$status = true;
							$rows = array('time'=>time(),'user_id'=>Session::get('user_id'),'email'=>$value['email'],'customer_id'=>$value['id'],'template_email_id'=>$item['id']);
							$id = DB::insert('email_send',$rows);
							sleep(intval(Url::get('duration')));
						}
					}
				}
			}
			if($status){
				Url::redirect_current(array('send_mail'=>'ok'));
			}
		}
	}
	function check_email($email){
		return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[_a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,6})$",$email);
	}
	function check_sentbox($email){
		return !DB::fetch('select id from email_send where email = "'.$email.'" and FROM_UNIXTIME(time,"%d-%m-%Y") = "'.date('d-m-Y').'"');
	}
	function draw(){
		$cond = $this->get_condition();
		require_once 'packages/core/includes/utils/paging.php';
		require_once 'cache/tables/zones.cache.php';
		$item_per_page = 2000;
		$join = '';
		$total = SendEmailDB::get_total_item($cond,$join,Url::get('type'));
		$paging = paging($total,$item_per_page,10,false,'page_no',array('is_active','account_id','month','do'));
		$items = SendEmailDB::get_items($cond,'party.id asc',$item_per_page);
		$item_per_page_list = array(20=>20,30=>30,50=>50,100=>100);
		$month = array(''=>'--- '.Portal::language('month').' ---','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12');
		$dir = 'cache/email_marketing';
		$files = array();
		$accounts = DB::select_all('account','account.type="USER"');
		$zones = DB::fetch_all('select zone.id,zone.name,zone.structure_id from zone where (zone.type = 3 or zone.type = 4) and '.IDStructure::child_cond(DB::structure_id('zone',1),3).' group by zone.structure_id');		
		require 'cache/config/email_refer.php';
		$layout = 'list';
		if(Url::get('do') == 'export'){
			$layout = 'plain_layout';
		}
		$this->parse_layout($layout,array(
			'items'=>$items,
			'account_id_list'=> array('all'=>Portal::language('all_account'))+String::get_list($accounts),
			'zone_id_list'=>array(''=>Portal::language('all_city'))+String::get_list($zones),
			'paging'=>$paging,
			'item_per_page_list'=>$item_per_page_list,
			'item_per_page'=>$item_per_page,
			'email_template_list'=>String::get_list($this->read_template_dir($dir,$files,1)),
			'month_list'=>$month,
			'total'=>$total,
			'is_active_list'=>array(''=>'Tất cả',1=>'Đã kích hoạt','Chưa kích hoạt'),
			'email_refer_list'=>String::get_list($email_refer)
		));
	}
	function read_template_dir($dir,&$files,$i){
		if(is_dir($dir)){
			$folder = $dir;
			if($handle = opendir($dir)){
				while ($file = readdir($handle)){
					if($file!="." and $file!=".."){
						if(is_dir($dir.'/'.$file)){
							$this->read_template_dir($dir.'/'.$file,$files,$i);
						}
						else{
							$files[$i] = array('id'=>$file,'name'=>$file,'folder'=>$folder);
						}
						$i++;
					}
				}
				closedir($handle);
			}
			return $files;
		}
		else{
			return false;
		}
	}
	function get_condition(){
		$cond = 'party.email <> ""';
		if(Url::get('zone_id')){
			$cond.= ' and '.IDStructure::child_cond(DB::structure_id('zone',intval(Url::get('zone_id'))),false,'zone.');
		}			
		if(Url::get('is_active')){
			$cond.= ' and account.is_active="'.Url::get('is_active').'"';
		}
		if(Url::get('keyword') and Url::get('keyword')!=Portal::language('search')){
			$cond .= URL::get('keyword')? ' AND ((ssnh_nguoi_choi.ten) LIKE "%'.addslashes(URL::sget('keyword')).'%")':'';
		}
		if(Url::get('month')){
			$cond.= ' and MONTH(party.birth_date)="'.Url::get('month').'"';
		}
		if(Url::get('account_id') and Url::get('account_id')!='all'){
			$cond.= ' and (ssnh_nguoi_choi.account_id="'.addslashes(Url::get('account_id')).'")';
		}
		return $cond;
	}
}
?>
