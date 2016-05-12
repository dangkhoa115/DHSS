<?php 
/******************************
COPY RIGHT BY Catbeloved - Framework

******************************/
class Utils extends Module
{
	function Utils($row)
	{
		if(User::can_admin(false,ANY_CATEGORY))
		{	
			Module::Module($row);
			require_once 'packages/core/includes/utils/xml.php';
			switch(Url::get('cmd'))
			{	
				case 'update':
					$this->update();
					break;	
				default:
					require_once 'forms/list.php';
					$this->add_form(new UtilsForm());			
					break;
			}	
		}
		else
		{
			Url::access_denied();
		}	
	}
	function update_weather()
	{
		$url = 'http://www.nchmf.gov.vn/website/vi-VN/81/Default.aspx';
		$content = @file_get_contents($url);
		$province = '/\<td width=\"20%\" align=left class=\"thoitiet_hientai rightline\"\>([^\<]+)\<\/td\>/';
		$weather = '/\<img src=\"http\:\/\/www\.nchmf\.gov\.vn\/Upload\/WeatherSymbol\/([^\"]+)\" border=0\>/';
		$temperature = '/class=\"thoitiet_hientai rightline\"\>\<strong\>([0-9]+)/';
		if(preg_match_all($province,$content,$matches))
		{
			$name_province = $matches[1];
		}
		if(preg_match_all($weather,$content,$matches))
		{
			$images= $matches[1];
		}
		if(preg_match_all($temperature,$content,$matches))
		{
			$temperatures = $matches[1];
		}
		if(isset($name_province) and isset($temperatures) and isset($images))
		{			
			$items = array();
			foreach($images as $key=>$value)
			{
				$sou = 'http://www.nchmf.gov.vn/Upload/WeatherSymbol/'.$value;
				$des = 'upload/default/icon/'.substr($sou,strrpos($sou,'/')+1);
				if(!file_exists($des))
				{
					@copy($sou,$des);
				}
				$items[$key+1]['id'] = $key+1; 
				$items[$key+1]['images'] = 'http://'.$_SERVER['SERVER_NAME'].'/'.$des; 
				$items[$key+1]['province'] = $name_province[$key]; 
				$items[$key+1]['temperature'] = $temperatures[$key]; 
			}
			XML::create_xml('cache/utils/weather',$items);
		}
	}
	function update_golden()
	{
		$url = 'http://www3.tuoitre.com.vn/transweb/giavang.htm';
		$items = array();
		$content = @file_get_contents($url);
		$pattern_name = '/\<td name=\"Table1_1_1\" class=\"cssMainTD\"\>([^\<]+)\<\/td\>/';
		$pattern_buy  = '/\<TD name=\"Table1_1_2\" class=\"cssTD\"\>([^\<]+)\<\/TD\>/';
		$pattern_sell = '/\<TD name=\"Table1_1_3\" class=\"cssTD\"\>([^\<]+)\<\/TD\>/';
		if(preg_match_all($pattern_name,$content,$matches))
		{
			$names= $matches[1];
		}
		if(preg_match_all($pattern_buy,$content,$matches))
		{
			$buy= $matches[1];
		}
		if(preg_match_all($pattern_sell,$content,$matches))
		{
			$sell= $matches[1];
		}
		if(isset($names) and isset($buy) and isset($sell))
		{
			foreach($names as $key=>$value)
			{
				$items[$key+1]['id'] = $key+1;
				$items[$key+1]['name'] = $value;
				$items[$key+1]['sell'] = $sell[$key];
				$items[$key+1]['buy'] = $buy[$key];				
			}
		}
		XML::create_xml('cache/utils/golden',$items);
	}
	function update_currency()
	{
		require_once 'cache/tables/currency.cache.php';
		XML::create_xml('cache/utils/currency',$currency);
	}
	function update()
	{
		$this->update_weather();
		$this->update_golden();
		$this->update_currency();
		Url::redirect_current();
	}
}
?>