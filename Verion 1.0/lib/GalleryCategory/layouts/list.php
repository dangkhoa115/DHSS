<script type="text/javascript">
jQuery(function(){
	for(var i=1;i<=[[|count_categories|]];i++){
		jQuery('.gallery-item-bound-'+i+' a').lightBox();
	}
});
</script>
<div class="gallery-bound">	<?php $i=1;?>
	<!--LIST:categories-->
	<div class="gallery-title">
		<a href="<?php echo Url::build('thu-vien-anh',array('name'=>[[=categories.name_id=]]),REWRITE)?>">[[|categories.category_name|]]</a>
	</div>
	<div class="gallery-item-bound-<?php echo $i;?>"><?php $i++;?>
		<!--LIST:categories.items-->
		<div class="gallery-category-content">
			<div class="gallery-category-image">
			<a rel="lightbox-tour" href="[[|categories.items.image_url|]]"><img src="[[|categories.items.image_url|]]"></a>
			</div>
		</div>
		<!--/LIST:categories.items-->
	</div>
	<div style="clear:both"></div>
	<div class="gallery-view-all"><a href="<?php echo Url::build('thu-vien-anh',array('name'=>[[=categories.name_id=]]),REWRITE)?>">[[.view_all.]] >></a></div>
	<!--/LIST:categories-->
</div>