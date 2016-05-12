<?php
class ProductDetailDB
{
	static function get_product($id)
	{
		return DB::fetch('
			select
				*,
				product.name_'.Portal::language().' as name,
				product.brief_'.Portal::language().' as brief,
				product.description_'.Portal::language().' as description
			from
				product
			where
				id='.$id
		);
	}
}
?>