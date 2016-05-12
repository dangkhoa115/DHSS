<?php
class EditCustomerServiceAdminForm extends Form
{
	function EditCustomerServiceAdminForm()
	{
		Form::Form('EditCustomerServiceAdminForm');
		//$this->add('phone',new TextType(true,'invalid_phone',0,2000)); 
		$this->link_css('skins/default/css/cms.css');
	}
	function save_item()
	{
		$rows = array(
			'name'=>Url::get('name'),
			'brief'=>Url::get('brief'),
			'type',
			'phone',
			'zone_id'
		); 
		return $rows;
	}
	function save_image($file,$id)
	{
		require_once 'packages/core/includes/utils/upload_file.php';
		$dir = substr(PORTAL_ID,1).'/content/';		
		update_upload_file('image_url',$dir);
		$row = array();
		if(Url::get('image_url')!='')
		{
			$row['image_url'] =Url::get('image_url');
		}
		DB::update_id('customer_service',$row,$id);
	}
	function on_submit()
	{		
		//if($this->check())
		//{
			$rows = $this->save_item();
			if(!$this->is_error())
			{
				if(Url::get('cmd')=='edit' and $item = DB::exists_id('customer_service',Url::get('id')))
				{
					$id = intval(Url::get('id'));
					DB::update_id('customer_service',$rows,$id);
				}
				else
				{
					$rows += array('time'=>time());
					$id = DB::insert('customer_service',$rows);
				}
				$this->save_image($_FILES,$id);
				if($id)
				{
					echo '<script>if(confirm("'.Portal::language('update_success_are_you_continous').'")){location="'.Url::build_current(array('cmd'=>'add')).'";}else{location="'.Url::build_current(array('cmd'=>'list','just_edited_id'=>$id)).'";}</script>';
				}
			}	
		//}
	}
	function draw()
	{		
		require_once Portal::template_js('core').'/tinymce/init_tinyMCE.php';
		if(Url::get('cmd')=='edit' and Url::get('id') and $news = DB::exists_id('customer_service',intval(Url::get('id'))))
		{
			foreach($news as $key=>$value)
			{
				if(is_string($value) and !isset($_REQUEST[$key]))
				{
					$_REQUEST[$key] = $value;
				}
			}
		}
		require_once 'cache/tables/cities.cache.php';
		$zone_id = 73;
		$types = array('0'=>'SERVICE',1=>'RESERVATION');
		$this->parse_layout('edit',array(
			'zone_id_list'=>String::get_list($cities),
			'zone_id'=>$zone_id,
			'type_list'=>$types
		));
	}
}
?>
