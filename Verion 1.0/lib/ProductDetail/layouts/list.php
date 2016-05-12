<script type="text/javascript">
	jQuery(function(){
		jQuery('.product-detail-image-main a').lightBox();
	})
</script>

<div class="product-detail-bound">
	<div class="product-detail-image">
    	<div class="product-detail-image-main"><a href="[[|image_url|]]"><img src="[[|image_url|]]" /></a></div>
    </div>
    <div class="product-detail-content">
    	<div class="product-detail-name">[[|name|]]</div>
        <div class="product-detail-price-agent"><span>[[.price_agent.]]</span>[[|price_agent|]] [[|currency_id|]]</div>
        <div class="product-detail-price"><span>[[.price.]]</span>[[|price|]] [[|currency_id|]]</div>
        <!--IF:cond_saving([[=saving=]])--><div class="product-detail-saving"><span>[[.saving.]]</span>[[|saving|]] [[|currency_id|]]</div><!--/IF:cond_saving-->
	    <div class="product-detail-button"><a href="javascript:void(0)"><img src="<?php echo Portal::template('default')?>/images/product/cart.gif" /></a>&nbsp;<a href="javascript:void(0)"><img src="<?php echo Portal::template('default')?>/images/product/muangay.jpg" /></a>&nbsp;<a href="javascript:void(0)"><img src="<?php echo Portal::template('default')?>/images/product/save.gif" /></a></div>
        <div class="product-detail-hit-count"><span>[[.hit_count.]]:&nbsp;</span>[[|hitcount|]]</div>
    </div>
    <div class="clear"></div>
    <div class="product-detail-information-bound">
    	<div class="product-detail-information-title">[[.Product_information.]]</div>
        <div class="product-detail-information">
            <div class="product-detail-brief">[[|brief|]]</div>
            <div class="product-detail-description">[[|description|]]</div>
        </div>
    </div>
</div>