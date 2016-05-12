<?php
class Url
{
	var  $root = false;
	static function build_all($except=array(), $addition=false){
		$url=false;
		foreach($_GET as $key=>$value){	
			if(!in_array($key, $except)){
				
				if(!$url){
					$url='?'.urlencode($key).'='.urlencode($value);
				}else{
					$url.='&'.urlencode($key).'='.urlencode($value);
				}
			}
		}
		foreach($_POST as $key=>$value){
			if($key!='form_block_id'){
				if(!in_array($key, $except)){
					if(is_array($value)){
						$value = '';
					}
					if(!$url){
						$url='?'.urlencode($key).'='.urlencode($value);
					}else{
						$url.='&'.urlencode($key).'='.urlencode($value);
					}
				}
			}
		}
		
		if($addition){
			if($url){
				$url.='&'.$addition;
			}else{
				$url.='?'.$addition;
			}
		}
		return $url;
	}
	static function build_current($params=array(),$smart=false,$anchor='',$portal=false){
		return URL::build(Portal::$page['name'],$params,$smart,$portal,$anchor);
	}
	/*-------------------- edit by thanhpt 08/10/2008: add rewrite --------------------------*/
	/*-------------------- edit by khoand 08/07/2011: add rewrite --------------------------*/
	static function build($page,$params=array(),$smart=false,$portal_id=false,$anchor=''){
		require_once 'packages/core/includes/utils/vn_code.php';
		if($smart){
			if($page == 'index'){
				$request_string = '/';
			}else{
				//$request_string = URL::get('portal').'/'.$page;
				$request_string = '';
				if($page == 'video_list'){
					$request_string = 'trang-video';
				}else{
					$request_string .= $page;
				}
				if ($params){
					foreach ($params as $param=>$value){
						if(is_numeric($param)){
							if(isset($_REQUEST[$value])){
								$request_string .= '/'.urlencode($_REQUEST[$value]);
							}
						}else{
							switch($param){
								case 'parent_name_id': 
									$request_string .= '/'.$value;
									$request_string = str_replace($page,'',$request_string);
									break;
								case 'toplike': $request_string .= '/toplike'.$value; break;
								case 'tab': $request_string .= '/'.$value; break;
								case 'category_name_id': $request_string .= '/'.$value;  break;
								case 'category_id': $request_string .= '-c'.$value;  break;
								case 'maker_name_id': $request_string .= '/'.$value;  break; // them tu trang DVS
								case 'maker_id': $request_string .= '-m'.$value;  break; // them tu trang DVS
								case 'os_name_id': $request_string .= '/'.$value;  break; // them tu trang DVS
								case 'os_id': $request_string .= '-os'.$value;  break; // them tu trang DVS
								case 'name_id': $request_string .= '/'.$value;  break;
								case 'id': $request_string .= '/id'.$value;  break;
								case 'page_no': $request_string .= '/trang-'.$value;  break;
								case 'pn_video': $request_string .= '/trang-'.$value;  break;
								case 'type': $request_string .= '/'.$value;  break;
								default: $request_string .= '/'.substr($param,0,1).$value;
							}
						}
						/*elseif($param=='zone_name_id'){
							$request_string .= $value.'-tours';
						}
						elseif($param=='hotel_zone_id'){
							$request_string .= 'hotels-in-'.$value;
						}else{
							if($param=='name_id'){
								$request_string .= '/'.$value;
							}else{
								if(preg_match('/page_no/',$param,$matches)){
									$request_string .= '/trang-'.$value;
								}else{
									$request_string .= '/'.substr($param,0,1).$value;
								}
							}
						}*/
					}
				}
				$request_string.='.html';
			}
		}else{
			if(!isset($params['portal'])){
				$params['portal'] = URL::get('portal');
			}
			$request_string = '?page='.$page;
	
			if ($params){
				foreach ($params as $param=>$value){
					if(is_numeric($param)){
						if(isset($_REQUEST[$value])){
							$request_string .= '&'.$value.'='.urlencode($_REQUEST[$value]);
						}
					}else{
						if($param!='name'){
							$request_string .= '&'.$param.'='.urlencode($value);
						}
					}
				}
			}
		}		
		//echo $request_string.$anchor;exit();
		return $request_string.$anchor;
	}
	static function build_page($page,$params=array(),$anchor=''){
		return URL::build(Portal::get_setting('page_name_'.$page),$params,$anchor);
	}
	static function redirect_current($params=array(),$anchor = ''){
		URL::redirect(Portal::$page['name'],$params+array('portal'),$anchor);
	}
	static function redirect_href($params=false){
		if(Url::check('href')){
			Url::redirect_url(Url::attach($_REQUEST['href'],$params));
			return true;
		}
	}
	static function check($params){
		if(!is_array($params)){
			$params=array(0=>$params);
		}
		foreach($params as $param=>$value){
			if(is_numeric($param)){
				if(!isset($_REQUEST[$value])){
					return false;
				}
			}else{
				if(!isset($_REQUEST[$param])){
					return false;
				}else{
					if($_REQUEST[$param]!=$value){
						return false;
					}
				}
			}
		}
		return true;
	}
	static function check_link($link){
		if(preg_match('/http:\/\//',$link,$matches)){
			return $link;
		}else{
			return 'http://'.$_SERVER['SERVER_NAME'].'/'.$link;
		}
	}
	//Chuyen sang trang chi ra voi $url
	static function redirect($page=false,$params=false,$smart=false,$anchor=''){
		if(!$page and !$params){
			Url::redirect_url();
		}else{
			Url::redirect_url(Url::build($page, $params,$smart,$anchor));
		}
	}
	static function redirect_url($url=false){
		if(!$url||$url==''){
			$url='?'.$_SERVER['QUERY_STRING'];
		}
		if(strpos('http://',$url)===true or strpos('https://',$url)===true){
			$url = str_replace('&','&','http://'.$_SERVER['HTTP_HOST'].'/'.$url);
		}
		//header('Location:'.$url);
		echo '<script>window.location="'.$url.'";</script>';
		System::halt();
	}
	static function access_denied($href=false){
		if(Portal::$page['name']!='home'){
			Url::redirect('notice',array('href'=>$href?$href:'?page=dang-nhap'));
		}else{
			System::halt();
		}
	}
	static function get_num($name,$default=''){
		if (preg_match('/[^0-9.,]/',URL::get($name))){
			return $default;
		}else{
			return str_replace(',','.',str_replace('.','',$_REQUEST[$name]));
		}
	}
	static function get_value($name,$default=''){
		if (isset($_REQUEST[$name])){
			return $_REQUEST[$name];
		}
		else
		if (isset($_POST[$name])){
			return $_POST[$name];
		}
		else
		if(isset($_GET[$name])){
			return $_GET[$name];
		}else{
			return $default;		
		}
	}
	static function get($name,$default=''){
		if(isset($_REQUEST[$name])){
			return Url::get_value($name,$default='');
		}else{
			return $default;
		}
	}
	static function post($name,$default=false){
		if(isset($_POST[$name])){
			return $_POST[$name];
		}else{
			return $default;
		}
	}
	static function sget($name,$default=''){
		//return strtr(URL::get($name, $default),array('"'=>'\\"'));
		$partten = "/[[\\\\]+|\"]+/i";
		$a =  preg_replace($partten,'',URL::get($name, $default));
		return $a;
	}
	static function iget($name){
		return intval(Url::sget($name));
	}
	static function jget($name,$default=''){
		return String::string2js(URL::get($name, $default));
	}
}
?>