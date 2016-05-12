<fieldset id="toolbar">
	<legend><?php echo Portal::language('utils');?></legend>
	<div id="toolbar-title">
		<?php echo Portal::language('currency_admin');?>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(User::can_add(false,ANY_CATEGORY)){?><td id="toolbar-new"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'add'));?>#"> <span title="<?php echo Portal::language('New');?>"> </span> <?php echo Portal::language('New');?> </a> </td><?php }?>
  		  <?php if(User::can_admin(false,ANY_CATEGORY)){?><td id="toolbar-config"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'cache'));?>#"> <span title="<?php echo Portal::language('cache');?>"> </span> <?php echo Portal::language('cache');?> </a> </td><?php }?>
   		  <?php if(User::can_admin(false,ANY_CATEGORY)){?><td id="toolbar-list"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'update'));?>#"> <span title="<?php echo Portal::language('Update');?>"> </span> <?php echo Portal::language('Update');?> </a> </td><?php }?>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> <?php echo Portal::language('Help');?> </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<fieldset id="toolbar">
<form name="CurrencyAdmin" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
	<tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
		<th width="3%" align="left" nowrap><a>#</a></th>
		<th width="10%" align="left" nowrap><a><?php echo Portal::language('id');?></a></th>			
		<th width="40%" align="left" nowrap><a><?php echo Portal::language('name');?></a></th>
		<th width="20%" align="left" nowrap><a><?php echo Portal::language('exchange');?></a></th>
		<th width="10%" align="left" nowrap><a><?php echo Portal::language('position');?></a></th>
		<?php 
				if((User::can_edit(false,ANY_CATEGORY)))
				{?><th width="1%" align="left" nowrap><a><?php echo Portal::language('edit');?></a></th>
				<?php
				}
				?>
		<?php 
				if((User::can_delete(false,ANY_CATEGORY)))
				{?><th width="1%" align="left" nowrap><a><?php echo Portal::language('delete');?></a></th>
				<?php
				}
				?>
	</tr>
	<?php $i=0;?>
	<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
	<?php $i++;?>
	<tr valign="middle" <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if($i%2){echo 'background-color:#F9F9F9';}?>" id="CurrencyAdmin_tr_<?php echo $this->map['items']['current']['id'];?>">
		<td><?php echo $i;?></td>
		<td><?php echo $this->map['items']['current']['id'];?></td>
		<td><?php echo $this->map['items']['current']['name'];?></td>
		<td><?php echo $this->map['items']['current']['exchange'];?></td>
		<td><?php echo $this->map['items']['current']['position'];?></td>
		<?php 
				if((User::can_edit(false,ANY_CATEGORY)))
				{?><td align="center"><a href="<?php echo Url::build_current(array('cmd'=>'edit','id'=>$this->map['items']['current']['id']));?>"><img src="skins/default/images/buttons/edit.jpg"></a></td>
				<?php
				}
				?>
		<?php 
				if((User::can_delete(false,ANY_CATEGORY)))
				{?><td align="center"><a onclick="if(confirm('<?php echo Portal::language('are_you_want_to_delete');?>')){location='<?php echo Url::build_current(array('cmd'=>'delete','id'=>$this->map['items']['current']['id']));?>'}"><img src="skins/default/images/buttons/uncheck.gif"></a></td>
				<?php
				}
				?>
	</tr>
	
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
</table>	
<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;border-top:0px;height:8px;#width:99%;" align="center">
<tr>
	<td align="right">&nbsp;</td>
</tr>
</table>
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
<div style="#height:8px"></div>
</fieldset>