<div class="news-list-bound">
    <div class="news-list-content">
	   	<!--LIST:items-->
        <div class="news-list-item">
            <!--IF:cond(file_exists([[=items.image_url=]]))-->
            <div class="news-list-image"><img src="[[|items.image_url|]]" /></div>
            <!--/IF:cond-->
            <div class="news-list-title">
				<div class="news-list-name"><a href="<?php echo Url::build('xem-tin-tuc',array('name'=>[[=items.name_id=]]),REWRITE)?>">[[|items.name|]]</a></div>
				<!--IF:show_time([[=items.show_time=]]==1)-->
				<div class="news-list-time"><?php echo date('H:i d/m',[[=items.time=]]); ?></div>
				<!--/IF:show_time-->
			</div>			
            <div class="news-list-brief"><?php echo String::display_sort_title(strip_tags([[=items.brief=]]),25); ?></div>
			<!--IF:show_author([[=items.show_author=]]==1)-->
			<!--<div class="news-list-author">[[.author.]] : [[|items.author|]]</div>-->
			<!--/IF:show_author-->
        	<div class="clear"></div>
		</div>
        <!--/LIST:items-->
    </div>
    <div class="news-list-paging">[[|paging|]]</div>
</div>