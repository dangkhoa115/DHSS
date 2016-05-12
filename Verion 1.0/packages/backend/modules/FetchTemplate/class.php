<?php
/******************************
COPY RIGHT BY Catbeloved - Framework

******************************/
class FetchTemplate extends Module{
	function FetchTemplate($row){
		Module::Module($row);
		require_once 'db.php';
		define('WEB_URL','http://www.vanphongpham24.com');
		if(User::can_admin(false,ANY_CATEGORY)){
			switch(Url::get('cmd')){	
				case 'fetch_product'	:
					$this->fetch_products(Url::get('category_id'));
					echo '<script>alert("Lấy dữ liệu thành công!");window.location = "'.Url::build_current(array('category_id'=>Url::get('category_id'))).'";</script>';
					break;
				default:
					require_once 'forms/fetch_category.php';
					$this->add_form(new FetchCategoryForm());			
					break;
			}	
		}
		else{
			URL::access_denied();
		}	
	}
	function fetch_products($category_id){
			if($category = DB::select('item_category','id = '.$category_id.'')){
				if($content=file_get_contents(WEB_URL.$category['crawler_url'])){
					$parttern = '/\<a class=\'id_ctsp_2_a\' href=\'([a-zA-Z0-9-\/_]+)\'\>([^\<]+)\<\/a\>/';
					if(preg_match_all($parttern,$content,$matchs)){
						if(isset($matchs[1]) and isset($matchs[1])){
							foreach($matchs[1] as $key=>$value)
							$this->fetch_product(WEB_URL.$value,$category_id,$matchs[2][$key]);
						}
					}
				}
			}
	}
	function fetch_product($url,$category_id,$name){
		require_once 'packages/core/includes/utils/vn_code.php';
		require_once 'packages/core/includes/utils/upload_file.php';
		if($content=file_get_contents($url)){
			$name_id = convert_utf8_to_url_rewrite($name);
			$price = 0;
			$desc = '';
			$image_url = '';
			$parttern = '/\<b\>([0-9 ,]+ đ)\<\/b\>/';
			$hsx_parttern = '/\<tr\>\<td style=\'width\:33\%;text-align\:left\'\>\<span style=\'color\:#1F1F1F\'\>(Hãng sản xuất)\<\/span\>\<\/td\>\<td style=\'width\:67\%;text-align:left\'\> \<b\>([^\<]+)\<\/b>\<\/td\>\<\/tr\>/';
			$xuatxu_parttern = '/\<tr\>\<td style=\'width\:33\%;text-align\:left\'\>\<span style=\'color\:#1F1F1F\'\>(Xuất xứ) \<\/span\>\<\/td\>\<td style=\'width\:67\%;text-align:left\'\> \<b\>([^\<]+)\<\/b>\<\/td\>\<\/tr\>/';
			$img_parttern = '/\<img id=\'id_hinhthehien\' src=\'([^\']+)\' height=\'220px\'\/\>/';
			if(preg_match_all($img_parttern,$content,$matchs)){
				if(isset($matchs[1][0])){
					$web_image_url = WEB_URL.$matchs[1][0];
					$dir = 'upload/default/item/';
					$name_image=strtolower(substr($web_image_url,strrpos($web_image_url,'/')+1));
					$image_url = $dir.rand(00000,999999).'_image_url_'.time().'.jpg';
					$thumb_name = $dir.rand(00000,999999).'_thumb_url_'.time().'.jpg';
					if(@copy($web_image_url,$image_url)){
						create_thumb($image_url,$thumb_name,180,180, true);//create thumb//$constraint//$new_width,$new_height
						//create_thumb($_REQUEST[$field],$_REQUEST[$field],800,800, true);//resize photo
						//$watermarkImage = 'skins/modern/images/sealed_logo.png';
						//doResizeAndWatermark ($image_url,$ext,$watermarkImage);
					}
				}
			}
			if(preg_match_all($parttern,$content,$matchs)){
				$price = isset($matchs[1])?intval(str_replace(array(' ','đ',','),'',$matchs[1][0])):0;	
			}
			if(preg_match_all($hsx_parttern,$content,$matchs)){
				if(isset($matchs[1][0]) and isset($matchs[2][0])){
					$desc .= $matchs[1][0]." ".$matchs[2][0]."<br />";
				}
			}
			if(preg_match_all($xuatxu_parttern,$content,$matchs)){
				if(isset($matchs[1][0]) and isset($matchs[2][0])){
					$desc .= $matchs[1][0]." ".$matchs[2][0]."<br />";
				}
			}
			DB::insert('item',array(
				'category_id'=>$category_id,
				'name'=>$name,'name_id'=>$name_id,
				'content'=>$desc,
				'price'=>$price,
				'content_no_sign'=>str_replace('-',' ',$name_id),
				'poster'=>Session::get('user_id'),
				'time'=>time(),
				'checked'=>1,
				'image_url'=>$image_url
			));
		}
	}
}
?>