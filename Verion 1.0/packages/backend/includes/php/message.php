<?php 
class Message{
	static function get_messages($account_id,$receive=true,$limit=50,$cond){
		return DB::fetch_all('select id,content from message where '.($receive?'to="'.$account_id.'"':'from="'.$account_id.'"').' '.$cond.' order by message.time limit 0,'.$limit.'');
	}
	static function count_unread_message(){
		$number = DB::fetch('select count(*) as acount from `message` where `to`="'.Session::get('user_id').'" and `read` = 0','acount');
		return $number?$number:0;
	}
	static function send_message($from,$to,$content){
		if($content and $from and $to){
			DB::insert('message',array('from'=>$from,'to'=>$to,'content'=>$content,'time'=>time()));
		}
	}
}
?>