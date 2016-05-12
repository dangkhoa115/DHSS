<?php 
class QuanLyVongDau extends Module{
	function QuanLyVongDau($row){
		Module::Module($row);
		if(User::can_view(false,ANY_CATEGORY)){
			if(Url::get('mua_giai_id')){
				Session::set('mua_giai_id',Url::get('mua_giai_id'));
			}
			if(!Session::is_set('mua_giai_id')){
				Session::set('mua_giai_id',2);
			}
			if(Url::get('do') == 'update_sms_open_time' and $tu_ngay = Url::get('tu_ngay') and $den_ngay = Url::get('den_ngay')){
				$this->update_sms_open_time($tu_ngay,$den_ngay);
				exit();
			}
			require_once 'packages/backend/includes/php/ssnh.php';
			require_once 'forms/edit.php';
			$this->add_form(new EditQuanLyVongDauForm());
		}else{
			URL::access_denied();
		}
	}
	function update_sms_open_time($tu_ngay,$den_ngay){
		if($tu_ngay and $den_ngay){
			//ROOT_PATH
			require_once 'packages/core/includes/utils/nusoap/nusoap.php';
			$client = new SoapClient("http://210.211.101.121:8080/Gateway/Service.asmx?WSDL");
			$params->Param1 = 'VTVlive@LaserAd123$%';
			$params->Param2 = $tu_ngay;
			$params->Param3 = $den_ngay;    
			$client->FixTimeLine($params);
		}
	}
}
?>