<?php System::set_page_title(Portal::get_setting('website_title','').' '.'duplicate_title');?><?php echo Draw::begin_round_table();?><table cellspacing="0" width="100%">
	<tr valign="top">
		<td>&nbsp;</td>
		<td align="left" colspan="2"><font class="form_title"><b><?php echo Portal::language('duplicate_title');?></b></font></td>
	</tr>
	<tr bgcolor="#EEEEEE" valign="top">
	<td align="right">&nbsp;</td>
	<td bgcolor="#EEEEEE"><div style="width:10px;">&nbsp;</div></td>
	<td bgcolor="#EEEEEE">&nbsp;</td>
	</tr>
	<?php if(Form::$current->is_error())
	{
	?>	<tr bgcolor="#EEEEEE" valign="top">
	<td align="right">&nbsp;</td>
	<td bgcolor="#EEEEEE"><div style="width:10px;">&nbsp;</div></td>
	<td bgcolor="#EEEEEE">B&#225;o l&#7895;i<br /><?php echo Form::$current->error_messages();?></td>
	</tr>
	<?php
	}
	?>	<tr bgcolor="#EEEEEE" valign="top">
	<td>&nbsp;</td>
	<td bgcolor="#EEEEEE">&nbsp;</td>
	<td bgcolor="#EEEEEE">
      <form name="addLayout" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
        <table width="100%" border="0" class="body_text">
          <tr>
            <td width="149"><?php echo Portal::language('page_name');?></td>
            <td width="14" class="body_text">:</td>
            <td width="452"><input name="name" type="text" id="name" value="<?php echo $this->map['name'];?>" size="30">
            </td>
          </tr>
		   <tr>
		  	<td colspan="3">
			
<script src="<?php echo Portal::template('core');?>/css/tabs/tabpane.js" type="text/javascript"></script>
			<table width="100%" cellpadding="5" cellspacing="0">
			<tr><td>
				<?php
					if(isset($this->map['languages']) and is_array($this->map['languages']))
					{
						foreach($this->map['languages'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['languages']['current'] = &$item1;?>
				<table width="100%" border="0" class="body_text" id="enl_<?php echo $this->map['languages']['current']['id'];?>" <?php echo (($this->map['languages']['current']['id']==Portal::language())?'':'style="display:none"');?>>
				  <tr>
					<td width="141"><span class="style1"><?php echo Portal::language('title');?></span></td>
					<td width="10" class="body_text">:</td>
					<td width="446"><input  name="title_<?php echo $this->map['languages']['current']['id'];?>" id="title_<?php echo $this->map['languages']['current']['id'];?>" value="<?php echo $this->map['languages']['current']['title'];?>" style="width:100%" / type ="text" value="<?php echo String::html_normalize(URL::get('title_'.$this->map['languages']['current']['id']));?>"></td>
				  </tr>
				  <tr>
				    <td valign="top"><span class="style1"><?php echo Portal::language('description');?></span></td>
					<td>:</td>
					<td>
						<textarea  name="description_<?php echo $this->map['languages']['current']['id'];?>" style="width:100%" rows="7" id="description_<?php echo $this->map['languages']['current']['id'];?>"><?php echo String::html_normalize(URL::get('description_'.$this->map['languages']['current']['id'],''.$this->map['languages']['current']['description']));?></textarea>
						<script type="text/javascript">editor_generate("description_<?php echo $this->map['languages']['current']['id'];?>");</script>
					</td>
				  </tr>
				</table>
				
							
						<?php
							}
						}
					unset($this->map['languages']['current']);
					} ?>
			</td></tr></table>
			</td></tr>  
		   <tr>
            <td><?php echo Portal::language('params');?></td>
            <td>:</td>
            <td><input  name="params" id="params" size="30" type ="text" value="<?php echo String::html_normalize(URL::get('params'));?>"></td>
          </tr>
          <tr>
            <td><input type="submit" name="Submit" value="   <?php echo Portal::language('Add');?>   "></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
      <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
      <hr size="1" style="color:white">      
      <p><a href="<?php echo URL::build_current(array('portal_id','package_id'));?>"><?php echo Portal::language('page_list');?></a></p>
    </td>
  </tr>
</table>
<?php echo Draw::end_round_table();?>
