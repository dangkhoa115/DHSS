<?php
class ManageItemCategoryForm extends Form
{
	function ManageItemCategoryForm()
	{
		Form::Form("ManageItemCategoryForm");
		$this->add('id',new IDType(true,'object_not_exists','item_category'));
	}
	function on_submit()
	{
		if(Url::get('id') and $category=DB::fetch('select id,structure_id from item_category where id='.intval(Url::get('id'))) and User::can_edit(false,ANY_CATEGORY))
		{
			$this->delete($this,$_REQUEST['id']);
			Url::redirect_current();
		}
		else
		{
			Url::redirect_current();
		}
	}
	function draw()
	{
		$this->load_data();
		$this->parse_layout('detail',$this->item_data);
	}
	function delete(&$form,$id)
	{
		$this->item_data = DB::select('item_category',$id);
		 if(file_exists($this->item_data['icon_url']))
		{
			@unlink($this->item_data['icon_url']);
		} 
		DB::delete_id('item_category', $id);
	}
	function load_data()
	{
		DB::query('
			select 
				*
			from 
			 	item_category
			where
				item_category.id = "'.URL::sget('id').'"');
		if($this->item_data = DB::fetch())
		{
		}
	}
	function load_multiple_items()
	{
	}
}
?>