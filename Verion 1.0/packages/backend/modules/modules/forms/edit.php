<?php
class EditHotelAdminForm extends Form
{
	function EditHotelAdminForm()
	{
		Form::Form('EditHotelAdminForm');
		$this->add('zone_id',new TextType(true,'invalid_zone_id',0,2000)); 
		$this->link_css('skins/default/css/cms.css');
		$this->link_css('skins/default/css/tabs/tabpane.css');
		$this->link_js('skins/default/css/tabs/tabpane.js');
		$this->link_js('packages/core/includes/js/jquery/jquery.autocomplete.js');
		$this->link_css(Portal::template('').'css/jquery/autocomplete.css');
	}
	function save_item()
	{
		$rows = array();
		require_once 'packages/core/includes/utils/vn_code.php';
		require_once 'packages/core/includes/utils/search.php';
		require_once 'packages/core/includes/utils/format_text.php';
		$zone_id = 0;
		if(Url::get('district_id') and DB::exists('select id from zone where id = '.Url::iget('district_id').'')){
			$zone_id = Url::get('district_id');
		}elseif(Url::get('city_id') and DB::exists('select id from zone where id = '.Url::iget('city_id').'')){
			$zone_id = Url::get('city_id');
		}
		$rows += array(
				'type',
				'street',
				'brief'=>$this->remove_image(remove_js(Url::get('brief'))),
				'description'=>$this->remove_image(remove_js(Url::get('description'))),
				'important_information'=>$this->remove_image(remove_js(Url::get('important_information'))),
				'show_important_information'=>Url::get('show_important_information')=='on'?1:0,
				'room_information'=>$this->remove_image(remove_js(Url::get('room_information'))),
				'show_room_information'=>Url::get('show_room_information')=='on'?1:0,
				'area_information'=>$this->remove_image(remove_js(Url::get('area_information'))),
				'show_area_information'=>Url::get('show_area_information')=='on'?1:0,
				'food_bebagage'=>$this->remove_image(remove_js(Url::get('food_bebagage'))),
				'show_food_bebagage'=>Url::get('show_food_bebagage')=='on'?1:0,
				'zone_id'=>$zone_id,
				'number_of_room',
				'website',
				'telephone',
				'fax',
				'latitude'=>Url::get('lat'),
				'longtitude'=>Url::get('long'),
				'site_title',
				'site_keyword',
				'site_quote',
				'status'=>isset($_REQUEST['is_shown'] and $_REQUEST['is_shown'])?'SHOW':'HIDE'
			);
		if(User::can_admin(false,ANY_CATEGORY))
		{
			if($hotel_name = Url::get('name'))
			{
				$rows += array('name'=>$hotel_name);
				$rows += array('name_id'=>convert_utf8_to_url_rewrite($hotel_name));
			}
			if($star = Url::get('star'))
			{
				$rows += array('star'=>$star);
			}
		}else{
			$rows += array('status'=>'HIDE');
		}
		return ($rows);
	}
	function save_image($file,$id)
	{
		require_once 'packages/core/includes/utils/upload_file.php';
		$dir = substr(PORTAL_ID,1).'/content/';		
		//update_upload_file('small_thumb_url',$dir);
		$image_size = 500;
		update_upload_file('image_url',$dir,'IMAGE',false,$image_size,false, true);
		$row = array();
		if(Url::get('image_url')!='')
		{
			$row['image_url'] = Url::get('image_url');
		}
		DB::update_id('hotel',$row,$id);
	}
	function update_themes($id)
	{
		if($themes = Url::get('themes') and is_array($themes))
		{
			$current_themes = DB::fetch_all('select * from hotel_theme where hotel_id = '.$id);
			foreach($themes as $key=>$value)
			{
				if(isset($current_themes[$key]))
				{
					unset($current_themes[$key]);
				}else
				{
					DB::insert('hotel_theme',array('hotel_id'=>$id,'theme_id'=>$value));
				}
			}
			if(!empty($current_themes))
			{
				foreach($current_themes as $key=>$value)
				{
					DB::delete_id('hotel_theme',$key);
				}
			}
		}else
		{
			DB::delete('hotel_theme','hotel_id='.Session::get('hotel_id'));
		}
	}
	function update_credit_cards($id)
	{
		if($credit_cards = Url::get('credit_cards') and is_array($credit_cards))
		{
			$current_credit_cards = DB::fetch_all('select * from hotel_credit_card where hotel_id = '.$id);
			foreach($credit_cards as $key=>$value)
			{
				if(isset($current_credit_cards[$key]))
				{
					unset($current_credit_cards[$key]);
				}else
				{
					DB::insert('hotel_credit_card',array('hotel_id'=>$id,'credit_card_id'=>$value));
				}
			}
			if(!empty($current_credit_cards))
			{
				foreach($current_credit_cards as $key=>$value)
				{
					DB::delete_id('hotel_credit_card',$key);
				}
			}
		}else
		{
			DB::delete('hotel_credit_card','hotel_id='.Session::get('hotel_id'));
		}
	}
	function on_submit()
	{
		if($this->check() and User::is_admin() or (Session::is_set('hotel_id') and Session::get('hotel_id')==Url::get('hotel_id')))
		{
			$rows = $this->save_item();
			$id = Session::get('hotel_id');
			if($item = DB::exists_id('hotel',$id))
			{
				$rows += array('last_time_update'=>time());
				DB::update_id('hotel',$rows,$id);
				$this->update_themes($id);
				$this->update_credit_cards($id);
				$this->save_image($_FILES,$id);
				save_log($id);
				echo '<div id="progress"><img src="skins/default/images/indicator.gif" /> Updating to server...</div>';
				echo '<script> window.setTimeout("location=\''.URL::build('manage_hotel').'\'",2000);</script>';
				exit();
			}
			else
			{
				$this->error('update_error','Have an error when updating');
			}
		}else
		{
			$this->error('update_error','Have an error when updating.Maybe you are editting another hotel or Your session is expried');
		}
		
	}
	function draw()
	{
		//echo $_SESSION['hotel_id'];
		//DB::update('hotel',array('type_of_accommodation'=>4),1);
		$this->map = array();
		$this->map['image_url'] = '';
		if(isset($_SESSION['hotel_id']) and $hotel = DB::exists_id('hotel',intval($_SESSION['hotel_id'])))
		{
			if(!$hotel['zone_id']){
				$hotel['zone_id'] = 0;
			}
			$id = intval($_SESSION['hotel_id']);
			require_once Portal::template_js('core').'/tinymce/init_tinyMCE.php';
			require_once 'cache/config/status.php';
			require_once 'cache/config/accomodation.php';
			$this->map['type_of_accommodation_list'] = $accomodation;
			$this->map['is_shown'] = $hotel['status']=="HIDE"?0:1;
			$this->map['is_active'] = $hotel['is_active']?1:0;
			$this->map['star'] = $hotel['star'];
			$this->map['name'] = $hotel['name'];
			$this->map['show'] = $hotel['status']=="HIDE"?0:1;
			$this->map['image_url'] = $hotel['image_url'];
			$this->map['accommodation'] = isset($accomodation[$hotel['type_of_accommodation']])?$accomodation[$hotel['type_of_accommodation']]:'HOTEL';
			$this->map['hotel_id'] = $hotel['id'];
			if($hotel['image_url'] and file_exists($hotel['image_url']))
			{
				$this->map['image_url'] = $hotel['image_url'];
			}
			foreach($hotel as $key=>$value)
			{			
				if(is_string($value) and !isset($_REQUEST[$key]))
				{
					$_REQUEST[$key] = $value;
				}
			}
			if(!$hotel['latitude'] and $hotel['zone_id'] and $zone = DB::fetch('select id,lat,zone.long from zone where id = '.$hotel['zone_id']))
			{
				$_REQUEST['latitude'] = $zone['lat'];
				$_REQUEST['longtitude'] = $zone['long'];
			}
			//System::debug($_REQUEST);
			require_once 'cache/tables/cities.cache.php';
			$this->map['city_id_list'] = array(0=>'Select City')+String::get_list($cities);
			if($district = DB::fetch('select id,structure_id from zone where id = '.$hotel['zone_id'].' and type = 4')){
				$_REQUEST['district_id'] = $district['id'];
				$this->map['district_id_list'] = String::get_list(DB::fetch_all('select id,name from zone where '.IDStructure::direct_child_cond(IDStructure::parent($district['structure_id'])).' and type = 4'));
				$parent = IDStructure::parent($district['structure_id']);
				$_REQUEST['city_id'] = DB::fetch('SELECT id FROM zone WHERE structure_id = '.$parent.'','id');
			}else{
				if($hotel['zone_id'] and $zone = DB::fetch('select id,lat,zone.long,zone.type,zone.structure_id from zone where id = '.$hotel['zone_id'].' and type = 3'))
				{
					$_REQUEST['city_id'] = $zone['id'];
					$this->map['district_id_list'] = array(''=>'Select City first') + String::get_list(DB::fetch_all('select id,name from zone where '.IDStructure::direct_child_cond($zone['structure_id']).' and type = 4'));
					$_REQUEST['district_id'] = 0;
				}
			}
			$this->map['star_list'] = array(1=>'1 star',2=>'2 stars',3=>'3 stars',4=>'4 stars',5=>'5 stars',6=>'6 stars',7=>'7 stars');
			$this->map['themes'] = DB::fetch_all(
						'select
							theme.*, hotel.id as hotel_theme_id, IF(hotel.theme_id,"checked","") as checked
						from
							theme
							left outer join 
							(
								select
									hotel_theme.id,hotel_theme.theme_id, hotel.name
								from
									hotel_theme
									inner join hotel on hotel.id = hotel_theme.hotel_id
									inner join theme on theme.id = hotel_theme.theme_id
								where
									hotel.id = '.$id.'
							) as hotel on theme.id = hotel.theme_id
						');
			$this->map['credit_cards'] = DB::fetch_all(
							'select
								credit_card.*, hotel.id as hotel_credit_card_id, IF(hotel.credit_card_id,"checked","") as checked
							from
								credit_card
								left outer join 
								(
									select
										hotel_credit_card.id,hotel_credit_card.credit_card_id, hotel.name
									from
										hotel_credit_card
										inner join hotel on hotel.id = hotel_credit_card.hotel_id
										inner join credit_card on credit_card.id = hotel_credit_card.credit_card_id
									where
										hotel.id = '.$id.'
								) as hotel on credit_card.id = hotel.credit_card_id
							');
			require_once('cache/config/hotel_type.php');
			$this->map['type_list'] = $hotel_type;
			$hotel_acccount = DB::fetch('select * from hotel_account where hotel_id = '.$hotel['id'].'');
			$contacts = DB::fetch_all('select * from party where user_id="'.$hotel_acccount['account_id'].'" order by id');
			require_once('cache/config/gender.php');
			$this->map['contact_full_name'] = '';
			$this->map['contact_gender'] = '';
			$this->map['contact_position'] = '';
			$this->map['contact_birth_date'] = '';
			$this->map['contact_telephone'] = '';
			$this->map['contact_email'] = '';
			foreach($contacts as $key=>$value)
			{
				if(isset($value['type']) and isset($value['type']))
				{
					if($value['type']=='CONTACT')
					{
						$this->map['contact_full_name'] = $value['full_name'];
						$this->map['contact_gender'] = $genders[$value['gender']];
						$this->map['contact_position'] = $value['position'];
						$this->map['contact_birth_date'] = Date_Time::to_common_date($value['birth_date']);
						$this->map['contact_telephone'] = $value['telephone'];
						$this->map['contact_email'] = $value['email'];
					}
				}
			}
			$this->parse_layout('edit',$this->map);
		}
	}
	function remove_image($content)
	{
		return preg_replace('/\<img[^>]+\>/','',$content);
	}
}
?>