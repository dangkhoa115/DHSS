<?php
class FTP {
//Media FTP account
	static $ftp_connect_id = false;				// connection id of this ftp server
	static $ftp_result = false;
	static $home = '';
	function FTP($ftp_server, $ftp_port, $ftp_user, $ftp_password){
		FTP::$ftp_connect_id = ftp_connect($ftp_server,$ftp_port);
		if(FTP::$ftp_connect_id){
			$ftp_result = ftp_login(FTP::$ftp_connect_id,$ftp_user,$ftp_password);
			ftp_pasv(FTP::$ftp_connect_id, true);			
			if(isset(FTP::$ftp_connect_id) and FTP::$ftp_connect_id){
				if(!$ftp_result){
					ftp_close(FTP::$ftp_connect_id);
					FTP::$ftp_connect_id = $ftp_result;
				}else{
					FTP::$home = ftp_pwd(FTP::$ftp_connect_id);
				}
			}
		}
		if(!FTP::$ftp_connect_id){
			die('Error: Could not connect to the ftp server!');
			return false;
		}		
		return FTP::$ftp_connect_id;
	}
	function home(){
		ftp_chdir(FTP::$ftp_connect_id,FTP::$home);
	} 
	function upload_file($field,$dir = 'content',$max_size = 1024,$data_type='content',$type='IMAGE'){
		$dir = 'default/'.$dir;
		set_time_limit(0);
		if($_FILES){
			$file_resource = $_FILES[$field];
			if($type=='IMAGE'){
				$type_file = 'pre|image/jpeg|image/png|image/gif|image/ico';
			}
			elseif($type=='FILE'){
				$type_file = Portal::get_setting('type_file_upload','doc|docx|flv|swf|jpg|jpeg|gif|png|swf|flv|mp3|wmv|wav');
			}
			$max_upload_file_size = 20*1024*1024;
			$upload_path = FTP::make_folder($dir);
			if($thumbnail){
				//$thumb_path = FTP::make_folder($dir.'/thumb/'.date('m_Y'));
				//$small_thumb_path = FTP::make_folder($dir.'/small_thumb/'.date('m_Y'));
			}
			$new_name = array();
			if($file_resource and $file_resource['name'] and $file_resource['tmp_name']){
				require_once 'packages/core/includes/utils/vn_code.php';
				$file_name = convert_utf8_to_latin($file_resource['name']);
				$tmp_name = $file_resource['tmp_name'];
				$file_type = $file_resource['type'];
				if($file_name and strpos($type_file,$file_type)==true and filesize($tmp_name)< $max_upload_file_size){
					if(FTP::f_exists($upload_path.'/'.$file_name)){
						$file_name = time().'_'.$file_name;
					}
					FTP::home();
					$image_size = getimagesize($tmp_name);
					if(isset($image_size[0]) and $image_size[0]>$max_size)
					{
						echo '<body bgcolor="#2F2F2F"><div style="color:#F00;padding:20px;font-size:18px;background:#FFF;border-radius:10px;"><img src="skins/admin/images/warning.png" align="top"> Vui lòng chọn ảnh có độ rộng <= <strong>'.$max_size.'px</strong> (ảnh hiện tại của bạn có độ rộng là '.$image_size[0].'px) <a href="#" onClick=" window.history.back();return false;" style="color:#000;font-weight:bold;"> OK </a></div></body>';
						exit();
						/*require_once ROOT_PATH.'packages/core/includes/utils/create_thumb.php';
						$image = new Imagethumb($tmp_name,true);
						// ---------- Create thumb --------------------
						$image->getThumb(ROOT_PATH.'upload/temp/'.$file_name,$max_size,$max_size);	
						echo ROOT_PATH.'upload/temp/'.$file_name;exit();
						$returnValue = ftp_put(FTP::$ftp_connect_id, $upload_path.'/'.$file_name, ROOT_PATH.'upload/temp/'.$file_name, FTP_BINARY);
						//@unlink(ROOT_PATH.'upload/temp/'.$file_name);*/						
					}
					$returnValue = ftp_put(FTP::$ftp_connect_id, $upload_path.'/'.$file_name, $tmp_name, FTP_BINARY);
					$size_upload = 0;
					if ($returnValue != FTP_FINISHED) {
					   return false;				
					}else{
							$new_name['image_url'] = 'http://'.MEDIA_SERVER.'/'.'upload/'.$upload_path.'/'.$file_name;
					}
					/*if($thumbnail){							
						require_once 'packages/core/includes/utils/create_thumb.php';
						$image = new Imagethumb($tmp_name,true);
						// ---------- Create thumb --------------------
						$image->getThumb('upload/temp/'.$file_name,200,200);
						$return_thumb = ftp_put(FTP::$ftp_connect_id, $upload_path.'/'.$file_name, 'upload/temp/'.$file_name, FTP_BINARY);
						if($return_thumb == FTP_FINISHED){
							$new_name['image_url'] = 'http://'.MEDIA_SERVER.'/upload/'.$new_name['image_url'];
						}
						@unlink('upload/temp/'.$file_name);
					}*/
					return $new_name;
				}
				else{
					FTP::home();
					return false;
				}
			}
		}
		return false;
	}
	function upload_multi_file($field,$dir='content',$thumbnail=false,$data_type='content',$type='IMAGE'){
		set_time_limit(0);
		if($_FILES){
			if(isset($_FILES[$field])){
				if($type=='IMAGE'){
					$type_file = 'pre|image/jpeg|image/png|image/gif|image/ico';
				}
				elseif($type=='FILE'){
					$type_file = Portal::get_setting('type_file_upload','doc|docx|flv|swf|jpg|jpeg|gif|png|swf|flv|mp3|wmv|wav');
				}
				$max_upload_file_size = 20*1024*1024;
				$upload_path = FTP::make_folder($dir.'/original/'.date('m_Y'));
				if($thumbnail){
					$thumb_path = FTP::make_folder($dir.'/thumb/'.date('m_Y'));
					$small_thumb_path = FTP::make_folder($dir.'/small_thumb/'.date('m_Y'));
				}
				$new_name = array();
				require_once 'packages/core/includes/utils/vn_code.php';
				foreach($_FILES[$field]['name'] as $i=>$name){
					$file_name = '';
					if($name and $_FILES[$field]['tmp_name'][$i]){
						$file_name = $name;
						if(FTP::f_exists($upload_path.'/'.$file_name)){
							$file_name = time().'_'.$name;
						}
						$tmp_name = $_FILES[$field]['tmp_name'][$i];
						$file_type = $_FILES[$field]['type'][$i];
						//echo $folder;exit();
						//echo $upload_path;exit();
						if($file_name and strpos($type_file,$file_type)==true and filesize($tmp_name)< $max_upload_file_size){
							$file_name = convert_utf8_to_latin($file_name);
							$new_name[$i+1]['image_url'] = $upload_path.'/'.$file_name;
							if($thumbnail){
								$new_name[$i+1]['thumb_url'] = $thumb_path.'/'.$file_name;
								$new_name[$i+1]['small_thumb_url'] = $small_thumb_path.'/'.$file_name;							
							}
							FTP::home();
							$returnValue = ftp_put(FTP::$ftp_connect_id, $upload_path.'/'.$file_name, $tmp_name, FTP_BINARY);
							//upload thumb
							$size_upload = 0;
							if ($returnValue != FTP_FINISHED) {
								$new_name[$i+1]['image_url'] = '';
							   	return false;				
							}
							else{
								$new_name[$i+1]['image_url'] = 'http://'.MEDIA_SERVER.'/'.$new_name[$i+1]['image_url'];
							}
							if($thumbnail){							
								require_once 'packages/core/includes/utils/create_thumb.php';
								$image = new Imagethumb($tmp_name,true);
								// ---------- Create thumb --------------------
								$image->getThumb('upload/temp/'.$file_name,250,150);
								$return_thumb = ftp_put(FTP::$ftp_connect_id, $thumb_path.'/'.$file_name, 'upload/temp/'.$file_name, FTP_BINARY);
								if($return_thumb != FTP_FINISHED){
									$new_name[$i+1]['thumb_url'] = '';	
								}
								else{
									$new_name[$i+1]['thumb_url'] = 'http://'.MEDIA_SERVER.'/'.$new_name[$i+1]['thumb_url'];
								}
								@unlink('upload/'.$file_name);
								//----------------- Create small_thumb --------------								
								$image->getThumb('upload/temp/'.$file_name,90,90);
								$return_small_thumb = ftp_put(FTP::$ftp_connect_id, $small_thumb_path.'/'.$file_name, 'upload/temp/'.$file_name, FTP_BINARY);
								if($return_small_thumb != FTP_FINISHED){
									$new_name[$i+1]['small_thumb_url'] = '';
								}
								else{
									$new_name[$i+1]['small_thumb_url'] = 'http://'.MEDIA_SERVER.'/'.$new_name[$i+1]['small_thumb_url'];
								}
								@unlink('upload/'.$file_name);
							}
						}
						else{
							$new_name[$i+1]['image_url'] = '';
							$new_name[$i+1]['thumb_url'] ='';
							$new_name[$i+1]['small_thumb_url'] = '';							
							FTP::home();
							return false;
						}
					}
				}
				return $_REQUEST[$field] = $new_name;				
			}			
			
		}
	}
	function delete_file($file){
		FTP::home();
		if(ftp_size(FTP::$ftp_connect_id,$file)){
			return @ftp_delete(FTP::$ftp_connect_id,$file);
		}
		return false;
	}
	function make_folder($path,$permissions = NULL){
		FTP::home();
		$arr = explode('/',$path);
		foreach($arr as $folder){
			$result = @ftp_mkdir(FTP::$ftp_connect_id, $folder);
			FTP::check_dir($folder);
			// Set file permissions if needed
			if ( ! is_null($permissions)){
				$this->chmod($folder, (int)$permissions);
			}
		}
		return $path;
	}
	function rename($old_file, $new_file, $move = FALSE){
		$result = @ftp_rename(FTP::$ftp_connect_id, $old_file, $new_file);

		if ($result === FALSE){
			return FALSE;
		}

		return TRUE;
	
	}
	function delete_folder($filepath){
		$filepath = preg_replace("/(.+?)\/*$/", "\\1/",  $filepath);

		$list = FTP::list_files($filepath);

		if ($list !== FALSE AND count($list) > 0){
			foreach ($list as $item){
				// If we can't delete the item it's probaly a folder so
				// we'll recursively call delete_dir()
				if ( ! @ftp_delete(FTP::$ftp_connect_id, $item)){
					FTP::delete_folder($item);
				}
			}
		}

		$result = @ftp_rmdir(FTP::$ftp_connect_id, $filepath);

		if ($result === FALSE){
			return FALSE;
		}

		return TRUE;
	}
	function list_files($path = '.'){
		return ftp_nlist(FTP::$ftp_connect_id, $path);
	}
	
