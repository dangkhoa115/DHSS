<div class="hotel-panel-bound"><div class="hotel-panel-content-bound">
<div class="hotel-panel-content">
    <div class="hotel-panel-title">[[.component_manage_hotel.]]</div>
    <div class="hotel-panel-item-bound"><?php $i=0;?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<!--LIST:categories-->
			<!--IF:cond_show([[=categories.status=]]!='HIDE')-->
            <?php if($i%4==0) echo '<tr>';?>
            <td class="hotel-panel-item">
                <div class="hotel-panel-item-title"><div class="hotel-panel-item-title-1"><div class="hotel-panel-item-title-2">
                	<div>[[|categories.name|]]</div>
                </div></div></div>
                <div class="hotel-panel-item-icon">
                	<div class="hotel-panel-item-link"></div>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" height="120">
                        <tr>
	                        <td align="center" class="icon-category-bound" <?php if([[=categories.url=]]){ ?>onclick="window.location='[[|categories.url|]]'"<?php }?>><img class="icon-category" src="[[|categories.icon_url|]]" onerror="this.src='skins/booking/images/newsletter.gif'" /></td>
                        </tr>
                    </table>
                </div>
                <div class="hotel-panel-item-bottom"><div class="hotel-panel-item-bottom-1"><div class="hotel-panel-item-bottom-2"></div></div></div>
            </td>
            <?php $i++; if($i%4==0 and $i!=1) echo '</tr>';?>
			<!--/IF:cond_show-->
        	<!--/LIST:categories-->
        </table>
    </div>
</div>
</div>
</div>
<script type="text/javascript">
jQuery(function(){
	jQuery('.icon-category-bound').hover(
		function(){
			jQuery(this).children('img').animate({width: '90px'},100);
		},
		function(){
			jQuery(this).children('img').animate({width: '60px'},300);
		}
	);
});
</script>