<?php
class SettingForm extends Form
{
	function SettingForm()
	{
		Form::Form('SettingForm');
		$this->link_css('skins/default/css/cms.css');
	}		
	function on_submit()
	{
		if(Url::get('cmd')=='seo')
		{	
			Portal::set_setting('website_keywords',Url::get('website_keywords'),false,'PORTAL');
			Portal::set_setting('website_description',Url::get('website_description'),false,'PORTAL');
			Portal::set_setting('google_analytics',Url::get('google_analytics'),false,'PORTAL');
			Portal::set_setting('auto_link',Url::get('auto_link'),false,'PORTAL');
			Portal::set_setting('site_title',Url::get('site_title'),false,'PORTAL');
			Portal::set_setting('site_name',Url::get('site_name'),false,'PORTAL');
			Portal::set_setting('email_support_online',Url::get('email_support_online'),false,'PORTAL');
			Session::delete('portal');
			Url::redirect_current(array('cmd'=>'seo'));
		}	
	}
	function draw()
	{		
		$this->parse_layout('list',array(
			'prefix'=>PREFIX,
			'website_keywords'=>Portal::get_setting('website_keywords',''),
			'website_description'=>Portal::get_setting('website_description',''),
			'google_analytics'=>Portal::get_setting('google_analytics',''),
			'auto_link'=>Portal::get_setting('auto_link',''),
			'site_title'=>Portal::get_setting('site_title',''),
			'site_name'=>Portal::get_setting('site_name',''),
			'email_support_online'=>Portal::get_setting('email_support_online','')
		));
	}
}
?>