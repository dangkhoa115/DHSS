<?php
class ListManageItemForm extends Form{
	function ListManageItemForm(){
		Form::Form('ListManageItemForm');
		$this->link_css('skins/default/css/cms.css');
		$this->link_css('skins/default/css/jquery/window.css');
		if(isset($_SESSION['item_name'])){
			unset($_SESSION['item_name']);
		}
		if(isset($_SESSION['item_id'])){
			unset($_SESSION['item_id']);
		}
	}
	function on_submit(){
		if(Url::get('cmd')){
			switch(Url::get('cmd')){
				case 'update_position':
					$this->save_position();
					break;
				case 'delete':
					if(User::can_admin(false,ANY_CATEGORY)){$this->delete();}
					break;
				case 'check_active':
					$this->check_active();
					break;
				case 'check_hot':
					$this->check_hot();
					break;	
				case 'check_promote':
					$this->check_promote();
					break;		
			}
			Url::redirect_current(array('search','type','checked','is_hot','check_promote','category_id'));
		}
	}
	function draw(){
		$cond = '1 '.(!User::can_edit(false,ANY_CATEGORY)?' AND item.poster = "'.Session::get('user_id').'"':'');
		$cond.=$this->get_condition();
		$this->get_just_edited_id();
		require_once Portal::template_js('core').'/tinymce/init_tinyMCE.php';
		require_once 'packages/core/includes/utils/paging.php';
		$item_per_page = 50;//Url::get('item_per_page',5);
		$this->map['total'] = ManageItemDB::get_total_item($cond);
		$this->map['paging'] = paging($this->map['total'],$item_per_page,10,false,'page_no',array('cmd','checked','is_hote','poster','keyword','category_id'));
		$items = ManageItemDB::get_items($cond,(URL::get('keyword')?'item.content_no_sign':'item.time desc'),$item_per_page);
		foreach($items as $key=>$value){
			//$items[$key]['youtube'] = $value['youtube']?$value['youtube']:'Thêm link youtube';
			$items[$key]['public_price'] = System::display_number($value['public_price']);
			$items[$key]['price'] = System::display_number($value['price']);
		}
		$this->map['items'] = $items;
		$this->map['item_per_page_list'] = array(50=>50,100=>100);
		$this->map['star_list'] = array('0'=>Portal::language('all_star'),'1'=>'1 Star','2'=>'2 Stars','3'=>'3 Stars','4'=>'4 Stars','5'=>'5 Stars');
		$this->map['checked_list'] = array(2=>Portal::language('checked_and_uncheck_item'),'1'=>Portal::language('checked_item'),'0'=>Portal::language('uncheck_item'));
		$this->map['is_hot_list'] = array(2=>Portal::language('hote_or_not_item'),'1'=>Portal::language('hot_item'),'0'=>Portal::language('nornam_item'));
		$this->map['category_options'] = '<option value="">Chọn phân loại</option>';
		$categories = DB::fetch_all('SELECT id,name,structure_id FROM item_category WHERE '.IDStructure::child_cond(ID_ROOT).' order by structure_id');
		foreach($categories as $key=>$value){
			$level = IDStructure::level($value['structure_id']);
			$this->map['category_options'] .= '<option value="'.$value['id'].'">'.(str_pad($value['name'],strlen($value['name'])+$level*3,'--',STR_PAD_LEFT)).'</option>';
		}
		$this->map['category_id_list'] = array(''=>'Chọn phân loại') + String::get_list(DB::fetch_all('SELECT item_category.id,item_category.name FROM item_category WHERE '.IDStructure::child_cond(ID_ROOT,2).' ORDER BY item_category.structure_id'));
		$this->map['category_id'] = Url::get('category_id')?Url::get('category_id'):'';
		$this->parse_layout('list',$this->just_edited_id+$this->map);
	}
	function get_condition(){
		$cond = '';
		if($poster = Url::get('poster')){
			$cond.= ' AND item.poster="'.$poster.'"';
		}
		if($category_id = Url::iget('category_id')){
			$cond.= ' AND '.IDStructure::child_cond(DB::structure_id('item_category',$category_id)).'';
		}
		if(isset($_REQUEST['checked']) and $_REQUEST['checked']!=2){
			$cond.= ' and item.checked='.intval($_REQUEST['checked']);
		}
		if(isset($_REQUEST['is_hot']) and $_REQUEST['is_hot']!=2){
			$cond.= ' and item.is_hot='.intval($_REQUEST['is_hot']);
		}
		if(Url::get('keyword')){
			$cond .= URL::get('keyword')? ' AND (item.name like "%'.Url::sget('keyword').'%" OR REPLACE(item.name_id,"-"," ") like "%'.Url::sget('keyword').'%")':'';
		}
		return $cond;
	}
	function save_position(){
		foreach($_REQUEST as $key=>$value){			
			if(preg_match('/position_([0-9]+)/',$key,$match) and isset($match[1])){
				DB::update_id('item',array('position'=>Url::get('position_'.$match[1])),$match[1]);
			}
		}
		Url::redirect_current(array('search','type','checked','is_hot'));
	}
	function delete(){
		if(isset($_REQUEST['selected_ids']) and count($_REQUEST['selected_ids'])>0 and User::can_admin(false,ANY_CATEGORY)){
			foreach($_REQUEST['selected_ids'] as $key){
				if($item = DB::exists_id('item',$key)){
					save_recycle_bin('item',$item);
					if(file_exists($item['image_url'])){
						@unlink($item['image_url']);
					}
					ManageItemDB::delete_item($key);
					//DB::update_id('item',array('status'=>'HIDE'),$key);
					save_log($key);
				}	
			}
		}	
		Url::redirect_current(array('search','type','checked','is_hot','category_id'));
	}
	function check_active(){
		if($active_id = intval(Url::get('active_id')) and isset($_REQUEST['active_value'])){			
			DB::update_id('item',array('checked'=>$_REQUEST['active_value']),$active_id);
		}
	}
	function check_hot(){
		if($active_id = intval(Url::get('active_id')) and isset($_REQUEST['active_value'])){			
			DB::update_id('item',array('is_hot'=>$_REQUEST['active_value']),$active_id);
		}
	}
	function check_promote(){
		if($active_id = intval(Url::get('active_id')) and isset($_REQUEST['active_value'])){			
			DB::update_id('item',array('promote'=>$_REQUEST['active_value']),$active_id);
		}
	}
	function get_just_edited_id(){
		$this->just_edited_id['just_edited_ids'] = array();
		if (UrL::get('selected_ids')){
			if(is_string(UrL::get('selected_ids'))){
				if (strstr(UrL::get('selected_ids'),',')){
					$this->just_edited_id['just_edited_ids']=explode(',',UrL::get('selected_ids'));
				}
				else{
					$this->just_edited_id['just_edited_ids']=array('0'=>UrL::get('selected_ids'));
				}
			}
		}
	}
	function deleted_selected_id($account_id){
		if($item = DB::exists('select id,account_id from account_privilege where account_id = "'.$account_id.'"')){
			DB::delete_id('account_privilege',$item['id']);
			DB::delete('account_setting','account_id = "'.$item['account_id'].'" and setting_id = "privilege"');
			DB::update('account',array('cache_privilege'=>''),' id ="'.$item['account_id'].'"');
		}
	}
}
?>
