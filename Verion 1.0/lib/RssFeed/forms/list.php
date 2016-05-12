<?php
class RssFeedForm extends Form
{
	function RssFeedForm()
	{
		Form::Form('RssFeedForm');
		$this->link_css(Portal::template('news').'/css/rss.css');
	}	
	function draw()
	{
		$this->map = array();
		require_once 'packages/core/includes/utils/format_text.php';
		$cond = 'portal_id="'.PORTAL_ID.'" and status!="HIDE" and type="NEWS" and '.IDStructure::direct_child_cond(ID_ROOT).'';
		$this->map['category'] = RssFeedDB::get_categories($cond);
		$dir = 'rss';
		if(!file_exists($dir)) mkdir($dir);
		foreach($this->map['category'] as $key=>$value){
			$content = $this->begin_rss($value['category_name_id']);
			$content .= $this->get_items($value['structure_id']);
			$dir_rss = 'rss/'.$value['category_name_id'].'.rss';
			if(!file_exists($dir_rss)){
				$dir_file = fopen($dir_rss,'w') or die("can't open file");
				fclose($dir_file);
			}
			if(!$dir_file = fopen($dir_rss,'w')){
				echo "can't open file";
				exit();
			}
			if (fwrite($dir_file, $content) === FALSE) {
				echo "Can't write to file";
				exit;
			}
			fclose($dir_file);
			$this->map['category'][$key]['level'] = IDStructure::level($value['structure_id']);
		}
		$this->parse_layout('list',$this->map);
	}
	function begin_rss($category_name_id){
		$details = '<?xml version="1.0" encoding="utf-8" ?>
			<rss version="2.0">
				<channel>
					<title>'.Portal::get_setting('rss_title',Portal::language('rss_title')).'</title>
					<description>'.Portal::get_setting('rss_description',Portal::language('rss_description')).'</description>
					<link>'.Url::build('tin-tuc',array('name_id'=>$category_name_id),REWRITE).'</link>
					';
		return $details;
	}
	function get_items($structure_id){
		$cond = 'news.portal_id="'.PORTAL_ID.'" and news.status!="HIDE" and news.type="NEWS" and '.IDStructure::child_cond($structure_id).'';
		$item = RssFeedDB::get_items($cond);
		$items = '';
		foreach($item as $key=>$value){
			$items .= '<item>
						<title>'.convert_error_to_utf8($value['name']).'</title>
						<description>'.strip_tags(convert_error_to_utf8($value['brief'])).'</description>
						<link>http://'.Url::build('xem-tin-tuc',array('name'=>$value['name_id']),REWRITE).'</link>
						<pubDate>'.date('r',$value['time']).'</pubDate>
					</item>';
		}
		$items .= '</channel>
				</rss>';
		return $items;
	}
}
?>