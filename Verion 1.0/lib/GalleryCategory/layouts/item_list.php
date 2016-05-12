<script type="text/javascript">
jQuery(function(){
	jQuery('.gallery-image a').lightBox();
});
</script>
<div class="gallery-bound">	
	<div class="gallery-title">[[|category_name|]]</div>
	<!--LIST:items-->
	<div class="gallery-content">
		<div class="gallery-image">
			<a rel="lightbox-tour" href="[[|items.image_url|]]" title="[[|items.name|]]"><img src="[[|items.image_url|]]"></a>
		</div>
		<div class="gallery-name">[[|items.name|]]</div>
	</div>
	<!--/LIST:items-->
	<div class="gallery-paging">[[|paging|]]</div>
	<div class="clear"></div>
</div>
