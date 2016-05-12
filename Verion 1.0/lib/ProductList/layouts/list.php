<div class="product-list-bound">
	<div class="product-list-title">[[|category_name|]]</div>
    <form name="product_list" method="post" action="<?php echo Url::build('so-sanh-san-pham');?>">
    <div class="product-compare-button"><input name="compare_product" type="submit" id="compare_product" onclick="if(!checkProduct()){return false;}" /></div>
    <div class="product-list-content">
    <!--LIST:items-->
		<div class="product-list-item">
        	<div class="product-list-image"><a href="<?php echo Url::build('xem-san-pham',array('id'=>[[=items.id=]]))?>"><img src="[[|items.small_thumb_url|]]" /></a></div>
            <div class="product-list-price-list">
	            <div class="product-list-name"><a href="<?php echo Url::build('xem-san-pham',array('id'=>[[=items.id=]]))?>">[[|items.name|]]</a></div>
                <div class="product-list-price-agent"><span>[[.Market_price.]]:</span>[[|items.price_agent|]] [[|items.currency_id|]]</div>
                <div class="product-list-price"><span>[[.Price.]]:</span>[[|items.price|]] [[|items.currency_id|]]</div>
                <!--IF:cond_price([[=items.saving=]]>0)--><div class="product-list-price product-list-price-saving"><span>[[.Savings.]]</span>[[|items.saving|]] [[|items.currency_id|]]</div><!--/IF:cond_price-->
                <div class="product-list-hit-count"><span>[[.Hit_count.]]:</span>[[|items.hitcount|]]</div>
			</div>
            <div class="product-list-function">
            	<div class="product-list-compare-product">[[.compare_product.]]<input name="selected[]" type="checkbox" id="selected_id_[[|items.id|]]" value="[[|items.id|]]" onclick="select_product(this)" /> </div>
            	<div class="product-list-button"><a href="javascript:void(0)"><img src="<?php echo Portal::template('default')?>/images/product/cart.gif" /></a>&nbsp;<a href="javascript:void(0)"><img src="<?php echo Portal::template('default')?>/images/product/muangay.jpg" /></a>&nbsp;<a href="javascript:void(0)"><img src="<?php echo Portal::template('default')?>/images/product/save.gif" /></a></div>
            </div>
        </div>
    <!--/LIST:items-->    
    </div>
    <div class="product-compare-button"><input name="compare_product" type="submit" id="compare_product" onclick="if(!checkProduct()){return false;}"  /></div>
    <div class="paging">[[|paging|]]</div>
    </form>
</div>
<script type="text/javascript">
	var products = new Array();
	function checkProduct()
	{
		if(products.length==1)
		{
			alert('[[.You_have_to_choose_two_product_to_compare.]]!');
			return false;
		}
		else if(products.length>5)
		{
			alert('[[.You_have_to_choose_less_than_5_product.]]!');
			return false;
		}
		return true;
	}
	function select_product(id)
	{
		value = $(id).value;
		if($(id).checked==true)
		{
			products[products.length] = value;
		}
		else
		{
			products = products.slice(0,products.length-1);
		}
	}	
</script>
