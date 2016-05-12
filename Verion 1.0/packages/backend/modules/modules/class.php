<?php
/******************************
COPY RIGHT BY Catbeloved - Framework

******************************/
class HotelAdmin extends Module
{
	function HotelAdmin($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view(false,ANY_CATEGORY) and isset($_SESSION['hotel_id']))
		{
			switch(Url::get('cmd'))
			{
				case 'unlink':
					$this->delete_file();
					break;
				case 'get_district':
					$this->get_district();
					exit();
				default:
					$this->edit_cmd();
			}
		}
		else
		{
			if(User::can_admin(false,ANY_CATEGORY))
			{
				Url::redirect('manage_hotel');
			}
			else
			{
				Url::access_denied();
			}
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
	function edit_cmd()
	{
		if(User::can_edit(false,ANY_CATEGORY))
		{
			require_once 'forms/edit.php';
			$this->add_form(new EditHotelAdminForm());
		}	
		else
		{
			Url::access_denied();
		}
	}
	function get_district()
	{
		if($city_id = intval(Url::get('city_id')) and $city = DB::fetch('select id,structure_id from zone where id='.$city_id))
		{
			$sql = 'select id,name from zone where (type=4 or type=5) and '.IDStructure::child_cond($city['structure_id']);
			if($items = DB::fetch_all($sql) and !empty($items))
			{
				echo '<option value="0"> Select district </option>';
				foreach($items as $key=>$value)
				{
					echo 'option += \'<option value="'.$key.'">'.str_replace('\'','\\\'',$value['name']).'</option>\';';
				}
			}else
			{
				echo '<option value="0"> No district in this city</option>';
			}
		}else
		{
			echo 'false';
		}
	}
}
?>
