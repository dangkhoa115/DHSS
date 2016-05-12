<?php
class CopyGameAdminForm extends Form
{
	function CopyGameAdminForm()
	{
		Form::Form('CopyGameAdminForm');	
		$this->add('category_id',new TextType(true,'invalid_category_id',0,2000)); 	
		$this->link_css('skins/default/css/cms.css');
	}
	function copy_items()
	{
		if(Url::get('category_id') and $_REQUEST['selected_ids']!='' and $items =@explode(',',$_REQUEST['selected_ids']))
		{
			foreach($items as $key)
			{
				if($game = DB::exists_id('game',$key))
				{
					unset($game['id']);
					$game['category_id'] = intval(Url::get('category_id'));
					$game['name_id'] = $game['name_id'].date('d-m',time());		
					$id = DB::insert('game',$game);
					save_log($id);
				}	
			}	
			Url::redirect_current();
		}	
	}
	function move_items()
	{
		if(Url::get('category_id') and $_REQUEST['selected_ids']!='' and $items =@explode(',',$_REQUEST['selected_ids']))
		{
			foreach($items as $key)
			{
				DB::update_id('game',array('category_id'=>intval(Url::get('category_id'))),$key);
			}	
			Url::redirect_current();
		}		
	}
	function on_submit()
	{
		switch(Url::get('cmd'))
		{			
			case 'move':
				$this->move_items();
				break;
			case 'copy':
				$this->copy_items();	
				break;	
		}	
	}
	function draw()
	{		
		$this->parse_layout('copy',array(
			'category_id_list'=>String::get_list(GameAdminDB::get_category())
		));
	}
}
?>
