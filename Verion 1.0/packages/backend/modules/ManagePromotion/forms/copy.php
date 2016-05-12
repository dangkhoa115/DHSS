<?php
class CopyManagePromotionForm extends Form
{
	function CopyManagePromotionForm()
	{
		Form::Form('CopyManagePromotionForm');
		//$this->add('category_id',new TextType(true,'invalid_category_id',0,2000));
		$this->link_css('skins/default/css/cms.css');
	}
	function copy_items()
	{
		if($_REQUEST['selected_ids']!='' and $items =@explode(',',$_REQUEST['selected_ids']))
		{
			foreach($items as $key)
			{
				if($promotion = DB::exists_id('promotion',$key))
				{
					unset($promotion['id']);
					$promotion['name_id'] = $promotion['name_id'].date('d-m',time());
					$id = DB::insert('promotion',$promotion);
					save_log($id);
				}
			}
			Url::redirect_current();
		}
	}
	function on_submit()
	{
		switch(Url::get('cmd'))
		{
			case 'copy':
				$this->copy_items();
				break;
		}
	}
	function draw()
	{
		$this->parse_layout('copy');
	}
}
?>
