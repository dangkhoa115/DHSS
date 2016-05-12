<?php
/******************************
COPY RIGHT BY TCV PORTAL
WRITTEN BY Khoand
******************************/
class ManageItem extends Module
{
	function ManageItem($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::is_login()){
			switch(Url::get('cmd'))
			{
				case 'add':
					$this->add_cmd();
					break;
				case 'edit':
					$this->edit_cmd();
					break;	
				case 'delete_one':
					if(User::can_delete(false,ANY_CATEGORY)){
						if(Url::get('item_id') and $item = DB::exists_id('item',Url::iget('item_id'))){
							if(file_exists($item['image_url'])){
								@unlink($item['image_url']);
							}
							ManageItemDB::delete_item($item['id']);
							//DB::update_id('item',array('status'=>'HIDE'),$key);
							save_log($item['id']);
							echo '<script>
							if(window.opener){
								window.close();
								window.opener.location.reload();
							}
							</script>';
							exit();
						}	
					}	
				case 'update_content':
					$this->update_content();
					exit();
				case 'update_name':
					$this->update_name();
					exit();	
				case 'update_price':
					$this->update_price();
					exit();		
				case 'update_youtube':
					$this->update_youtube();
					exit();	
				case 'update_category':
					$this->update_category();
					exit();		
				case 'update_image_url':
					$this->update_image_url();
					exit();
				case 'unlink':
					if(Url::get('link')){
						if(Url::get('id') and DB::exists('SELECT id FROM item WHERE item.id = '.Url::iget('id').''.(!User::can_edit(false,ANY_CATEGORY)?' AND item.poster = "'.Session::get('user_id').'"':''))){
							if(file_exists(ROOT_PATH.Url::get('link')) and unlink(ROOT_PATH.Url::get('link'))){
								DB::update('item',array('image_url'=>''),'id='.Url::iget('id'));
							}
							Url::redirect_current(array('id','cmd'=>'edit'));	
						}else{
							Url::access_denied();
						}
					}
					break;
				case 'unlink_item_image':
					if(Url::get('id') and DB::exists('SELECT id FROM item WHERE item.id = '.Url::iget('id').''.(!User::can_edit(false,ANY_CATEGORY)?' AND item.poster = "'.Session::get('user_id').'"':''))){
						if($item = DB::fetch('select id,image_url from item_image where item_id = '.Url::iget('id').' and image_url = "'.Url::get('link').'"')){
							@unlink($item['image_url']);
							DB::delete('item_image','id='.$item['id'].'');
						}
						Url::redirect_current(array('id','cmd'=>'edit'));	
					}else{
						Url::access_denied();
					}
					break;
				case 'up':
					$this->up_create_time(Url::iget('id'));
					Url::redirect_current(array('page_no','keyword','poster'));
					break;
				default:					
					$this->list_cmd();
			}
		}
		else{
			Url::access_denied();
		}
	}
	function list_cmd()
	{
		require_once 'forms/list.php';
		$this->add_form(new ListManageItemForm());
	}
	function edit_cmd(){
		if(Url::get('id') and DB::exists('SELECT id FROM item WHERE item.id = '.Url::iget('id').''.(!User::can_edit(false,ANY_CATEGORY)?' AND item.poster = "'.Session::get('user_id').'"':''))){
			require_once 'forms/edit_item.php';
			$this->add_form(new EditItemAdminForm());
		}else{
			Url::access_denied();
		}
	}
	function add_cmd(){
		require_once 'forms/edit_item.php';
		$this->add_form(new EditItemAdminForm());
	}
	function up_create_time($id){
		DB::update('item',array('time'=>time()),'item.id = '.Url::iget('id').''.(!User::can_edit(false,ANY_CATEGORY)?' AND item.poster = "'.Session::get('user_id').'"':''));
	}
	function update_content()
	{
		if($item_id = Url::iget('item_id') and $item = DB::fetch('select * from item where id='.$item_id)){
			require_once 'packages/core/includes/utils/vn_code.php';
			$content = Url::sget('content');
			$content_no_sign = str_replace(array('-','&','"','\'','!'),' ',convert_utf8_to_url_rewrite($content));
			DB::update('item',array('content'=>$content,'content_no_sign'=>$content_no_sign),'id='.$item_id);
		}
	}
	function update_name()
	{
		if($item_id = Url::iget('item_id') and $item = DB::fetch('select * from item where id='.$item_id)){
			require_once 'packages/core/includes/utils/vn_code.php';
			$name = Url::sget('content');
			$name_id = convert_utf8_to_url_rewrite($name);
			DB::update('item',array('name'=>$name,'name_id'=>$name_id),'id='.$item_id);
		}
	}
	function update_price()
	{
		if($item_id = Url::iget('item_id') and $item = DB::fetch('select * from item where id='.$item_id)){
			$price = str_replace(array(' ',','),'',Url::get('content'));
			DB::update('item',array('price'=>$price),'id='.$item_id);
		}
	}
	function update_youtube()
	{
		if($item_id = Url::iget('item_id') and $item = DB::fetch('select * from item where id='.$item_id)){
			$content = Url::get('content')?Url::get('content'):'';
			DB::update('item',array('youtube'=>$content),'id='.$item_id);
		}
	}
	function update_category()
	{
		if(Url::get('category_id') and $item_id = Url::iget('item_id') and $item = DB::fetch('select * from item where id='.$item_id)){
			$category_id = Url::get('category_id');
			DB::update('item',array('category_id'=>$category_id),'id='.$item_id);
		}
	}
	function update_image_url(){
		require_once 'packages/core/includes/utils/upload_file.php';
		$dir = 'modern/item';
		echo '{"error":"'.Url::get('item_id').'"';
		if(Url::get('item_id') and $row = DB::fetch('select * from item where id ='.Url::iget('item_id').'')){
			$image_url = $this->upload_image('image_url_'.$row['id']);
			if($image_url){
				if(file_exists($row['image_url'])){
					unlink($row['image_url']);
					unlink(str_replace('image_url','thumb_url',$row['image_url']));
				}
				DB::update('item',array('image_url'=>$image_url),'id='.$row['id']);
				echo ',"msg":"'.$image_url.'"';
			}
		}
		echo '}';
	}
	function upload_image($image_file_name){
			require_once('packages/core/includes/utils/upload_file.php');
			$field = $image_file_name;
			$dir = 'default/item';
			return update_upload_file($field, $dir,$type='IMAGE',false,184,116,true);
	}
}
?>
