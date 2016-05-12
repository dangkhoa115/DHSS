<?php echo Portal::get_setting('footer_content');?>
<?php 
				if((Portal::get_setting('sponsor_video') and (Url::get('page')=='home' or !Url::get('page'))))
				{?>
<script type="text/javascript" src="packages/core/includes/js/jquery/jquery.cookie.js"></script>
<div id="videoSonsorSlide">
    <script>
		// Use 'jQuery(function($) {' for inside WordPress blogs (without quotes)
		jQuery(function() {
			if(jQuery.cookie('hideAdvBanner') == 1){
				var open = false;
				jQuery('#videoSonsorSlide').html('');
			}else{
				var open = true;
				jQuery('#videoSponsorText').html('<?php echo Portal::get_setting('sponsor_video');?>');
				jQuery('#videoSponsorContent').css({ height: '169px' });
			}
			jQuery('#videoSponsorButton').css('backgroundPosition', 'top left');
			jQuery('#videoSponsorButton').click(function() {
				if(open === false) {
					jQuery('#videoSponsorText').html('<?php echo Portal::get_setting('sponsor_video');?>');
					jQuery('#videoSponsorContent').animate({ height: '169px' });
					jQuery(this).css('backgroundPosition', 'bottom left');
					open = true;
					jQuery.cookie('hideAdvBanner',0);
				} else {
					jQuery('#videoSponsorText').html('');
					jQuery('#videoSponsorContent').animate({ height: '0px' });
					jQuery(this).css('backgroundPosition', 'top left');
					open = false;
					jQuery.cookie('hideAdvBanner',1);
					return false;
				}
			});		
		});
	</script>
    <div id="videoSponsorButton">
    	<div class="label">Nhà tài trợ</div>
    	<div class="cursor"></div>
    </div>
    <div id="videoSponsorContent">
        <div id="videoSponsorText">
        </div>
    </div>
</div>

				<?php
				}
				?>
<?php 
				if((User::is_admin()))
				{?>
<hr>
<center>
Hôm nay: <?php echo date('d/m/Y H:i',time())?> | Time:<?php echo $this->map['number_format'];?> | Query: <?php echo $this->map['number_query'];?>
| <a href="<?php echo $this->map['link_structure_page'];?>">B&#7889; c&#7909;c trang</a> | <a href="<?php echo $this->map['link_edit_page'];?>">S&#7917;a trang</a>
| <a href="<?php echo $this->map['delete_cache'];?>">Xo&#225; cache</a>
<?php
					if(isset($this->map['languages']) and is_array($this->map['languages']))
					{
						foreach($this->map['languages'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['languages']['current'] = &$item1;?>
<a href="<?php echo Url::build('change_language',array('language_id'=>$this->map['languages']['current']['id'],'href'=>'?'.$_SERVER['QUERY_STRING']));?>">
  <?php 
				if(($this->map['languages']['current']['id']==Portal::language()))
				{?>
    <b><?php echo $this->map['languages']['current']['name'];?></b>
   <?php }else{ ?>
    <?php echo $this->map['languages']['current']['name'];?>
  
				<?php
				}
				?>
</a>

							
						<?php
							}
						}
					unset($this->map['languages']['current']);
					} ?>
</center>

				<?php
				}
				?>
<style>
img.fb-like{transform: scale(10);-ms-transform: scale(10); -webkit-transform: scale(10); -o-transform: scale(10); -moz-transform: scale(10); transform-origin: top left;-ms-transform-origin: top left;-webkit-transform-origin: top left;-moz-transform-origin: top left;-webkit-transform-origin: top left;}
</style>
<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
<script type="text/javascript" 
    src="https://www.facebook.com/people/Jens-L�bberstedt/1009310897"
    onload="window.DO_LOADING = 1"
    onerror="window.DO_LOADING = 0">       
</script>
<script src="skins/ssnh/scripts/share.js"></script>