<?php
/* 	AUTHOR 	:	khoand
	DATE	:	28/09/2011
*/
class TravelBacklinks extends Module
{	
	function TravelBacklinks($row)
	{
		Portal::$document_title =  'Travel Backlinks';
		Portal::$meta_keywords =  'backlinks, vietnam backlinks, travel backlinks, travel backlink, hotel backlinks, resort backlinks, cruise backlinks, tours backlinks';
		Portal::$meta_description =  'Travel Backlinks for Hotels, Resorts, Cruise, Tours and more... optimized and friendly to all the search engines like Google, Yahoo, Bing...';
		Module::Module($row);
		require_once 'db.php';
		require_once 'forms/list.php';
		$this->add_form(new TravelBacklinksForm());				
	}

}
?>