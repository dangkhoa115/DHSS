<div class="rss-list-bound">
	<h2 class="rss-list-channels">[[.RSS_of.]] <?php echo Portal::get_setting('company_website','mywebsite');?></h2>
	<div class="rss-list-info"><?php echo Portal::get_setting('rss_info',Portal::language('rss_introduction_infomation'));?></div>
	<h2 class="rss-list-channels">[[.channels_RSS_Feeds.]] <?php echo Portal::get_setting('company_website','mywebsite');?> [[.provide.]]</h2>
	<!--LIST:category-->
	<div class="rss-list-category-bound">
		<div class="rss-list-category <?php if([[=category.level=]]==2){ echo 'rss-list-level-2'; }?>">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="30%" nowrap="nowrap"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/rss/[[|category.category_name_id|]].rss" class="rss-list-link">[[|category.name|]]</a></td>
					<td nowrap="nowrap">(<a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/rss/[[|category.category_name_id|]].rss" class="rss-list-link">http://<?php echo $_SERVER['HTTP_HOST']; ?>/rss/<?php echo [[=category.category_name_id=]]; ?>.rss</a>)</td>
				</tr>
			</table>
		</div>
	</div>
	<!--/LIST:category-->
</div>