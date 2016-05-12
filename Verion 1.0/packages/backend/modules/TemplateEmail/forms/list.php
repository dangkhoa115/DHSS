<?php
class ListTemplateEmailForm extends Form
{
	function ListTemplateEmailForm()
	{
		Form::Form('ListTemplateEmailForm');
		$this->link_css('skins/default/css/cms.css');
	}
	function delete()
	{
		if(isset($_REQUEST['selected_ids']) and count($_REQUEST['selected_ids'])>0)
		{
			foreach($_REQUEST['selected_ids'] as $key)
			{
				TemplateEmailDB::delete_file($key);
			}
			Url::redirect_current();
		}
	}	
	function on_submit()
	{
		switch(Url::get('cmd'))
		{
			case 'delete':
				$this->delete();
				break;			
		}		
	}
	function draw()
	{
		$files = array();
		$folders = array();
		$dir = 'cache/email_template';
		if(Url::get('folder') and is_dir(Url::get('folder')))
		{
			$dir = Url::get('folder');
		}
		$this->map['folder_list'] = array(''=>'----'.Portal::language('choose_folder').'----')+TemplateEmailDB::get_folder('cache/email_template',$folders,1);
		$this->map['items'] = $this->read_template_dir($dir,$files,1);
		$this->map['total'] = sizeof($this->map['items']);
		$this->parse_layout('list',$this->map);
	}
	function read_template_dir($dir,&$files,$i)
	{
		if(is_dir($dir))
		{
			$folder = $dir;
			if($handle = opendir($dir)){
				while ($file = readdir($handle)){
					if($file!="." and $file!="..")
					{
						if(is_dir($dir.'/'.$file))
						{
							$this->read_template_dir($dir.'/'.$file,$files,$i);
						}
						else
						{
							$files[$i] = array('id'=>$i,'name'=>$file,'folder'=>$folder);
						}
						$i++;					
					}
				}
				closedir($handle);
			}
			return $files;
		}
		else
		{
			return false;
		}
	}
}
?>
