<div class="main-menu-bound">
	<!--IF:cond([[=categories=]])-->
	<ul id="main_menu" class="menu">
  <li><a href="" style="color:#6F6">Trang chủ</a></li>
	<!--LIST:categories-->
		<li class="menumain">
			<!--IF:cond3([[=categories.icon_url=]])-->
			<span style="width:15px;height:12px;_filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[[|categories.icon_url|]]',sizingMethod='scale');"><img src="[[|categories.icon_url|]]" class="img"  /></span>
			<!--/IF:cond3-->
			<?php echo Portal::language()==1?[[=categories.name_1=]]:[[=categories.name_2=]]; ?>
			<ul>
				<!--[if lte IE 6]><iframe></iframe><![endif]-->
				<!--IF:cond2([[=categories.child=]])-->
					<?php $group = false;?>
					<!--LIST:categories.child-->
						<?php	
								if(![[=categories.child.url=]]) [[=categories.child.url=]] = '';
						?>
						<li><a href="[[|categories.child.url|]]">
							<!--IF:cond4([[=categories.child.icon_url=]])-->
							<span style="width:15px;height:12px;display:inline-block;_filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[[|categories.child.icon_url|]]',sizingMethod='scale');"><img src="[[|categories.child.icon_url|]]" class="img" /></span>
							<!--ELSE-->
							<span style="width:15px;height:12px;display:inline-block;_filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='packages/core/skins/default/images/folder.png',sizingMethod='scale');"><img src="skins/default/images/menu/folder.png" class="img"  /></span>
							<!--/IF:cond4-->
							<?php echo Portal::language()==1?[[=categories.child.name_1=]]:[[=categories.child.name_2=]]; ?>
							</a>
							<!--IF:cond5([[=categories.child.child=]])-->
							<ul>
								<?php $sub_group = false; ?>
								<!--LIST:categories.child.child-->
								<?php	if(isset([[=categories.child.child.group_name=]]) and $sub_group != [[=categories.child.child.group_name=]])
										{
											if($sub_group!="") echo '<li></li>';
											$sub_group = [[=categories.child.child.group_name=]];
										}
								?>
								<li><a href="[[|categories.child.child.url|]]">
									<!--IF:cond6([[=categories.child.child.icon_url=]])-->
									<span style="width:15px;height:12px;display:inline-block;_filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='[[|categories.child.child.icon_url|]]',sizingMethod='scale');"><img src="[[|categories.child.child.icon_url|]]" class="img" /></span>
									<!--ELSE-->
									<span style="width:15px;height:12px;display:inline-block;_filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='packages/core/skins/default/images/folder.png',sizingMethod='scale');"><img src="skins/default/images/menu/folder.png" class="img"  /></span>
									<!--/IF:cond6-->
									<?php echo Portal::language()==1?[[=categories.child.child.name_1=]]:[[=categories.child.child.name_2=]]; ?>									
								</a></li>
								<!--/LIST:categories.child.child-->
							</ul>
							<!--/IF:cond5-->						
						</li>
					<!--/LIST:categories.child-->
				<!--/IF:cond2-->
			</ul>
		</li>		
	<!--/LIST:categories-->
  <li style="float:right"><a href=""><?php echo date('H:i\' d/m/Y');?></a></li>
	<li class="menumain" style="float:right">
			<a href="?page=sign_out" style="color:#F00">Thoát</a>
			
		</li>
	</ul>
	<!--/IF:cond-->
	<div style="clear:both; height:0px; font-size:0px;" ></div>
</div>