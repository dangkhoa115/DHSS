<?php
class ProductCompareDB
{
	static function get_products($cond)
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
				0,5
		');
	}
}
?>