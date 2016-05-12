<div class="main-menu-bound">
	<?php 
				if(($this->map['categories']))
				{?>
	<ul id="main_menu" class="menu">
  <li><a href="" style="color:#6F6">Trang chủ</a></li>
	<?php
					if(isset($this->map['categories']) and is_array($this->map['categories']))
					{
						foreach($this->map['categories'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['categories']['current'] = &$item1;?>
		<li class="menumain">
			<?php 
				if(($this->map['categories']['current']['icon_url']))
				{?>
			<span style="width:15px;height:12px;_filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $this->map['categories']['current']['icon_url'];?>',sizingMethod='scale');"><img src="<?php echo $this->map['categories']['current']['icon_url'];?>" class="img"  /></span>
			
				<?php
				}
				?>
			<?php echo Portal::language()==1?$this->map['categories']['current']['name_1']:$this->map['categories']['current']['name_2']; ?>
			<ul>
				<!--[if lte IE 6]><iframe></iframe><![endif]-->
				<?php 
				if(($this->map['categories']['current']['child']))
				{?>
					<?php $group = false;?>
					<?php
					if(isset($this->map['categories']['current']['child']) and is_array($this->map['categories']['current']['child']))
					{
						foreach($this->map['categories']['current']['child'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['categories']['current']['child']['current'] = &$item2;?>
						<?php	
								if(!$this->map['categories']['current']['child']['current']['url']) $this->map['categories']['current']['child']['current']['url'] = '';
						?>
						<li><a href="<?php echo $this->map['categories']['current']['child']['current']['url'];?>">
							<?php 
				if(($this->map['categories']['current']['child']['current']['icon_url']))
				{?>
							<span style="width:15px;height:12px;display:inline-block;_filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $this->map['categories']['current']['child']['current']['icon_url'];?>',sizingMethod='scale');"><img src="<?php echo $this->map['categories']['current']['child']['current']['icon_url'];?>" class="img" /></span>
							 <?php }else{ ?>
							<span style="width:15px;height:12px;display:inline-block;_filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='packages/core/skins/default/images/folder.png',sizingMethod='scale');"><img src="skins/default/images/menu/folder.png" class="img"  /></span>
							
				<?php
				}
				?>
							<?php echo Portal::language()==1?$this->map['categories']['current']['child']['current']['name_1']:$this->map['categories']['current']['child']['current']['name_2']; ?>
							</a>
							<?php 
				if(($this->map['categories']['current']['child']['current']['child']))
				{?>
							<ul>
								<?php $sub_group = false; ?>
								<?php
					if(isset($this->map['categories']['current']['child']['current']['child']) and is_array($this->map['categories']['current']['child']['current']['child']))
					{
						foreach($this->map['categories']['current']['child']['current']['child'] as $key3=>&$item3)
						{
							if($key3!='current')
							{
								$this->map['categories']['current']['child']['current']['child']['current'] = &$item3;?>
								<?php	if(isset($this->map['categories']['current']['child']['current']['child']['current']['group_name']) and $sub_group != $this->map['categories']['current']['child']['current']['child']['current']['group_name'])
										{
											if($sub_group!="") echo '<li></li>';
											$sub_group = $this->map['categories']['current']['child']['current']['child']['current']['group_name'];
										}
								?>
								<li><a href="<?php echo $this->map['categories']['current']['child']['current']['child']['current']['url'];?>">
									<?php 
				if(($this->map['categories']['current']['child']['current']['child']['current']['icon_url']))
				{?>
									<span style="width:15px;height:12px;display:inline-block;_filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $this->map['categories']['current']['child']['current']['child']['current']['icon_url'];?>',sizingMethod='scale');"><img src="<?php echo $this->map['categories']['current']['child']['current']['child']['current']['icon_url'];?>" class="img" /></span>
									 <?php }else{ ?>
									<span style="width:15px;height:12px;display:inline-block;_filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='packages/core/skins/default/images/folder.png',sizingMethod='scale');"><img src="skins/default/images/menu/folder.png" class="img"  /></span>
									
				<?php
				}
				?>
									<?php echo Portal::language()==1?$this->map['categories']['current']['child']['current']['child']['current']['name_1']:$this->map['categories']['current']['child']['current']['child']['current']['name_2']; ?>									
								</a></li>
								
							
						<?php
							}
						}
					unset($this->map['categories']['current']['child']['current']['child']['current']);
					} ?>
							</ul>
							
				<?php
				}
				?>						
						</li>
					
							
						<?php
							}
						}
					unset($this->map['categories']['current']['child']['current']);
					} ?>
				
				<?php
				}
				?>
			</ul>
		</li>		
	
							
						<?php
							}
						}
					unset($this->map['categories']['current']);
					} ?>
  <li style="float:right"><a href=""><?php echo date('H:i\' d/m/Y');?></a></li>
	<li class="menumain" style="float:right">
			<a href="?page=sign_out" style="color:#F00">Thoát</a>
			
		</li>
	</ul>
	
				<?php
				}
				?>
	<div style="clear:both; height:0px; font-size:0px;" ></div>
</div>