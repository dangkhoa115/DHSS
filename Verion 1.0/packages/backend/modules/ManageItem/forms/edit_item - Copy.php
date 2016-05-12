<?php
class EditItemAdminForm extends Form{
	var $warranty_satus = array();
	function EditItemAdminForm(){
		Form::Form('EditItemAdminForm');
		$this->add('name',new TextType(true,'invalid_name',0,2000)); 
		$this->add('category_id',new TextType(true,'invalid_category_id',0,2000)); 
		$this->link_css('skins/default/css/cms.css');
		$this->link_css('skins/default/css/tabs/tabpane.css');
		//$this->link_css('skins/trieumua/css/colorpicker.css');
		//$this->link_js('skins/trieumua/scripts/colorpicker.js');				
		//$this->link_js('skins/trieumua/scripts/eye.js');
	}
	function on_submit(){		
		if($this->check()){
			$rows = $this->save_item();
			if(!$this->is_error()){
				if(Url::get('cmd')=='edit' and $item = DB::exists_id('item',Url::get('id'))){
					$id = intval(Url::get('id'));
					//$rows += array('last_time_update'=>time());
					DB::update_id('item',$rows,$id);
					$info_rows = array(
						'product_status',
						'accessories',
						'os_id',
						'model_id',
						'specification'
					);
					DB::update_id('item_info',$info_rows,$id);
				}else{
					$rows += array('time'=>time(),'user_id'=>Session::get('user_id'));
					$id = DB::insert('item',$rows);
					$info_rows = array(
						'product_status',
						'accessories',
						'model_id',
						'os_id',
						'warranty',
						'specification',
						'color'
					);
					DB::insert('item_info',array('id'=>$id)+$info_rows);
				}
				//$this->update_store_status($id);
				//$this->update_selling_promotion($id);
				$this->update_warranty_status($id);
				$this->update_form_status($id);	
				$this->save_image('image_url',$id);
				$this->save_item_image($id);
				//save_log($id);
				echo '<script>alert("Cật nhật thành công");window.location="'.Url::build_current().'";</script>';
				exit();
			}	
		}
	}
	function draw(){
		$this->map['item_images'] = array();
		require_once Portal::template_js('core').'/tinymce/init_tinyMCE.php';
		if(Url::get('cmd')=='edit' and Url::iget('id') and $item = ManageItemDB::get_item(Url::iget('id'))){
			$item['price'] = System::display_number($item['price']);
			$item['public_price'] = System::display_number($item['public_price']);
			$item['installment_price'] = System::display_number($item['installment_price']);
			foreach($item as $key=>$value){
				if(is_string($value) and !isset($_REQUEST[$key])){
					$_REQUEST[$key] = $value;
				}
			}
			$item_images = $this->get_item_image($item['id']);
			$i = 1;
			foreach($item_images as $key=>$value){
				$_REQUEST['item_image_url'.$i] = $value['image_url'];
				$i++;
			}
		}
		//$_REQUEST['mi_store_status'] = $this->get_store_status(isset($item['id'])?$item['id']:false);
		$_REQUEST['mi_form_status'] = $this->get_form_status(isset($item['id'])?$item['id']:false);
		$_REQUEST['mi_warranty_status'] = $this->get_warranty_status(isset($item['id'])?$item['id']:false);
		//$_REQUEST['mi_selling_promotion'] = $this->get_selling_promotion(isset($item['id'])?$item['id']:false);
		$this->map['model_id_list'] = array(''=>'Chọn') + String::get_list(ManageItemDB::get_model());
		$this->map['category_id_list'] = String::get_list(ManageItemDB::get_category());
		$this->map['os_id_list'] =  array(''=>'Chọn') + String::get_list(ManageItemDB::get_os());
		$this->parse_layout('edit_item',$this->map);
	}
	function save_item(){
		$rows = array('name'=>Url::get('name'),'content'=>Url::get('content'));
		require_once 'packages/core/includes/utils/vn_code.php';
		require_once 'packages/core/includes/utils/search.php';
		$rows['content_no_sign'] = extend_search_keywords(convert_utf8_to_telex(strip_tags($rows['content'])));
		$rows += array(
			'category_id',
			'price'=>str_replace(',','',Url::get('price')),
			'public_price'=>str_replace(',','',Url::get('public_price')),
			'installment_price'=>str_replace(',','',Url::get('installment_price')),
			'checked'=>Url::check('checked')?1:0,
			'tags'=>Url::get('tags')
			);//			'promote'=>Url::check('promote')?1:0
			if(!Url::get('position')){
				$position = DB::fetch('select max(position)+1 as id from item');
				$rows['position'] = $position['id'];				
			}else{
				$rows['position'] = Url::get('position'); 
			}			
			$name_id = convert_utf8_to_url_rewrite($rows['name']); 			
			if(!DB::fetch('select name_id from item where name_id="'.$name_id.'"')){
				$rows+=array('name_id'=>$name_id);
			}else{
				if(Url::get('id') and Url::get('cmd')=='edit'){
					$rows+=array('name_id'=>$name_id);
				}else{
					$this->error('name','duplicate_name');
				}	
			}		
		return ($rows);
	}
	function save_image($file,$id){
		require_once 'packages/core/includes/utils/upload_file.php';
		$dir = substr(PORTAL_ID,1).'/item/';		
		$row[$file] = update_upload_file($file, $dir,$type='IMAGE',false,264,254,true);
		if($row[$file]){
			DB::update_id('item',$row,$id);
		}
	}
	function save_item_image($id){
		require_once 'packages/core/includes/utils/upload_file.php';
		$dir = substr(PORTAL_ID,1).'/item/';
		for($i=1;$i<=9;$i++){
			$file = 'item_image_url'.$i;
			//$file = 'color'.$i;
			if(isset($_FILES[$file]) and $_FILES[$file]){
				update_upload_file($file,$dir);
				$row = array();
				if(Url::get($file)){
					DB::insert('item_image',array('item_id'=>$id,'image_url'=>Url::get($file)));//,'color'=>Url::get($color)
				}
			}
		}
	}
	function get_item_image($item_id){
		$sql = '
			SELECT
				id,item_id,image_url,description
			FROM
				item_image
			WHERE
				item_image.item_id = '.$item_id.'
		';
		return DB::fetch_all($sql);
	}
	/*function update_store_status($item_id){
		if(isset($_REQUEST['mi_store_status'])){
			foreach($_REQUEST['mi_store_status'] as $key=>$record){
				if($record['id'] and DB::exists_id('store_status',$record['id'])){
					$arr = array('item_id'=>$item_id,'status_id'=>$record['id'],'price'=>System::calculate_number($record['price']));
					if($record['status_id'] and DB::exists_id('store_status_item',$record['status_id'])){
						DB::update('store_status_item',$arr,'id = '.$record['status_id']);
					}else{
						DB::insert('store_status_item',$arr);
					}
				}
			}
		}
	}
	function get_store_status($item_id=false){
		$sql = '
				SELECT 
					store_status.id,store_status.name,ssi.id as status_id,ssi.price
				FROM 
					store_status
					LEFT OUTER JOIN store_status_item AS ssi ON ssi.status_id = store_status.id
				WHERE 
					ssi.id IS NULL '.($item_id?' OR ssi.item_id = '.$item_id.'':'').'
				ORDER BY
					name
				LIMIT
					0,100
		';
		$items = DB::fetch_all($sql);
		foreach($items as $key=>$value){
			$items[$key]['price'] = System::display_number($value['price']);
		}
		return $items;
	}*/
	function update_form_status($item_id){
		if(isset($_REQUEST['mi_form_status'])){
			foreach($_REQUEST['mi_form_status'] as $key=>$record){
				if($record['id'] and DB::exists_id('form_status',$record['id'])){
					$arr = array('item_id'=>$item_id,'status_id'=>$record['id'],'price'=>($record['price'] === "")?"NULL":str_replace(',','',$record['price']),'selected'=>((isset($record['selected']) and $record['selected'])?1:0));
					$arr['relateds'] = $this->get_relates($record['relateds']);
					if($record['status_id'] and DB::exists_id('form_status_item',$record['status_id'])){
						DB::update('form_status_item',$arr,'id = '.$record['status_id']);
					}else{
						if($record['price'] or $record['price'] === "0")
						{
							DB::insert('form_status_item',$arr);
						}
					}
				}
			}
		}
	}
	function get_form_status($item_id=false){
			$sql = '
				SELECT 
					form_status.id,form_status.name,'.($item_id?'fsi.id as status_id,fsi.price,fsi.selected,fsi.relateds':'"" as status_id,"" AS price,0 as selected,"" AS relateds').'
				FROM 
					form_status
					'.($item_id?'LEFT OUTER JOIN form_status_item AS fsi ON fsi.status_id = form_status.id AND fsi.item_id = '.$item_id.'':'').'
				WHERE 
					'.($item_id?'fsi.id IS NULL OR fsi.item_id = '.$item_id.'':'1=1').'
				ORDER BY
					form_status.position
				LIMIT
					0,100
		';
		$items = DB::fetch_all($sql);
		foreach($items as $key=>$value){
			//$items[$key]['price'] = ($value['price']==="0")?0:System::display_number($value['price']);
		}
		return $items;
	}
	function update_warranty_status($item_id){
		$this->warranty_satus = array();
		if(isset($_REQUEST['mi_warranty_status'])){
			foreach($_REQUEST['mi_warranty_status'] as $key=>$record){
				if($record['id'] and DB::exists_id('warranty_status',$record['id'])){
					$arr = array('item_id'=>$item_id,'status_id'=>$record['id'],'price'=>($record['price'] === "")?"NULL":str_replace(',','',$record['price']),'selected'=>((isset($record['selected']) and $record['selected'])?1:0));
					$w_id = 0;
					if($record['status_id'] and DB::exists_id('warranty_status_item',$record['status_id'])){
						$w_id = $record['status_id'];
						DB::update('warranty_status_item',$arr,'id = '.$record['status_id']);
					}else{
						if($record['price'] or $record['price'] === "0"){
							$w_id = DB::insert('warranty_status_item',$arr);
						}
					}
					if($w_id){
						$this->warranty_satus[$key] = $w_id;
					}
				}
			}
		}
	}
	function get_warranty_status($item_id=false){
		$sql = '
				SELECT 
					warranty_status.id,warranty_status.name,'.($item_id?'wsi.id as status_id,wsi.price,wsi.selected':'"" AS status_id,"" AS price,0 as selected').'
				FROM 
					warranty_status
					'.($item_id?'LEFT OUTER JOIN warranty_status_item AS wsi ON wsi.status_id = warranty_status.id and wsi.item_id = '.$item_id.'':'').'
				WHERE 
					 '.($item_id?'wsi.id IS NULL OR wsi.item_id = '.$item_id.'':'1=1').'
				ORDER BY
					warranty_status.position
				LIMIT
					0,100
		';
		$items = DB::fetch_all($sql);
		foreach($items as $key=>$value){
			//$items[$key]['price'] = ($value['price']==="0")?0:System::display_number($value['price']);
		}
		return $items;
	}
	function get_relates($value){
		$result = '';
		$tmp_arr = explode(',',$value);
		$new_arr = array();
		foreach($tmp_arr as $value){
			$new_arr[trim($value)] = trim($value);
		}
		if(!empty($new_arr)){
			if(!empty($this->warranty_satus)){
				$i = 0;
				foreach($this->warranty_satus as $key=>$value){
					if(isset($new_arr[$key])){
						$result .= (($i>0)?',':'').$value;
						$i++;
					}
				}
			}
		}
		return $result;
	}
	/*function update_selling_promotion($item_id){
		if(isset($_REQUEST['mi_selling_promotion'])){
			foreach($_REQUEST['mi_selling_promotion'] as $key=>$record){
				if($record['id'] and DB::exists_id('selling_promotion',$record['id'])){
					$arr = array('item_id'=>$item_id,'promotion_id'=>$record['id'],'price'=>System::calculate_number($record['price']));
					if($record['s_p_id'] and DB::exists_id('selling_promotion_item',$record['s_p_id'])){
						DB::update('selling_promotion_item',$arr,'id = '.$record['s_p_id']);
					}else{
						DB::insert('selling_promotion_item',$arr);
					}
				}
			}
		}
	}
	function get_selling_promotion($item_id=false){
		$sql = '
				SELECT 
					selling_promotion.id,selling_promotion.name,spi.id as s_p_id,spi.price
				FROM 
					selling_promotion
					LEFT OUTER JOIN selling_promotion_item AS spi ON spi.promotion_id = selling_promotion.id
				WHERE 
					spi.id IS NULL '.($item_id?' OR spi.item_id = '.$item_id.'':'').'
				ORDER BY
					name
				LIMIT
					0,100
		';
		$items = DB::fetch_all($sql);
		foreach($items as $key=>$value){
			$items[$key]['price'] = System::display_number($value['price']);
		}
		return $items;
	}*/
}
?>
