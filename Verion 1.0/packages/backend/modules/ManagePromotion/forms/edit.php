<?php
class EditManagePromotionForm extends Form{
	function EditManagePromotionForm(){
		Form::Form('EditManagePromotionForm');
		//$this->add('promotion_value',new TextType(true,'invalid_promotion_value',0,255));
		$this->add('item_id',new IDType(true,'miss_item_id','item'));
		$this->add('item_name',new TextType(true,'miss_item_name',0,255));		
		$this->add('start_date',new DateType(true,'start_date'));
		$this->add('end_date',new DateType(true,'end_date'));
		$this->add('description',new TextType(true,'miss_description',0,2000));
		$this->link_css('skins/default/css/cms.css');
		$this->link_js('packages/core/includes/js/jquery/datepicker.js');
		$this->link_js('packages/core/includes/js/jquery/jquery.autocomplete.js');
		$this->link_css(Portal::template('').'css/jquery/autocomplete.css');
		$this->link_css(Portal::template('').'css/jquery/datepicker.css');	
	}
	function on_submit(){
		if($this->check()){
			$rows = $this->save_item();
			if(!$this->is_error()){
				if(Url::get('cmd')=='edit' and $item = DB::exists_id('promotion',Url::iget('id'))){
					$id = Url::iget('id');
					DB::update_id('promotion',$rows,$id);
				}else{
					$rows = $this->save_item();
					$id = DB::insert('promotion',$rows);
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
		$this->map = array();
		require_once Portal::template_js('core').'/tinymce/init_tinyMCE.php';
		if(Url::get('cmd')=='edit' and Url::get('id') and $promotion = ManagePromotionDB::get_promotion(Url::get('id'))){
			$promotion['start_date'] = Date_Time::to_common_date($promotion['start_date']);
			$promotion['end_date'] = Date_Time::to_common_date($promotion['end_date']);
			foreach($promotion as $key=>$value){
				if(is_string($value) and !isset($_REQUEST[$key])){
					$_REQUEST[$key] = $value;
				}
			}
		}
		$this->parse_layout('edit',$this->map);
	}
	function save_item(){
		$rows = array(
			'item_id'=>Url::get('item_id'),
			'start_date'=>Date_Time::to_sql_date(Url::get('start_date')),
			'end_date'=>Date_Time::to_sql_date(Url::get('end_date')),
			'description'=>Url::get('description'),
			'price'=>System::calculate_number(Url::get('price'))
		);
		return ($rows);
	}
}
?>
