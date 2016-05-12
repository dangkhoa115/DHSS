<div class="topic-news-bound">
	<div class="topic-news-topic-news-bound">			
		<!--IF:cond1(isset([[=related_items=]]) and [[=related_items=]])-->
		<div class="topic-news-list-news-content">
			<div class="topic-news-list-news-title">[[.topic_news.]]</div>
			<ul>
			<!--LIST:related_items-->
				<li class="topic-news-list-news-row">						
					<span class="topic-news-list-news-name"><a href="<?php echo Url::build_current(array('name'=>[[=related_items.name_id=]]),REWRITE);?> ">[[|related_items.name|]]</a></span>
					<span class="topic-news-list-news-time">( <?php echo date('h:i A',[[=related_items.time=]])?> )</span>
				</li>
			<!--/LIST:related_items-->
			</ul>
		</div>
		<!--/IF:cond1-->
	</div>
</div>