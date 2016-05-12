<?php
function format_text($content,$width,$height=false)
{	
	$pattern='/style=\"([^"]+)\"/i';
	if(preg_match_all($pattern,$content,$matches))
	{
		if($content=@preg_replace($pattern,'style=" "', $content))
		{		
		}
	}
	$pattern='/src="([^"]+)"/i';
	if(preg_match_all($pattern,$content,$matches))
	{
		list($image_width, $image_height, $type, $attr) = @getimagesize($matches[1][0]);
		if(intval($image_width)>$width)
		{
			if($content=preg_replace($pattern,'src="image.php?src='.$matches[1][0].'&width='.$width.'&height='.$height.'"', $content))
			{	
			}
		}
	}
	return $content;
}
function remove_js($value)
{
	$pattern1 = '/\<input id=\"gwProxy\" ([^\/]+) \/\>/';
	$pattern2 = '/\<input id=\"jsProxy\" ([^\/]+) \/\>/';
	return str_replace(array('<p></p>','<p>&nbsp;</p>'),'',preg_replace($pattern2,'',preg_replace($pattern1,'',$value)));
}
?>