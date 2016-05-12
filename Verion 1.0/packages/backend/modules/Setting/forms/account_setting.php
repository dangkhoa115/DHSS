<?php
class AccountSettingForm extends Form{
	function AccountSettingForm(){
		Form::Form('AccountSettingForm');
		//$this->link_js('packages/core/includes/js/jquery/ui.tabs.js');
		$this->link_css('skins/default/css/cms.css');
	}	
	function save_image($field){
		require_once 'packages/core/includes/utils/upload_file.php';
		$dir = substr(PORTAL_ID,1).'/icon/';		
		update_upload_file('config_'.$field,$dir);
		if(Url::get('config_'.$field)!=''){
			Portal::set_setting($field,Url::get('config_'.$field),false,'PORTAL');
		}
	}	
	function on_submit(){
		if(Url::get('cmd') == 'save'){	
			foreach($_REQUEST as $key=>$value){
				if(preg_match('/config_(.*)/',$key,$matches)){
					Portal::set_setting($matches[1],$value,false,'PORTAL');
				}	
			}	
			if($_FILES){
				foreach($_FILES as $key=>$value){
					if(preg_match('/config_(.*)/',$key,$matches)){
						$this->save_image($matches[1]);	
					}
				}
			}
			Session::delete('portal');
			Url::redirect_current();
		}
	}
	function draw(){
		require_once Portal::template_js('core').'/tinymce/init_tinyMCE.php';
		$languages = DB::select_all('language');
		$is_active = array(
			0=>Portal::language('Stop'),
			1=>Portal::language('Runing')
		);
		if(Portal::$current->settings){
			foreach(Portal::$current->settings as $key=>$value){
				if(is_string($value) and !isset($_REQUEST['config_'.$key])){
					$_REQUEST['config_'.$key] = $value;
				}
			}
		}
		$arr = array(0=>'NO',1=>'YES');
		$this->parse_layout('account_setting',array(
			'config_language_default_list'=>String::get_list($languages)
			,'config_rewrite_list'=>$arr
			,'languages'=>$languages
			,'config_is_active_list'=>$is_active
			,'config_use_cache_list'=>$arr
			,'config_use_double_click_list'=>$arr
			,'config_use_log_list'=>$arr
			,'config_use_recycle_bin_list'=>$arr
			,'config_use_price_list'=>$arr
			,'config_received_notification_from_contact_list'=>$arr
		));
	}
}
?>