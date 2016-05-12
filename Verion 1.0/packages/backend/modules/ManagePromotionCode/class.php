<?php
/******************************
COPY RIGHT BY NYN PORTAL - TCV
WRITTEN BY Khoand
******************************/
class ManagePromotionCode extends Module
{
	function ManagePromotionCode($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if((User::can_view(false,ANY_CATEGORY)))
		{
			switch(Url::get('cmd'))
			{
				case 'add':
					$this->add_cmd();
						break;
				case 'edit':
					$this->edit_cmd();
					break;
				case 'unlink':
					$this->delete_file();
					break;
				case 'copy':
					$this->copy_items();
					break;
				case 'move':
					$this->copy_items();
					break;
				case 'destination' :
					$this->get_destination();
					exit();					
				default:
					$this->list_cmd();
					break;
			}
		}
		elseif(User::can_admin(false, ANY_CATEGORY)){
			Url::redirect('manage_hotel');
		}else{
			Url::access_denied();
		}
	}
	function copy_items()
	{
		if(User::can_edit(false,ANY_CATEGORY) and isset($_REQUEST['selected_ids']) and count($_REQUEST['selected_ids'])>0)
		{
			require_once 'forms/copy.php';
			$this->add_form(new CopyManagePromotionCodeForm());
		}
		else
		{
			Url::redirect_current(array('cmd'=>'list'));
		}
	}
	function delete_file()
	{
		if(Url::get('link') and file_exists(Url::get('link')) and User::can_delete(false,ANY_CATEGORY))
		{
			@unlink(Url::get('link'));
		}
		echo '<script>window.close();</script>';
	}
	function list_cmd()
	{
		require_once 'forms/list.php';
		$this->add_form(new ListManagePromotionCodeForm());
	}
	function add_cmd()
	{
		if(User::can_add(false,ANY_CATEGORY))
		{
			require_once 'forms/edit.php';
			$this->add_form(new EditManagePromotionCodeForm());
		}
		else
		{
			Url::access_denied();
		}
	}
	function edit_cmd()
	{
		if(User::can_edit(false,ANY_CATEGORY))
		{
			require_once 'forms/edit.php';
			$this->add_form(new EditManagePromotionCodeForm());
		}
		else
		{
			Url::access_denied();
		}
	}
	function get_destination()
	{
		$cond_h = $cond_z = $cond_a = '1';
		if($name = Url::sget('q'))
		{
			$cond_h .= ' and hotel.name like "%'.$name.'%"' ;
			$limit = ' limit 0,'.Url::get('limit',30);
			$result = DB::fetch_all('
					SELECT
						hotel.id,
						hotel.name
					FROM
						hotel
						inner join zone on zone.id = hotel.zone_id
					WHERE
						hotel.is_active
						and hotel.status != "HIDE"
						and zone.status != "HIDE"
						and '.$cond_h
					.'GROUP BY
						hotel.name
					'.$limit);
		}
		$i = 1;
		foreach ($result as $key=>$value) {
			echo $key.'|'.$value['name']."\n";
		}
	}	
}
?>
