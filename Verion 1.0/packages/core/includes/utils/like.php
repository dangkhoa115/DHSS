<?php
	class Like{
		public static $app_id = '397202880398590';
		public static $app_secret = 'ab3bd222775ef50cd4f1926bd4d7ef8d';
		public static function button($item_id){
			$counter = 0;
			if($item_like = DB::fetch('SELECT SUM(item_like.counter) AS total_counter FROM item_like WHERE item_id = '.$item_id.' group by item_id')){
				$counter = $item_like['total_counter'];
			}
			$php_session = isset($_COOKIE['PHPSESSID'])?$_COOKIE['PHPSESSID']:time();
			if(!DB::exists('SELECT id,item_id,php_session FROM item_like WHERE item_id = '.$item_id.' and php_session = \''.$php_session.'\'')){
				echo '<span alt="'.Portal::language('like').'" title="'.Portal::language('right_not_modify').'!" class="counter-bound" style="cursor:pointer;font-size:11px;" onclick="updateItemLike(this,'.$item_id.',\''.$php_session.'\',72739)">'.Portal::language('right').'</span><span style="color:#FF6B27;font-size:11px;" id="counter_'.$item_id.'">{'.$counter.'}</span>'.(User::is_admin()?'<a href="'.Url::build('manage_item',array('cmd'=>'delete_one','item_id'=>$item_id)).'" target="_blank" style="color:#F00" onclick="if(!confirm(\'Bạn có chắc không?\')){return false;}" title="Xóa"><img src="skins/default/images/buttons/delete.gif" align="top" width="16"></a>':'');//6080 module ItemDetail
			}else{
				echo '<span alt="'.Portal::language('like').'" title="'.Portal::language('right_not_modify').'!" class="counter-bound" style="cursor:pointer;font-size:11px;color:#AAAAAA;" onclick="alert(\''.Portal::language('you_have_just_liked_this').'\')">'.Portal::language('right').'</span><span style="color:#FF6B27;font-size:11px;" id="counter_'.$item_id.'">{'.$counter.'}</span>'.(User::is_admin()?'<a href="'.Url::build('manage_item',array('cmd'=>'delete_one','item_id'=>$item_id)).'" target="_blank" style="color:#F00" onclick="if(!confirm(\'Bạn có chắc không?\')){return false;}" title="Xóa"><img src="skins/default/images/buttons/delete.gif" align="top" width="16"></a>':'');//6080 module ItemDetail
			}
		}
		public static function get_facebook_count($url){
			$source_url = "http://www.allfacebook.com";  //This could be anything URL source including stripslashes($_POST['url'])
			$url = "http://api.facebook.com/restserver.php?method=links.getStats&urls=".urlencode($url);
			$xml = file_get_contents($url);
			$xml = simplexml_load_string($xml);
			$shares =  $xml->link_stat->share_count;
			$likes =  $xml->link_stat->like_count;
			$comments = $xml->link_stat->comment_count;
			$total = $xml->link_stat->total_count;
			$max = max($shares,$likes,$comments);
			return array(
				'shares'=>$shares,
				'likes'=>$xml->link_stat->like_count,
				'comments'=>$comments,
				'total'=>$total,
				'max'=>$max
			);
		}
		public static function get_token(){
			$app_id = Like::$app_id;
			$app_secret = Like::$app_secret;
			$app_token_url = "https://graph.facebook.com/oauth/access_token?"
					. "client_id=" . $app_id
					. "&client_secret=" . $app_secret 
					. "&grant_type=client_credentials";
	
					$response = file_get_contents($app_token_url);
					$params = null;
			parse_str($response, $params);
			return $params['access_token'];
		}
		public static function get_comments(){
			$url = 'https://graph.facebook.com/fql?q=SELECT xid FROM comments_info WHERE app_id='.Like::$app_id.'&access_token='.Like::get_token().'';
			$response = file_get_contents($url);
			echo $response;
		}
	}
?>
