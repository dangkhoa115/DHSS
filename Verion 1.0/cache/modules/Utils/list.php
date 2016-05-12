<fieldset id="toolbar">
	<legend><?php echo Portal::language('utils');?></legend>
	<div id="toolbar-info"><?php echo Portal::language('Utils_other');?></div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		<td id="toolbar-preview"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'update'));?>"><span title="[[.update.]"> </span> <?php echo Portal::language('update');?> </a> </td>
		 <td id="toolbar-help" align="center"><a href="<?php echo Url::build('help');?>"> <span title="[[.Help.]"> </span> <?php echo Portal::language('Help');?> </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<script type="text/javascript">
	jQuery(function() {
		jQuery('#AccountUtils').tabs();
		});
</script>
<div style="height:8px;"></div>
 <fieldset id="toolbar">
<form name="UtilsForm " method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>" id="AccountUtilsForm" enctype="multipart/form-data">	
  <div id="AccountUtils" align="center">
	<ul>
		<li><a href="#weather"><span><?php echo Portal::language('weather');?></span></a></li>
		<li><a href="#golden_exchange"><span><?php echo Portal::language('golden_exchange');?></span></a></li>
		<li><a href="#currency"><span><?php echo Portal::language('currency');?></span></a></li>
	</ul>
	<div id="golden_exchange">
		<br>
			<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
				<tr style="background-color:#F0F0F0">
					<th align="left"><a><?php echo Portal::language('id');?></a></th>
					<th align="left"><a><?php echo Portal::language('name');?></a></th>
					<th align="left"><a><?php echo Portal::language('sell');?></a></th>
					<th align="left"><a><?php echo Portal::language('buy');?></a></th>
				</tr>	
				<?php
					if(isset($this->map['golden']) and is_array($this->map['golden']))
					{
						foreach($this->map['golden'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['golden']['current'] = &$item1;?>
				<tr <?php Draw::hover('#FFFFDD');?> style="cursor:hand;<?php if($this->map['golden']['current']['id']%2){echo 'background-color:#F9F9F9';}?>">
					<td align="left"><?php echo $this->map['golden']['current']['id'];?></td>
					<td align="left"><?php echo $this->map['golden']['current']['name'];?></td>
					<td align="left"><?php echo $this->map['golden']['current']['sell'];?></td>
					<td align="left"><?php echo $this->map['golden']['current']['buy'];?></td>
				</tr>				
				
							
						<?php
							}
						}
					unset($this->map['golden']['current']);
					} ?>		
			</table>	
	</div>	
	<div id="weather">
		<br>
			<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
				<tr style="background-color:#F0F0F0">
					<th width="4%" align="left"><a><?php echo Portal::language('id');?></a></th>
					<th align="left"><a><?php echo Portal::language('province');?></a></th>
					<th align="left"><a><?php echo Portal::language('temperature');?></a></th>
					<th align="left"><a><?php echo Portal::language('image_url');?></a></th>
				</tr>	
				<?php
					if(isset($this->map['weather']) and is_array($this->map['weather']))
					{
						foreach($this->map['weather'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['weather']['current'] = &$item2;?>
				<tr <?php Draw::hover('#FFFFDD');?> style="cursor:hand;<?php if($this->map['weather']['current']['id']%2){echo 'background-color:#F9F9F9';}?>">
					<td align="left"><?php echo $this->map['weather']['current']['id'];?></td>
					<td align="left"><?php echo $this->map['weather']['current']['province'];?></td>
					<td align="left"><?php echo $this->map['weather']['current']['temperature'];?></td>
					<td align="left"><img src="<?php echo $this->map['weather']['current']['images'];?>" /></td>
				</tr>				
				
							
						<?php
							}
						}
					unset($this->map['weather']['current']);
					} ?>		
			</table>	
	</div>	
	<div id="currency">
		<br>
			<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
				<tr style="background-color:#F0F0F0">
					<th align="left"><a><?php echo Portal::language('id');?></a></th>
					<th align="left"><a><?php echo Portal::language('name');?></a></th>
					<th align="left"><a><?php echo Portal::language('exchange');?></a></th>
					<th align="left"><a><?php echo Portal::language('position');?></a></th>
				</tr>	
				<?php
					if(isset($this->map['currency']) and is_array($this->map['currency']))
					{
						foreach($this->map['currency'] as $key3=>&$item3)
						{
							if($key3!='current')
							{
								$this->map['currency']['current'] = &$item3;?>
				<tr <?php Draw::hover('#FFFFDD');?> style="cursor:hand;<?php if($this->map['currency']['current']['id']%2){echo 'background-color:#F9F9F9';}?>">
					<td align="left"><?php echo $this->map['currency']['current']['id'];?></td>
					<td align="left"><?php echo $this->map['currency']['current']['brief'];?></td>
					<td align="left"><?php echo $this->map['currency']['current']['exchange'];?></td>
					<td align="left"><?php echo $this->map['currency']['current']['position'];?></td>
				</tr>				
				
							
						<?php
							}
						}
					unset($this->map['currency']['current']);
					} ?>		
			</table>	
	</div>	
</div>
<input  name="cmd" type ="hidden" id="d" value="<?php echo String::html_normalize(URL::get('cmd','save'));?>">
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
				
<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
	<tr>
		<td align="right">&nbsp;</td>
	</tr>
</table>

</fieldset> 
