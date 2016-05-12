<style>
	.gallery-image {
		overflow:auto;
		zoom:1;
		width:776px;				
	}
	.gallery-image a {
		display:block;
		float:left;
		margin:5px;
		opacity:0.87;
		text-align:center;
	}
	.gallery-image a:hover {
		opacity:1;
	}
	.gallery-image a img {
		border:none;
		display:block;
	}
	.gallery-image a#vlightbox{display:none}
</style>
<div class="gallery-bound">	
	<!--LIST:items-->
	<div class="gallery-content">
		<div class="gallery-image">
			<a href="[[|items.image_url|]]" rel="lightbox[sample]" title="[[|items.name|]]"><img src="[[|items.image_url|]]"></a>
			<!--[if lte IE 6]><script src="js/pngfix_vlb.js" type="text/javascript"></script><![endif]-->
		</div>
		<div class="gallery-name">[[|items.name|]]</div>
	</div>
	<!--/LIST:items-->
	<div class="gallery-paging">[[|paging|]]</div>
	<div class="clear"></div>
</div>
