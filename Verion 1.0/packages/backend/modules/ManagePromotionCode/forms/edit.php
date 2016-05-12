<?php
class EditManagePromotionCodeForm extends Form{
	function EditManagePromotionCodeForm(){
		Form::Form('EditManagePromotionCodeForm');
		//$this->add('promotion_value',new TextType(true,'invalid_promotion_value',0,255));
		$this->add('start_date',new DateType(true,'start_date'));
		$this->add('end_date',new DateType(true,'end_date'));
		if(Url::get('cmd') == 'add'){
			$this->add('quantity',new IntType(true,'miss_rand_code_quantity'));
		}
		$this->add('value',new FloatType(true,'miss_promotion_value'));
		$this->link_css('skins/default/css/cms.css');
		$this->link_js('packages/core/includes/js/jquery/datepicker.js');
		$this->link_js('packages/core/includes/js/jquery/jquery.autocomplete.js');
		$this->link_css(Portal::template('').'css/jquery/autocomplete.css');
		$this->link_css(Portal::template('').'css/jquery/datepicker.css');	
	}
	function on_submit(){
		if($this->check()){
			$rand_code = false;
			$rows = $this->save_item($rand_code);
			if(!$this->is_error()){
				if(Url::get('cmd')=='edit' and $item = DB::exists_id('promotion_code',Url::iget('id'))){
					$id = Url::iget('id');
					DB::update_id('promotion_code',$rows,$id);
				}else{
					if(Url::get('quantity')){
						$quantity = intval(Url::get('quantity'));
						$i = 1;
						while($i<=$quantity){
							$rand_code = rand(000000,9999999);
							$rows = $this->save_item($rand_code);
							if(!DB::exists('select id from promotion_code where rand_code = "'.$rand_code.'"')){
								$id = DB::insert('promotion_code',$rows);
								$i++;
							}
						} // close while
					}
				}
				if($id){
					echo '<div id="progress"><img src="skins/default/images/indicator.gif" /> Updating to server...</div>';
					echo '<script> window.setTimeout("location=\''.URL::build_current().'\'",2000);</script>';
					exit();
				}
			}
		}
	}
	function draw(){
		if(Url::get('cmd')=='edit' and Url::get('id') and $promotion_code = ManagePromotionCodeDB::get_promotion(Url::get('id'))){
			$promotion_code['start_date'] = Date_Time::to_common_date($promotion_code['start_date']);
			$promotion_code['end_date'] = Date_Time::to_common_date($promotion_code['end_date']);
			foreach($promotion_code as $key=>$value){
				if(is_string($value) and !isset($_REQUEST[$key])){
					$_REQUEST[$key] = $value;
				}
			}
		}
		$this->parse_layout('edit');
	}
	function save_item($rand_code){
		if($rand_code){
			$rows = array('rand_code'=>$rand_code);
		}else{
			$rows = array();
		}
		$rows += array(
			'start_date'=>Date_Time::to_sql_date(Url::get('start_date')),
			'end_date'=>Date_Time::to_sql_date(Url::get('end_date')),
			'value'=>Url::get('value')
		);
		return ($rows);
	}
}
?>
