<div class="product-compare-bound">
	<table cellpadding="5" cellspacing="0" width="100%" border="1" bordercolor="#CCCCCC" style="border-style:dotted;">
        <tr>
        	<td class="product-compare-label" nowrap="nowrap">[[.product_image.]]</td>
        	<!--LIST:products-->
            <td class="product-compare-image" align="center"><a href="<?php echo Url::build('xem-san-pham',array('id'=>[[=products.id=]]))?>"><img src="[[|products.image_url|]]" /></a></td>
        	<!--/LIST:products-->            
        </tr>
    	<tr>
        	<td class="product-compare-label">[[.product_name.]]</td>
        	<!--LIST:products-->
            <td class="product-compare-name">[[|products.name|]]</td>
        	<!--/LIST:products-->
		</tr>
        <tr>
        	<td class="product-compare-label">[[.product_price.]]</td>
           	<!--LIST:products-->
        	<td class="product-compare-price"><?php echo System::display_number([[=products.price=]])?> [[|products.currency_id|]]</td>
            <!--/LIST:products-->
        </tr>
        <tr>
        	<td class="product-compare-label">[[.product_brief.]]</td>
           	<!--LIST:products-->
        	<td class="product-compare-brief">[[|products.brief|]]</td>
            <!--/LIST:products-->
        </tr>
    </table>
</div>