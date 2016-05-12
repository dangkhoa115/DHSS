<script src="packages/core/includes/js/hightslides.js"></script>
<script type="text/javascript">
    hs.graphicsDir = 'packages/portal/includes/js/hightslides/';
	hs.outlineType = 'rounded-white';
    window.onload = function() {
        hs.preloadImages(5);
    }
</script>
<div id="highslide-container"></div>
<div class="gallery-bound">	
	<!--LIST:items-->
	<div class="gallery-content">
		<div class="gallery-image">
			<a id="thumb1" target="_blank" href="[[|items.image_url|]]" onClick="return hs.expand(this)" title="[[|items.name|]]"><img src="[[|items.image_url|]]" align="top" border="0" width="<?php echo Portal::get_setting('gallery_width',100);?>" height="<?php echo Portal::get_setting('gallery_height',100);?>" class="gallery-image"></a>
		</div>
		<div class="gallery-name">[[|items.name|]]</div>
	</div>
	<!--/LIST:items-->
	<br clear="all" />
<div class="gallery-paging">[[|paging|]]</div>
</div>
