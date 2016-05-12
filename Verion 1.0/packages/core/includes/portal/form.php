<?php
class Form
{
	static $current = false;
	var $name = false;
	var $inputs = array();
	var $errors = false;
	var $error_messages = false;
	var $is_submit = false;
	var $count = 1;
	static $form_count = 1;
	
	function Form($name=false)
	{
		$this->name=$name;
	}
	function on_submit()
	{
	}
	function is_submit()
	{
		if(!$this->is_submit)
		{
			$this->is_submit = 1;
			if(isset(Module::$current))
			{
				if(isset($_REQUEST['form_block_id']))
				{
					if($_REQUEST['form_block_id']==Module::block_id())
					{
						if($this->inputs)
						{
							$this->is_submit = 2;
							foreach($this->inputs as $name=>$types)
							{
								if(!strpos($name,'.') and !isset($_REQUEST[$name]))
								{
									$this->is_submit = 1;
									break;
								}
							}
						}
					}
				}
			}
		}
		return $this->is_submit == 2;
	}
	function is_error()
	{
		return $this->errors<>false or $this->error_messages<>false;
	}
	function add($name, $type)
	{
		$this->inputs[$name][] = $type;
	}
	static function link_css($file_name)
	{
		if(strpos(Portal::$extra_header,'<link rel="stylesheet" href="'.$file_name.'" type="text/css" />')===false)
		{
			Portal::$extra_header .= '
<link rel="stylesheet" href="'.$file_name.'" type="text/css" />';
		}
	}
	static function link_js($file_name)
	{
		if(strpos(Portal::$extra_header,'<script type="text/javascript" src="'.$file_name.'"></script>')===false)
		{
			Portal::$extra_header .= '
<script type="text/javascript" src="'.$file_name.'"></script>';
		}
	}
	static function auto_refresh($time, $url)
	{
		Portal::$extra_header .= '<META HTTP-EQUIV="Refresh" CONTENT="'.$time.'; URL='.$url.'">';
	}
	function get_messages()
	{
		$this->error_messages=false;
		if($this->errors)
		{
			foreach($this->errors as $name=>$types)
			{
				foreach($types as $type)
				{
					$this->error_messages[$name][]=$type->get_message();
				}
			}
		}
		return $this->error_messages;
	}
	function check($exclude=array())
	{
		if($this->is_submit())
		{
			$this->errors = false;
			if($this->inputs)
			{
				foreach ($this->inputs as $name=>$types)
				{
					foreach($types as $type)
					{
						if(!in_array($name,$exclude))
						{
							if(!strpos($name,'.'))
							{
								if(!$type->check($_REQUEST[$name]))
								{
									$this->errors[$name][] = $type;
								}
							}
							else
							{
								$names = explode('.',$name);
								$table = 'mi_'.$names[0];
								$field = $names[1];
								if(isset($_REQUEST[$table]))
								{
									if(is_array($_REQUEST[$table]))
									{
										foreach($_REQUEST[$table] as $key=>$record)
										{
											if(isset($record[$field]))
											{
												if(!$type->check($record[$field]))
												{
													$this->errors[$table.'['.$key.']['.$field.']'][] = $type;
												}
											}
											else
											{
												if(!$type->check(''))
												{
													$this->errors[$table.'['.$key.']['.$field.']'][] = $type;
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
			$this->get_messages();
			if(!$this->errors)
			{
				foreach ($this->inputs as $name=>$types)
				{
					foreach($types as $type)
					{
						if(get_class($type)=='floattype' or get_class($type)=='inttype')
						{
							if(!strpos($name,'.'))
							{
								$_REQUEST[$name] = str_replace(',','',$_REQUEST[$name]);
							}
							else
							{
								$names = explode('.',$name);
								$table = $names[0];
								$field = $names[1];
								if(isset($_REQUEST['mi_'.$table]))
								{
									if(is_array($_REQUEST['mi_'.$table]))
									{
										foreach($_REQUEST['mi_'.$table] as $key=>$record)
										{
											if(isset($record[$field]))
											{
												$_REQUEST['mi_'.$table][$key][$field] = str_replace(',','',$record[$field]);
											}
										}
									}
								}
							}
						}
					}
				}
			}
			return !$this->errors;
		}
		else
		{
			return false;
		}
	}
	function error($name, $message,$language=true)
	{
		$this->error_messages[$name][] = $language?Portal::language($message):$message;
	}
	function parse_layout($name, $params=array())
	{
		$dir = ROOT_PATH.'cache/modules/'.Module::$current->data[(Module::$current->data['module']['type']!='WRAPPER')?'module':'wrapper']['name'];
		$cache_file_name = $dir.'/'.$name.'.php';
		$file_name = Module::$current->data[(Module::$current->data['module']['type']!='WRAPPER')?'module':'wrapper']['path'].'layouts/'.$name.'.php';
		if(1 or !file_exists($cache_file_name) or (($cache_time=@filemtime($cache_file_name)) and (@filemtime($cache_file_name)<@filemtime($file_name))))
		{
			require_once 'packages/core/includes/portal/generate_layout.php';
			$generate_layout = new GenerateLayout(file_get_contents($file_name));
			$text = $generate_layout->generate_text($generate_layout->synchronize());
			if(!is_dir($dir))
			{
				@mkdir($dir);
			}
			if($file = @fopen($cache_file_name,'w+'))
			{
				fwrite($file,$text);
				fclose($file);
			}
			$this->map = $params;
			$this->map['parse_layout'] = $text;
		}
		else
		{
			$this->map = $params;
			$this->map['parse_layout'] = file_get_contents($cache_file_name);
		}
		Module::invoke_event('ONPARSELAYOUT',Module::$current,$this->map);
		eval('?>'.$this->map['parse_layout'].'<?php ');
	}
	
	//In ra cac thong bao loi neu co
	function error_messages()
	{
		$this->count = Form::$form_count;
		Form::$form_count++;
		if(!$this->error_messages)
		{
			$show = ' display:none;"';
		}
		else
		{
			$show = '';
		}
		if (Portal::language()==1)
		{
			$notify = '';
		}
		else
		{
			$notify = '';
		}
		$txt = '<fieldset class="error-wrapper" style=";'.$show.'"  id="error_messages_'.$this->count.'"><table style="margin-top:5px;" bgcolor="#FFFFF2"><tr valign="top">';
		$txt .= '<td nowrap="nowrap"><div class="error-icon">'.$notify.'</div></td>';
		$txt.='<td width="100%" id="error_messages_content'.$this->count.'">';
		if($this->error_messages)
		{
			foreach ($this->error_messages as $name=>$error_messages)
			{
				foreach($error_messages as $error_message)
				{
					if(trim($this->name))
					{
						$txt .= '<li style="margin-left:20px;" class="error-message"><a onclick="var pos=jQuery(\'#'.$name.'\').offset(); window.scrollTo(pos.left,pos.top);jQuery(\'#'.$name.'\').focus().css(\'border\',\'2px inset #ccc\') ;return false;" title="View errors position">'.$error_message.'</a>';
					}
					else
					{
						$txt .= '<li style="margin-left:20px;" class="error-message">'.$error_message;
					}
					$txt .= '<br />';
				}
			}
		}
		$txt .= '</td></tr></table></fieldset>';
		return $txt;
	}
	//In ra cac thong bao loi neu co
	function ext_error_messages($form_name)
	{
		$this->count = Form::$form_count;
		Form::$form_count++;
		if($this->error_messages)
		{

			foreach ($this->error_messages as $name=>$error_messages)
			{
				foreach($error_messages as $error_message)
				{
					echo $form_name.'.findById(\''.$name.'\').markInvalid(\''.addslashes($error_message).'\');
';
				}
			}

		}
		return $txt;
	}
	function draw()
	{
		
	}
	//Gan lai $current
	//Goi ham draw()
	function on_draw()
	{
		$last_form = &Form::$current;
		Form::$current = &$this;
		$this->draw();
		Form::$current=&$last_form;
	}
}
Form::$current=&System::$false;
?>