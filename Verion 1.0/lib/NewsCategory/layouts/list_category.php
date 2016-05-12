<div class="news-category-bound">
	<!--LIST:categories-->
	<div class="news-category-category-bound">
		<div class="news-category-category-name"><a href="<?php echo Url::build_current(array('name'=>[[=categories.c_name_id=]]),REWRITE)?>">[[|categories.category_name|]]</a></div>		
			<!--IF:image([[=categories.image_url=]] and file_exists([[=categories.image_url=]]))-->
			<div class="news-category-image"><img src="[[|categories.image_url|]]" /></div>
			<!--/IF:image-->
			<div class="news-category-title">
				<div class="news-category-name"><a href="<?php echo Url::build('xem-tin-tuc',array('name'=>[[=categories.name_id=]]),REWRITE)?>">[[|categories.name|]]</a></div>
				<!--IF:show_time([[=categories.show_time=]]==1)-->
				<div class="news-category-time"><?php echo date('H:i d/m',[[=categories.time=]]); ?></div>
				<!--/IF:show_time-->
			</div>
			<div class="news-category-brief"><?php echo String::display_sort_title(strip_tags([[=categories.brief=]]),25); ?></div>
			<div class="clear"></div>
		<ul class="news-category-other-news-bound">
		<!--LIST:categories.child-->
			<li class="news-category-other-news-name">
				<a href="<?php echo Url::build('xem-tin-tuc',array('name'=>[[=categories.child.name_id=]]),REWRITE)?>">[[|categories.child.name|]]</a>
				( <?php echo date('d/m/Y',[[=categories.child.time=]]); ?> )
			</li>
		<!--/LIST:categories.child-->
		</ul>
	</div>
	<!--/LIST:categories-->
</div>