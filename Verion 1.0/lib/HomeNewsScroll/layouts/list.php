<script type="text/javascript">
jQuery(function(){
	jQuery('#home_scroll_news').scrollPage({
		totalPage: 3,
		visible: 4,
		speed: 800,
		prev: '.home-scroll-news-prev',
		next: '.home-scroll-news-next'
	});
});
</script>
<div id="home_scroll_news" class="home-scroll-news-bound">
	<div class="home-scroll-news-title-bound"><div class="home-scroll-news-title-bound-1"><div class="home-scroll-news-title-bound-2">
		<h2 class="home-scroll-news-title">[[.title.]]</h2>
		<div class="home-scroll-news-page-control">
			<ul>
				<li class="home-scroll-news-prev"></li>
				<li class="home-scroll-news-next"></li>
			</ul>
		</div>
	</div></div></div>
	<div id="content" class="home-scroll-news-content"><div class="home-scroll-news-content-1"><div class="home-scroll-news-content-2">
		<ul><?php $i=1;?>
			<!--LIST:news-->
			<li>
				<!--IF:cond_image(([[=news.small_thumb_url=]] and file_exists([[=news.small_thumb_url=]])) or ([[=news.image_url=]] and file_exists([[=news.image_url=]])))-->
				<div class="home-scroll-news-image">
					<a href="<?php echo Url::build('xem-tin-tuc',array('name_id'=>[[=news.name_id=]]),REWRITE);?>"><img src="<?php if([[=news.small_thumb_url=]] and file_exists([[=news.small_thumb_url=]])) echo [[=news.small_thumb_url=]]; else echo [[=news.image_url=]];?>" /></a>
				</div>
				<!--/IF:cond_image-->
				<div>
					<div class="home-scroll-news-name"><a href="<?php echo Url::build('xem-tin-tuc',array('name_id'=>[[=news.name_id=]]),REWRITE);?>"><?php echo [[=news.name=]];?></a></div>
					<div class="home-scroll-news-brief"><?php echo String::display_sort_title(strip_tags([[=news.brief=]]),20);?></div>
				</div>
			</li>
			<!--/LIST:news-->
		</ul>
	</div></div></div>
</div>
<div class="clear"></div>
