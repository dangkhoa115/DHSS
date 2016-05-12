<script type="text/javascript">
jQuery(function(){
	jQuery('#next').hover(
		function(){
			jQuery(this).addClass('arrow-next-hover');
		},
		function(){
			jQuery(this).removeClass('arrow-next-hover');
		}
	);
	jQuery('#prev').hover(
		function(){
			jQuery(this).addClass('arrow-prev-hover');
		},
		function(){
			jQuery(this).removeClass('arrow-prev-hover');
		}
	);
    jQuery("#home_focus_news").jCarouselLite({
		visible:1,
		scroll:1,
		vertical:false,
		btnPrev:'#prev',
		btnNext:'#next',
		auto: 5000,
		speed: 1000
		//mouseWheel: true
    });
});
</script>
<div id="home_focus_news" class="home-news-slide-bound">
	<ul>
		<!--LIST:news-->
		<li>
			<div class="home-news-slide-image">
				<a href="<?php echo Url::build('xem-tin-tuc',array('name_id'=>[[=news.name_id=]]),REWRITE);?>"><img src="[[|news.image_url|]]" alt="[[|news.name|]]" /></a>
				<div class="home-news-slide-content-bg"></div>
				<div class="home-news-slide-content">
					<div class="home-news-slide-name"><a href="<?php echo Url::build('xem-tin-tuc',array('name_id'=>[[=news.name_id=]]),REWRITE);?>"><?php echo [[=news.name=]];?></a></div>
					<div class="home-news-slide-brief"><?php echo String::display_sort_title(strip_tags([[=news.brief=]]),20);?></div>
				</div>
			</div>
		</li>
		<!--/LIST:news-->
	</ul>
	<div id="prev" class="home-news-slide-prev"></div>
	<div id="next" class="home-news-slide-next"></div>
</div>
<div class="clear"></div>