	//-----------
	function check_dir($dir){
		return ftp_chdir(FTP::$ftp_connect_id,$dir);
	}
	function get_file($dir){
		$files = array();
		$filetypes = array('-'=>'FILE', 'd'=>'DIR', 'l'=>'LINK');
		$month_data = array(
			'Jan'=>1,
			'Feb'=>2,
			'Mar'=>3,
			'Apr'=>4,
			'May'=>5,
			'Jun'=>6,
			'Jul'=>7,
			'Aug'=>8,
			'Sep'=>9,
			'Otc'=>10,
			'Nov'=>11,
			'Dec'=>12
		);
		$data = ftp_rawlist(FTP::$ftp_connect_id,$dir,true);
		$i = 0;
		if($data){
			foreach($data as $line) {
				$i++;
				if(substr(strtolower($line), 0, 5) == 'total') continue; # first line, skip it
				preg_match('/'. str_repeat('([^\s]+)\s+', 7) .'([^\s]+) (.*)/', $line, $matches); # Here be Dragons
				list($permissions, $children, $owner, $group, $size, $month, $day, $time, $name) = array_slice($matches, 1);
				if (! in_array($permissions[0], array_keys($filetypes))) continue;
				$type = $filetypes[$permissions[0]];
				$date = date('d/m/y H:i', (strpos($time, ':') ? mktime(substr($time, 0, 2), substr($time, -2), 0, $month_data[$month], $day) : mktime(0,0,0,$month_data[$month], $day, $time) ) );
				$files[$i] = array(
					'name'=>$name,
					'type'=>$type,
					'permissions'=>substr($permissions, 1),
					'children'=>$children,
					'owner'=>$owner,
					'group'=>$group,
					'size'=>$size,
					'date'=>$date
				);
			}
		}
		return $files;
	}
	//---------------------------------
	function f_exists($file){
		$size = ftp_size(FTP::$ftp_connect_id,$file);
		if($size!=-1){
			return true;
		}else{
			return false;
		}
	}
	function close(){
		ftp_close(FTP::$ftp_connect_id);
	}
}
require_once 'cache/config/ftp_server.php';
$ftp = new FTP(MEDIA_SERVER,FTP_PORT, FTP_USER, FTP_PASSWORD);
?>