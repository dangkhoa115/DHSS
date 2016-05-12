<fieldset id="toolbar">
	<legend><?php echo Portal::language('System_manage');?></legend>
	<div id="toolbar-info"><?php echo Portal::language('statistic_advertisment');?></div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(User::can_view(MODULE_MANAGEADVERTISMENT,ANY_CATEGORY)){?><td id="toolbar-list" align="center"><a href="<?php echo Url::build('manage_advertisment');?>#"> <span title="<?php echo Portal::language('List_adv');?>"> </span> <?php echo Portal::language('List_adv');?> </a> </td><?php }?>
  		  <?php if(User::can_add(MODULE_MANAGEADVERTISMENT,ANY_CATEGORY)){?><td id="toolbar-new"  align="center"><a href="<?php echo Url::build('manage_advertisment',array('cmd'=>'advertisment'));?>#"> <span title="New"> </span> <?php echo Portal::language('New');?> </a> </td><?php }?>
		 <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="<?php echo Portal::language('Help');?>"> </span> <?php echo Portal::language('Help');?> </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<div style="height:8px;"></div>
<fieldset id="toolbar">
<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
  <tr style="background-color:#F0F0F0">
	<th align="left" width="3%"><a>#</a></th>
	<th align="left"><a><?php echo Portal::language('title');?></a></th>
	<th align="left" width="20%"><a><?php echo Portal::language('website');?></a></th>
	<th align="left" width="10%"><a><?php echo Portal::language('category_name');?></a></th>
	<th align="left" width="7%" nowrap="nowrap"><a><?php echo Portal::language('start_date');?></a></th>
	<th align="left" width="7%" nowrap="nowrap"><a><?php echo Portal::language('end_date');?></a></th>
	<th align="left" width="10%"><a><?php echo Portal::language('count_click');?></a></th>
	<th align="left" width="15%"><a><?php echo Portal::language('region');?></a></th>
  </tr>		
  <?php $i = 0;?>
  <?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
  <tr style="cursor:hand;<?php if($i%2){echo 'background-color:#F9F9F9';}?>">
	<td><?php echo ++$i;?></td>
	<td><a href="<?php  echo Url::build('manage_advertisment',array('id'=>$this->map['items']['current']['id'],'cmd'=>'advertisment'));?>"><img src="skins/default/images/buttons/edit.jpg" title="<?php echo Portal::language('edit');?>"></a>&nbsp;<?php echo $this->map['items']['current']['name'];?></td>
	<td><?php echo $this->map['items']['current']['url'];?></td>
	<td><?php echo $this->map['items']['current']['category_name'];?></td>
	<td><?php echo date('d/m/Y',$this->map['items']['current']['start_time']);?></td>
	<td><?php echo date('d/m/Y',$this->map['items']['current']['end_time']);?></td>
	<td><?php echo $this->map['items']['current']['click_count'];?></td>
	<td><?php echo $this->map['items']['current']['region'];?>&nbsp;<b><a style="color:#FF0000" href="<?php echo Url::build($this->map['items']['current']['page'],array(),REWRITE);?>" target="_blank">(<?php echo $this->map['items']['current']['page'];?>)</a></b></td>
  </tr> 		
 
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
</table>  
 <table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;">
<tr>
	<td align="left"><?php echo Portal::language('have');?> <b><?php echo $this->map['total'];?></b> <?php echo Portal::language('advertisments');?></td>
</tr>
</table>
</fieldset>