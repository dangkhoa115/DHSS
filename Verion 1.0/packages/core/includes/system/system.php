<?php
/******************************
COPY RIGHT BY Catbeloved - Framework
WRITTEN BY catbeloved
******************************/

//Lop he thong
//Cac ham dung chung thong dung cho vao day
class Timer{
	var $starttime = 0;
  function start_timer(){
        $mtime = microtime();
        $mtime = explode (' ', $mtime);
        $mtime = $mtime[1] + $mtime[0];
		$this->starttime = $mtime;
    }
	function get_timer(){
		$mtime = microtime();
		$mtime = explode (' ', $mtime);
		$mtime = $mtime[1] + $mtime[0];
		return number_format($mtime-$this->starttime,4);
	}
}

class System{
	static $false = false;
	static function send_mail($from,$to,$subject,$content,$attachment=array(),$from_user='dangkhoa115@gmail.com',$from_password='Abc123456@@'){
		if(!class_exists('PHPMailer')){
			require(ROOT_PATH.'packages/core/includes/utils/mailer/class.phpmailer.php');
		}	
		$mail = new PHPMailer();		
		$mail->IsSMTP();
		$mail->SetLanguage("vn", "");
		$mail->Host     = "";
		$mail->SMTPAuth = true;
		//attachment
		if(is_array($attachment) and count($attachment)>0){
			foreach($attachment as $value){
				$mail->AddAttachment("upload/modern/file/".$value);
			}
		}
		////////////////////////////////////////////////
		// Ban hay sua cac thong tin sau cho phu hop
		
		$mail->Username = $from_user;				// SMTP username
		$mail->Password = $from_password; 				// SMTP password
		
		$mail->From     = $from;				// Email duoc gui tu???
		$mail->FromName = "Sieusaongoaihang.vn";					// Ten hom email duoc gui
		$mail->AddAddress($to,"");	 	// Dia chi email va ten nhan
		$mail->AddReplyTo($from,"Sieusaongoaihang.vn");		// Dia chi email va ten gui lai
				
		$mail->IsHTML(true);//default : true (ducnm sua)				// Gui theo dang HTML
		
		$mail->Subject  =  $subject;				// Chu de email
		$mail->Body     =  $content;		// Noi dung html
		if(!$mail->Send()){
		   echo "Email chua duoc gui di! <p>";
		   echo "Loi: " . $mail->ErrorInfo;
		   echo '<br><a href="'.URL::build('lost_password').'">Back</a><br>';
		   exit;
		}
		else{
			return true;
		}
	}
	static function halt(){
		Session::end();
		DB::close();
		exit();
	}
	static function log($type, $title='', $description = '', $parameter = '', $note = '', $user_id = false){
		DB::insert('log', array(
			'type'=>$type, 
			'module_id'=>is_object(Module::$current)?Module::block_id():0,
			'title'=>$title, 
			'description'=>$description, 
			'parameter'=>$parameter, 
			'note'=>$note, 
			'time'=>time(),
			'user_id'=>$user_id?$user_id:is_object(User::$current)?User::id():0,
			'hotel_id'=>Session::is_set('hotel_id')?Session::get('hotel_id'):'',
			'portal_id'=>PORTAL_ID
		));
	}
	static function set_page_title($title){
		echo '<script type="text/javascript">document.title=\''.str_replace('\'','&quot;',$title).'\';</script>';
	}
	static function set_page_description($description){
		echo '<script type="text/javascript">document.description=\''.str_replace('\'','&quot;',$description).'\';</script>';
	}
	static function add_meta_tag($tags){
		global $meta_tags;
		if(isset($meta_tags)){
	 		$meta_tags.=$tags;
		}
		else{
			$meta_tags=$tags;
		}
	}
	static function check_user_agent(){//check moible or pc browser
		/*if(Url::get('web_skin')){
			Session::set('web_skin',true);
		}elseif(Url::get('mobile_skin')){
			Session::set('mobile_skin',true);
			if(Session::is_set('web_skin')){
				Session::delete('web_skin');
			}
		}
		if(Session::is_set('web_skin')){// truong hop ep dung` giao dien web
			return false;
		}
		if(Session::is_set('mobile_skin')){// truong hop ep dung` giao dien web
			return true;
		}
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
			return true;
		}else{
			return false;
		}*/
		return false;
	}
	static function display_number($num){
		if($num){
			if($num==round($num)){
				return number_format($num,0);
			}
			else{
				return number_format($num,2);
			}
		}else{
			return '';
		}
	}
	static function display_number_report($num){
		return number_format($num,2,'.',',');
	}
	static function calculate_number($num){
		return str_replace(',','',$num);
	}
	static function debug($array){
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
}
class String{
	static function array2suggest($array){
		$st = '[';
		$i = 0;
		$size_of_array = sizeof($array);
		foreach($array as $key=>$values){
			$st.='{';
			/*if(is_array($values)){
				$f = true;
				foreach($values as $key=>$value){
					$st .= $key.':"'.String::string2js($value).'",';
				}
			}*/
			if(isset($value['name'])){
				$st.='name:"'.String::string2js($value['name']).'",to:"'.$key.'", id:"'.$key.'"';
			}
			else{
				$st.='name:"'.$key.'",to:"'.$key.'", id:"'.$key.'"';
			}
			$i++;
			if($i==$size_of_array){
				$st.='}';
			}
			else{
				$st.='},
';
			}
		}
		$st.= ']';
		return $st;
	}
	static function str_multi_language($vn,$en=false){
		if(Portal::language()==1){
			return $vn;
		}
		else
		if(Portal::language()==2){
			return ($en!=false)?$en:$vn;
		}
		else
		if(Portal::language()==3){
			return ($en!=false)?$en:$vn;
		}
		else
		if(Portal::language()==4){
			return ($en!=false)?$en:$vn;
		}
		else{
			return ($en!=false)?$en:$vn;
		}
	}
	static function language_field_list($name){
		$languages = DB::select_all('language');
		$st = '';
		foreach($languages as $language){
			if($st){
				$st .= ',';
			}
			$st .= $name.'_'.$language['id'];
		}
		return $st;
	}
	static function display_sort_title($str,$word_number){
		$c = str_word_count($str);
		$array1=array($c);
		$new_str='';
		if($c/2>$word_number){
			$array1 = explode(" ",$str);
			$i=0;
			while($i<sizeof($array1)){
				if($i<$word_number){
					$new_str.=$array1[$i].' ';
				}
				$i++;
			}
			return $new_str.'...';
		}
		else{
			return $str;	
		}
	}
	static function html_normalize($st){
		return str_replace(array('"','<'),array('&quot;','&lt;'),$st);
	}
	static function string2js($st){
		return strtr($st, array('\''=>'\\\'','\\'=>'\\\\','\n'=>'',chr(10)=>'\\',chr(13)=>'\n'));
//	return strtr($st, array('\''=>'\\\'','\\'=>'\\\\','\n'=>'',chr(10)=>'\\',chr(13)=>''));
	}
	static function array2js($array){
		$st = '{';
		foreach($array as $key=>$value){
			if($st!='{'){
				$st.='
,';
			}
			$st.='\''.String::string2js($key).'\':';
			if(is_array($value)){
				$st .= String::array2js($value);
			}
			else{
				$st .= '\''.String::string2js($value).'\'';
			}
		}
		return $st.'}';
	}
	static function array2tree(&$items,$items_name){
		//$structure_ids = array(ID_ROOT=>1);
		$show_items = array();
		$min = -1;
		foreach($items as $item){
			if($min==-1){
				$min = IDStructure::level($item['structure_id']);
			}
			$structure_ids[number_format($item['structure_id'],0,'','')] = $item['id'];
			//echo number_format($item['structure_id'],0,'','').'<br>';
			if(IDStructure::level($item['structure_id'])<=$min){
				$show_items[$item['id']] = $item+(isset($item['childs'])?array():array($items_name=>array()));
			}
			else{
				$st = '';
				$parent = $item['structure_id'];
				
				while(($level=IDStructure::level($parent = IDStructure::parent($parent)))>=$min and $parent and isset($structure_ids[number_format($parent,0,'','')])){
					
					$st = '['.$structure_ids[number_format($parent,0,'','')].'][\''.$items_name.'\']'.$st;
					
				}
				//echo number_format($parent,0,'','').' '.$st.'<br>';
				if($level<$min or $level==0){
					//echo '$show_items'.$st.'['.$item['id'].']<br>';
					eval('$show_items'.$st.'['.$item['id'].'] = $item+array($items_name=>array());');
				}
			}
		}
		return $show_items;
	}
//convert to vnnumeric
	static function convert_to_vnnumeric($st){
		//$temp = str_replace('.','',$st);
		return str_replace(',','',$st);
	}
//convert string to number	
	static function to_number($st,$count=0){
		$temp = substr($st,$count);
		$n = 0;
		for($i=0;$i<strlen($temp);$i++){
			$n = $n*10 + $temp[$i]; 
		}
		return $n;
	}
	static function get_list($items, $field_name=false,$indent=false){
		
		$item_list = array();
		foreach($items as $item){	
			if(!$field_name){
				$field_name=isset($item['name'])?'name':(isset($item['title'])?'title':(isset($item['name_'.Portal::language()])?'name_'.Portal::language():(isset($item['title_'.Portal::language()])?'title_'.Portal::language():'id')));
			}
			if(isset($item['structure_id'])){
				$level = IDStructure::level($item['structure_id']);
				for($i=0;$i<$level;$i++){
					$item[$field_name] = ($indent?$indent:"").$item[$field_name];
				}
			}
			$item_list[$item['id']]=isset($item[$field_name])?$item[$field_name]:'';
		}
		return $item_list;
	}
	static function video_image($url){
		$image_url = parse_url($url);
		if($image_url['host'] == 'www.youtube.com' || $image_url['host'] == 'youtube.com'){
			$array = explode("&", $image_url['query']);
			return "http://img.youtube.com/vi/".substr($array[0], 2)."/0.jpg";
		} else if($image_url['host'] == 'www.vimeo.com' || $image_url['host'] == 'vimeo.com'){
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".substr($image_url['path'], 1).".php"));
			return $hash[0]["thumbnail_small"];
		}
	}
	static function create_tags($string,$page){
		$result = '';
		$arr = explode(',',$string);
		$i = 0;
		foreach($arr as $key=>$value){
			$value = trim($value);
			$result .= (($i>0)?', ':'').'<a target="_blank" href="'.$page.'?tags='.$value.'" title="'.$value.'">'.$value.'</a>';
			$i++;
		}
		return $result;
	}
}
class Date_Time{
	static function to_sql_date($date){
		$a = explode('/',$date);
		if(sizeof($a)==3 and is_numeric($a[1]) and is_numeric($a[2]) and is_numeric($a[0]) and checkdate($a[1],$a[0],$a[2])){
			return ($a[2].'-'.$a[1].'-'.$a[0]);
		}
		else{
			return false;
		}
	}
	static function to_common_date($date){
		$a = explode('-',$date);
		if(sizeof($a)==3 and $a[0]!='0000'){
			return ($a[2].'/'.$a[1].'/'.$a[0]);
		}
		else{
			return false;
		}	
	}
	// format 01/01/2006
	static function to_time($date){
		if(preg_match('/(\d+)\/(\d+)\/(\d+)\s*(\d+)\:(\d+)/',$date,$patterns)){
			return strtotime($patterns[2].'/'.$patterns[1].'/'.$patterns[3])+$patterns[4]*3600+$patterns[5]*60;
		}
		else{
			$a = explode('/',$date);
			if(sizeof($a)==3 and is_numeric($a[1]) and is_numeric($a[2]) and is_numeric($a[0]) and checkdate($a[1],$a[0],$a[2])){
				return strtotime($a[1].'/'.$a[0].'/'.$a[2]);
			}
			else{
				return false;
			}		
		}
	}
	//Tra ve ngay lon nhat trong thang (29, 30 hay 31)
	static function display_date($time){
		$time=date('d/m/Y',$time);
		return $time;
	}
	static function daily($time){
		$daily=(getdate($time));
		return $daily['weekday'];
	}
	static function count_day($first_date,$second_date){		 
		$offset = $second_date-$first_date;
		return floor($offset/60/60/24);
	}
}
class MyArray{
	static function aarsort (&$array, $key) {
			$sorter=array();
			$ret=array();
			reset($array);
			foreach ($array as $ii => $va) {
					$sorter[$ii]=$va[$key];
			}
			arsort($sorter);
			foreach ($sorter as $ii => $va) {
					$ret[$ii]=$array[$ii];
			}
			$array=$ret;
	}
}
?>