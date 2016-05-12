<div class="home-news-categories-bound">
	<!--LIST:categories-->
	<!--IF:cond_item([[=categories.items=]])-->
   	<div class="categories-bound">
    	<div class="categories-frame-title">
        	<div class="categories-frame-title-left">
           		<div class="categories-frame-title-right">
                	<div class="tab-title"><div class="tab-title-left"><div class="tab-title-right"><a href="<?php echo Url::build('tin-tuc',array('name_id'=>[[=categories.name_id=]]),REWRITE)?>">[[|categories.name|]]</a></div></div></div>
                    <?php $i=1;?>
                    <!--LIST:categories.categories-->                    
                    <span><a href="<?php echo Url::build('tin-tuc',array('name_id'=>[[=categories.categories.name_id=]]),REWRITE)?>">[[|categories.categories.name|]]</a></span> <?php if($i!=(sizeof([[=categories.categories=]])-1)){?>|<?php }?>
                    <?php $i++;?>
                    <!--/LIST:categories.categories-->
                    <div class="categories-rss" onclick="window.location='<?php echo 'rss/'.[[=categories.name_id=]].'.rss';?>'">RSS</div>
					<div style="clear:both;"></div>
                </div>
            </div>
        </div>
        <div class="categories-frame-content"><div class="categories-frame-content-1">
          	<?php $i=1;?>
        	<!--LIST:categories.items-->
          	<?php if($i==1){?>
	        <div class="categories-item-bound">
            	<div class="categories-first-item">
                	<!--IF:cond_image(file_exists([[=categories.items.image_url=]]))-->
                	<div class="categories-first-item-img"><a href="<?php echo Url::build('xem-tin-tuc',array('name_id'=>[[=categories.items.name_id=]]),REWRITE)?>"><img src="[[|categories.items.image_url|]]" /></a></div>
                    <!--/IF:cond_image-->
                    <div class="categories-first-item-name"><a href="<?php echo Url::build('xem-tin-tuc',array('name_id'=>[[=categories.items.name_id=]]),REWRITE)?>">[[|categories.items.name|]]</a></div>
                    <div class="categories-first-item-brief"><?php echo strip_tags([[=categories.items.brief=]]);?></div>
                </div>
                <div class="categories-item">
                	<ul>
                <?php }else{?>
                    	<li><a href="<?php echo Url::build('xem-tin-tuc',array('name_id'=>[[=categories.items.name_id=]]),REWRITE)?>">[[|categories.items.name|]]</a></li>
                <?php }?>
                <?php if($i==(sizeof([[=categories.items=]])-1)){?>
					</ul>
                </div>
            </div>
            <?php }?>
            <?php $i++;?>
        	<!--/LIST:categories.items-->
			<div class="clear"></div>
        </div></div>
        <div class="categories-frame-bottom">
        	<div class="categories-frame-bottom-left">
            	<div class="categories-frame-bottom-right"></div>
            </div>            
        </div>
    </div>
    <!--/IF:cond_item-->
	<!--/LIST:categories-->
</div>