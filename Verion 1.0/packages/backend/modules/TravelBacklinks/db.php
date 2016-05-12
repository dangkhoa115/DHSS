<?php
class TravelBacklinksDB{
	function get_destination($cond=false){
		require_once('cache/tables/zones.cache.php');
		return $zones;
	}
}
?>