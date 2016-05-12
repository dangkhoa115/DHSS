<?php
class ProductListDB
{
	static function get_products($cond,$item_per_page)
	{
		return DB::fetch_all('
			SELECT
				product.id,
				product.name_'.Portal::language().' as name,
				product.brief_'.Portal::language().' as brief,
				product.image_url,
				product.small_thumb_url,
				product.time,
				product.category_id,
				product.price_agent,				
				product.price,
				product.currency_id,
				product.hitcount				
			FROM
				product
				inner join category on category.id = product.category_id
			WHERE
				'.$cond.'
			ORDER BY
				product.position desc,product.time desc
			LIMIT
				'.((page_no()-1)*$item_per_page).','.$item_per_page.'
		');
	}
	static function get_total_item($cond)
	{
		return DB::fetch('
			SELECT
				count(*) as acount
			FROM
				product
				inner join category on category.id = product.category_id
			WHERE
				'.$cond.'				
		');
	}
}
?>