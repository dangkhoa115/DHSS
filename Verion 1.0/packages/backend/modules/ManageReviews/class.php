<?php 
/******************************
COPY RIGHT BY Catbeloved - Framework

******************************/
class ManageReviews extends Module
{
	function ManageReviews($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view(false,ANY_CATEGORY))
		{
			switch(Url::get('cmd'))
			{
				case 'delete':
					$this->delete_comment();
					break;
				case 'check':
					$this->check_comment();
					break;
				case 'get_cities':
					$this->get_cities();
					exit();
				default:
					require_once 'forms/list.php';
					$this->add_form(new ManageReviewsForm());
					break;
			}
		}
		else
		{
			Url::access_denied();
		}	
	}
	function delete_comment()
	{
		if(User::can_delete(false,ANY_CATEGORY) and Url::get('id') and $item = DB::fetch('select * from hotel_review where id = '.intval(Url::get('id'))))
		{
			DB::delete('hotel_review','id='.intval(Url::get('id')));
		}
		Url::redirect_current();	
	}
	function check_comment()
	{
		$sql = 'select 
					hotel_review.id,hotel_review.status,hotel.name as hotel_name, 
					hotel.name_id as hotel_name_id,hotel.id as hotel_id,
					zone.name as hotel_zone_id,
					booking.email as guest_email, booking.full_name
				from 
					hotel_review 
					inner join hotel on hotel.id = hotel_review.hotel_id
					inner join zone on zone.id = hotel.zone_id
					inner join booking on booking.id = hotel_review.booking_id
				where 
					hotel_review.id='.intval(Url::sget('id'));
		if(User::can_edit(false,ANY_CATEGORY) and  Url::get('id') and $review = DB::fetch($sql))
		{
			DB::update('hotel_review',array('status'=>$review['status']=="SHOW"?'HIDE':'SHOW'),'id='.intval(Url::sget('id')));			
			if($review['status']=="HIDE")
			{
				//Send mail for hotel
				if($party = DB::fetch('select * from party where type = "CONTACT" and user_id = "hotel'.$review['hotel_id'].'"'))
				{
					$email_title = 'New review for '.$review['hotel_name'].' on Checkinvietnam.com';
					$email_content = file_get_contents('cache/email_template/check_review.html');
					$array_data = array('[[|name|]]','[[|link|]]','[[|logo_src|]]');
					$array_replace = array($review['hotel_name'],
											'http://'.$_SERVER['SERVER_NAME'].'/'.Url::build('hotel',array('hotel_zone_id'=>$review['hotel_zone_id'],'name_id'=>$review['hotel_name_id']),REWRITE).'?cmd=review',
											'http://'.$_SERVER['HTTP_HOST'].'/skins/booking/images/banner/logo.jpg'
									);
					$email_content = str_replace($array_data,$array_replace,$email_content);
					System::send_mail('info@modern.net',$party['email'],$email_title,$email_content);
				}
				//Send for guest
				$email_title = 'Your review for '.$review['hotel_name'].' has been posted on Checkinvietnam.com';
				$email_content = file_get_contents('cache/email_template/mail_for_guest_when_review_public.html');
				$array_data = array('[[|full_name|]]','[[|link|]]','[[|hotel_name|]]','[[|logo_src|]]');
				$array_replace = array($review['full_name'],
										'http://'.$_SERVER['SERVER_NAME'].'/'.Url::build('hotel',array('hotel_zone_id'=>$review['hotel_zone_id'],'name_id'=>$review['hotel_name_id']),REWRITE).'?cmd=review',
										$review['hotel_name'],
										'http://'.$_SERVER['HTTP_HOST'].'/skins/booking/images/banner/logo.jpg'
									);
				$email_content = str_replace($array_data,$array_replace,$email_content);
				System::send_mail(Portal::get_setting('email_webmaster','info@modern.net'),$review['guest_email'],$email_title,$email_content);
			}
			Url::redirect_current(array('cmd'=>'success'));
		}
	}
	function get_cities()
	{
		if($country_id = intval(Url::get('country_id')) and $country = DB::fetch('select id,structure_id from zone where type=2 and id='.$country_id))
		{
			$sql = 'select id,name from zone where (type=4 or type=3) and '.IDStructure::child_cond($country['structure_id']);
			if($cities = DB::fetch_all($sql) and !empty($cities))
			{
				echo '<option value="0"> Select city </option>';
				foreach($cities as $key=>$value)
				{
					echo '<option value="'.$key.'">'.$value['name'].'</option>';
				}
			}else
			{
				echo '<option value="0"> No city in this country </option>';
			}
		}else
		{
			echo '<option value="0"> Select Country first </option>';
		}
	}
}
?>