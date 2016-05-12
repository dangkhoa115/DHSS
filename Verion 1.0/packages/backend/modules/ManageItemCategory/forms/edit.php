<?php
class EditManageItemCategoryForm extends Form{
	function EditManageItemCategoryForm(){
		Form::Form('EditManageItemCategoryForm');
		if(URL::get('cmd')=='edit'){
			$this->add('id',new IDType(true,'object_not_exists','item_category'));
		}
		$this->add('name',new TextType(true,'invalid_name',0,2000));
		$this->link_css('skins/default/css/tabs/tabpane.css');
	}
	function on_submit(){
		require_once 'packages/core/includes/utils/upload_file.php';
		$dir = 'default/icon/';
		update_upload_file('icon_url',$dir);
		if($this->check() and URL::get('confirm_edit')){
				if(URL::get('cmd')=='edit'){
					$this->old_value = DB::select('item_category','id="'.addslashes($_REQUEST['id']).'"');
					if(file_exists($this->old_value['icon_url'])){
						@unlink($this->old_value['icon_url']);		
					}	
				}
				$this->save_item();
				Url::redirect_current(array('just_edited_id'=>$this->id));
		}
	}	
	function draw(){
		require_once 'cache/config/status.php';
		$this->can_delete = false;
		$this->init_edit_mode();
		$this->get_parents();
		$this->parse_layout('edit',
			($this->edit_mode?$this->init_value:array())+
			array(
			'can_delete'=>$this->can_delete,
			'status_list'=>$status,
			'parent_id_list'=>String::get_list($this->parents),
			'parent_id'=>($this->edit_mode?si_parent_id('item_category',$this->init_value['structure_id']):1)
			)
		);
	}
	function save_item(){
		require_once 'packages/core/includes/utils/vn_code.php';
		$name = str_replace(array('&','\'','<','>','<br>','<br />'),'',Url::sget('name'));
		//$content = str_replace(array("\n"),array('. '),$content);
		$name_id = convert_utf8_to_url_rewrite($name);
		$new_row = array(
			'name',
			'status',
			'name_id'=>$name_id
		);
		if(Url::get('icon_url')!=""){
			$new_row['icon_url'] = Url::get('icon_url');
		}
		if(URL::get('cmd')=='edit'){
			$this->id = $_REQUEST['id'];
			DB::update_id('item_category', $new_row,$this->id);
			if($this->old_value['structure_id']!=ID_ROOT){
				if (Url::check(array('parent_id'))){
					$parent = DB::select('item_category',$_REQUEST['parent_id']);					
					if($parent['structure_id']==$this->old_value['structure_id']){
						$this->error('id','invalid_parent');
					}else{
						require_once 'packages/core/includes/system/si_database.php';
						if(!si_move('item_category',$this->old_value['structure_id'],$parent['structure_id'])){
							$this->error('id','invalid_parent');
						}
					}
				}
			}
		}else{
			require_once 'packages/core/includes/system/si_database.php';
			if(isset($_REQUEST['parent_id'])){	
				$this->id = DB::insert('item_category', $new_row+array('structure_id'=>si_child('item_category',structure_id('item_category',$_REQUEST['parent_id']))));			
			}else{
				$this->id = DB::insert('item_category', $new_row+array('structure_id'=>ID_ROOT));		
			}				
		}
		save_log($this->id);
	}
	function init_edit_mode(){
		if(URL::get('cmd')=='edit' and $this->init_value = DB::fetch('select * from item_category where id='.(URL::iget('id')).'')){		
			$level = IDStructure::level($this->init_value['structure_id']);
			$this->can_delete = false;
			if($level > 1 or User::is_admin()){
				$this->can_delete = true;	
			}
			foreach($this->init_value as $key=>$value){
				if(!isset($_REQUEST[$key])){
					$_REQUEST[$key] = $value;
				}
			}
			$this->edit_mode = true;
		}else{
			$this->edit_mode = false;
		}
	}
	function get_parents(){
		require_once 'packages/core/includes/system/si_database.php';
		$sql = '
			select 
				id,
				structure_id
				,name
			from 
			 	item_category
			where 
				1
			order by 
				structure_id
		';
		$this->parents = DB::fetch_all($sql,false);		
	}	
}
?>