<?php
class Upload{
	static $file_type = 'pre|image/jpeg|image/png|image/gif';
	static $file_size = 10;
	static $root_folder = 'upload';
	static $small_thumb_width = 300;
	static $small_thumb_height = 300;
	static $thumb_width = 500;
	static $thumb_height = 500;
	function update_upload_file($field,$dir='',$param = '',$new_width=false,$new_height=false, $constraint=false)
	{
		require_once 'packages/core/includes/utils/vn_code.php';
		if(isset($_FILES[$field]) and $_FILES[$field]['name'])
		{
			$file_name = convert_utf8_to_latin($_FILES[$field]['name']);
			$tmp_name = $_FILES[$field]['tmp_name'];
			$file_type = $_FILES[$field]['type'];
			$dir = Upload::create_folder(Upload::$root_folder.'/original/'.date('m_Y'));
			$small_thumb_dir = Upload::create_folder(Upload::$root_folder.'/small_thumb/'.date('m_Y'));
			$thumb_dir = Upload::create_folder(Upload::$root_folder.'/thumb/'.date('m_Y'));			
			$file_url = $dir.$file_name;
			if(Upload::check_file($file_url))
			{				
				$file_url = $dir.time().'_'.$file_name;
				$file_name = time().'_'.$file_name;
			}
			$max_upload_file_size =  Upload::$file_size*1024*1024;
			$type_file = Upload::$file_type;
			//echo strpos($type_file,$file_type);exit();
			if(strpos($type_file,$file_type)==true and filesize($tmp_name)< $max_upload_file_size)
			{
				if(move_uploaded_file($tmp_name,$file_url))
				{
					require_once 'packages/core/includes/utils/create_thumb.php';
					$image = new Imagethumb($file_url,true);
					$image->getThumb($thumb_dir.$file_name,108,81);
					$_REQUEST[$field] = $file_url;
				}
				else
				{
					$_REQUEST[$field] = '';
				}
			}	
			else
			{
				die('Invalid file type!');
			}
			return $file_url;
		}
	}
	function multi_upload_file($field, $dir,$type='IMAGE')
	{
		if(isset($_FILES[$field]))
		{		
			$dir = Upload::create_folder(Upload::$root_folder.'/original/'.date('m_Y'));
			$small_thumb_dir = Upload::create_folder(Upload::$root_folder.'/small_thumb/'.date('m_Y'));
			$thumb_dir = Upload::create_folder(Upload::$root_folder.'/thumb/'.date('m_Y'));			
			$new_name = array();
			foreach($_FILES[$field]['name'] as $k=>$value)
			{
				$file_name = convert_utf8_to_latin($_FILES[$field]['name'][$k]);
				$tmp_name = $_FILES[$field]['tmp_name'][$k];
				$file_type = $_FILES[$field]['type'][$k];
				if($value)
				{
					$value = convert_utf8_to_telex($value);
					if(Upload::check_file($file_url))
					{				
						$file_url = $dir.time().'_'.$file_name;
						$file_name = time().'_'.$file_name;
					}
					$max_upload_file_size = 4*1024*1024;
					@eval('$max_upload_file_size ='. Portal::get_setting('size_upload').';');
					if($type=='IMAGE')
					{
						$type_file = Portal::get_setting('type_image_upload');
					}
					elseif($type=='FILE')
					{
						$type_file = Portal::get_setting('type_file_upload');
					}
					if(preg_match('/\.('.$type_file.')$/i',strtolower($value),$matches) and filesize($_FILES[$field]['tmp_name'][$k])< $max_upload_file_size)
					{
						if(!move_uploaded_file($_FILES[$field]['tmp_name'][$k],$new_name[$k+1]['value']))
						{
							$new_name[$k+1]['value'] = '';
						}
					}	
					else
					{
						$new_name[$k+1]['value'] = '';
					}
				}
			}
			$_REQUEST[$field] = $new_name;
			return $new_name;
		}
	}
	function create_thumb($image,$new_image,$new_width,$new_height, $constraint=false)
	{
	
		$new_image;
		$source = image_open($image);
		$width=imagesx($source);
		$height=imagesy($source);
		// Load
		if($constraint)
		{
			$y1 = 0;
			$y2 = $height;
			$x1 = 0;
			$x2 = $width;
			if($width/$new_width>$height/$new_height)
			{
				$new_width = $width*$new_height/$height;
			}
			else
			{
				$new_height = $height*$new_width/$width;
			}
		}
		$thumb = imagecreatetruecolor($new_width, $new_height);
		imagefill($thumb,1,1,ImageColorAllocate( $thumb, 255, 255, 255 ) );
		if(!$constraint)
		{
			if($width/$new_width>$height/$new_height)
			{
				$y1 = 0;
				$y2 = $height;
				$x1 = ($width-($new_width*$height/$new_height))/2;
				$x2 = $width-2*$x1;
			}
			else
			{
				$x1 = 0;
				$x2 = $height;
				$y1 = ($height-($new_height*$width/$new_width))/2;
				$y2 = $height-2*$y1;
			}
		}
		// Resize
		imagecopyresized($thumb, $source, 0, 0, $x1, $y1, $new_width, $new_height, $x2-$x1, $y2-$y1);
		// Output
		if(file_exists($new_image))
		{
			@unlink($new_image);
		}
		imagejpeg($thumb,$new_image,100);
	}
	function check_file($file_name)
	{
		return @file_exists($file_name);	
	}
	function create_folder($folder,$chmod='0777')
	{
		if(is_dir($folder) or @mkdir($folder, $chmod, true))
		{
			return $folder.'/';	
		}
		else
		{
			return '/';
		}
	}
}
$upload = new Upload;