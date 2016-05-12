<?php
class FetchTemplateDB
{
	static function get_category()
	{
		$type='NEWS';
		$sql='
			SELECT
				`item_category`.id
				,`item_category`.`name`
				,`item_category`.structure_id
				,`item_category`.crawler_url
			FROM
				`item_category`
			WHERE 
				item_category.structure_id <> '.ID_ROOT.'
			ORDER BY
			 structure_id';
		$items = DB::fetch_all($sql);				 
		foreach($items as $key=>$value){
			$items[$key]['class'] = 'lv'.IDStructure::level($value['structure_id']);
			$can_crawler = true;
			if(IDStructure::have_child('item_category',$value['structure_id'])){
				$can_crawler = false;
			}
			$items[$key]['can_crawler'] = $can_crawler;
		}
		return $items;
	}	
	function cut_string($content,$pattern_start,$pattern_end)
	{
		if($start=strpos($content,$pattern_start)+strlen($pattern_start) and $finish=strpos($content,$pattern_end,$start))
		{	
			return substr($content,$start,$finish-$start);	
		}	
		return false;
	}
}
?>
