<?php
class EditTemplateEmailForm extends Form
{
	function EditTemplateEmailForm()
	{
		Form::Form('EditTemplateEmailForm');
		$this->add('name',new TextType(true,'invalid_name',0,2000));
		$this->add('folder',new TextType(true,'invalid_folder',0,2000)); 		
		$this->link_css('skins/default/css/cms.css');
		$this->link_css('skins/default/css/tabs/tabpane.css');
	}
	function on_submit()
	{		
		if($this->check())
		{
			require_once 'packages/core/includes/utils/vn_code.php';
			if(Url::get('name') and	$file_name = Url::get('folder').'/'.convert_utf8_to_latin(Url::get('name')).'.html')
			{
				$file_name = Url::get('folder').'/'.convert_utf8_to_latin(Url::get('name')).'.html';
				if(file_exists($file_name) and Url::get('cmd')!='edit')
				{
					$file_name = Url::get('folder').'/'.convert_utf8_to_latin(Url::get('name')).'_'.time().'.html';
					TemplateEmailDB::save_file($file_name,Url::get('description'));
				}
				TemplateEmailDB::save_file($file_name,Url::get('description'));
			}
			//System::debug($rows); exit();
			Url::redirect_current();
		}
	}
	function draw()
	{		
		require_once 'cache/config/status.php';
		require_once Portal::template_js('core').'/tinymce/init_tinyMCE.php';
		$languages = DB::select_all('language');
		if(Url::get('cmd')=='edit' and Url::get('file') and Url::get('dir') and is_dir(Url::get('dir')))
		{
			$file = Url::get('dir').'/'.Url::get('file');
			$content = TemplateEmailDB::read_file($file);
			$_REQUEST['folder'] = Url::get('dir');
			$_REQUEST['name'] = str_replace('.html','',Url::get('file'));
			$_REQUEST['description'] = $content;
		}
		$this->parse_layout('edit',array(
			'folder_list'=>array(''=>'----'.Portal::language('choose_folder').'----')+TemplateEmailDB::get_folder('cache/email_template',$folders,1),
			'name'=>(isset($_REQUEST['name']))?$_REQUEST['name']:''
		));
	}
}
?>
