<div class="banner">HỆ THỐNG QUẢN TRỊ NỘI DUNG<span>Catbeloved Panel Version 2014</span></div><br clear="all" />
<div class="user-menu-list">
    <ul>
    	<?php 
				if((!$this->map['check_member']))
				{?>
        <li class="user-main-menu <?php if(Url::sget('page')=='panel') echo 'selected';?>">
            <a href="<?php echo Url::build('panel','',false);?>"><div><div><?php echo Portal::language('overview');?></div></div></a>
        </li>
        
				<?php
				}
				?>
        <?php
					if(isset($this->map['categories']) and is_array($this->map['categories']))
					{
						foreach($this->map['categories'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['categories']['current'] = &$item1;?>
        <li class="user-main-menu <?php if($this->map['categories']['current']['check_selected']) echo 'selected';?>">
            <?php 
				if(($this->map['categories']['current']['check']))
				{?>
            <div><div style="cursor:default;"><?php echo $this->map['categories']['current']['name'];?></div></div>
             <?php }else{ ?>
            <a href="<?php echo $this->map['categories']['current']['url'];?>"><div><div><?php echo $this->map['categories']['current']['name'];?></div></div></a>
            
				<?php
				}
				?>
        </li>
        <?php 
				if(($this->map['categories']['current']['check']))
				{?>
        <li class="user-sub-menu-bound">
        	<ul><?php $i = 1;?>
            	<?php
					if(isset($this->map['categories']['current']['childs']) and is_array($this->map['categories']['current']['childs']))
					{
						foreach($this->map['categories']['current']['childs'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['categories']['current']['childs']['current'] = &$item2;?>
            	<li class="user-sub-menu-item <?php if($i==1) echo 'user-sub-menu-item-1'; $i++;?>"><a href="<?php echo $this->map['categories']['current']['childs']['current']['url'];?>"><?php echo $this->map['categories']['current']['childs']['current']['name'];?></a></li>
            	
							
						<?php
							}
						}
					unset($this->map['categories']['current']['childs']['current']);
					} ?>
            </ul>
        </li>
        
				<?php
				}
				?>
        
							
						<?php
							}
						}
					unset($this->map['categories']['current']);
					} ?>
		<li class="user-menu-home" style="float:right;" onclick="window.location='<?php echo Url::build('sign_out');?>'" title="Thoát"></li>
    </ul>
</div>
<div class="clear"></div>
<script type="text/javascript">
jQuery(function(){
	jQuery('.user-main-menu').hover(
		function(){
			jQuery('.user-sub-menu-bound').hide();
			var pos = jQuery(this).position();
			jQuery(this).next().show().css('left',pos.left);
		},
		function(){
			jQuery('.user-sub-menu-bound').hide();
		}
	);
	jQuery('.user-sub-menu-bound').hover(
		function(){
			jQuery(this).show();
		},
		function(){
			jQuery(this).hide();
		}
	);
});
</script>