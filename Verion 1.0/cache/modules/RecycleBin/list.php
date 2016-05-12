<script>	
	function make_cmd(cmd)
	{
		jQuery('#cmd').val(cmd);
		document.ListRecycleBinForm.submit();
	}
</script>	
<fieldset id="toolbar">
	<legend><?php echo Portal::language('System_management');?></legend>
	<div id="toolbar-info"><?php echo Portal::language('manage_recyclebin');?></div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
			<td id="toolbar-cancel"  align="center"><a onclick="if(confirm('<?php echo Portal::language('are_you_sure_empty');?>')){make_cmd('delete');}"> <span title="<?php echo Portal::language('empty');?>"> </span> <?php echo Portal::language('empty');?> </a> </td>
			<td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> <?php echo Portal::language('Help');?> </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<fieldset id="toolbar">
<form name="ListRecycleBinForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">	
	<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
	  <tr style="background-color:#F0F0F0">	
	    <th width="7%" align="left"><a><?php echo Portal::language('select_each_item_below_to_restore');?></a></th>
	  </tr>
	  <tr>
		<td>
			<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
				<?php 
				if((preg_match('/(.*)\.([0-9a-zA-Z]+).sql/',$this->map['items']['current']['name'],$matches)))
				{?>
				<div style="float:left;width:100px;height:88px;margin:9px;border:1px solid #E7E7E7;padding:2px;padding-bottom:0px;cursor:pointer" align="center"  onclick="location='<?php echo Url::build_current(array('cmd'=>'restore','path'=>$this->map['items']['current']['name'],'table'=>$matches[1],'id'=>$matches[2]));?>'" title="<?php echo $this->map['items']['current']['name'];?>">
					<div><img src="<?php echo $this->map['items']['current']['icon'];?>" width="50"></div>
					<div>
						<div><?php echo $matches[1];?>(<?php echo $matches[2];?>)</div>
						<div><?php echo $this->map['items']['current']['time'];?></div>
					</div>
				</div>	
				
				<?php
				}
				?>	
			
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
		</td>
	  </tr>
	</table>
	<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
	  <tr>
		<td>&nbsp;</td>
	  </tr>
	</table>
	<input  name="cmd" id="cmd" type ="hidden" value="<?php echo String::html_normalize(URL::get('cmd'));?>">
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
</fieldset>
