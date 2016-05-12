<script language="javascript" type="text/javascript" src="packages/core/includes/js/custom_input.js"></script>
<?php 
$title = (URL::get('cmd')=='delete')?Portal::language('delete_title'):Portal::language('list_title');
$action = (URL::get('cmd')=='delete')?'delete':'list';
System::set_page_title(Portal::get_setting('website_title','').' '.$title);?>
<TEXTAREA ID="holdtext" STYLE="display:none;">
</TEXTAREA>
<h1 style="color:#000000;"><?php echo Portal::language('setting_for');?> <?php echo $this->map['name'];?> </h1> 
<table width="100%"><tr><td style="font-size:16px;"><a target="_blank" href="<?php echo URL::build($this->map['page_name']);?>"><?php echo ucfirst($this->map['region']);?> <?php echo Portal::language('of');?> <?php echo $this->map['page_name'];?></a></td><td align="right"><a target="_blank" href="<?php echo URL::build('module_setting',array('module_id'=>$this->map['module_id']));?>"><?php echo Portal::language('module_setting');?></a></td></tr></table><br />
<div class="form_bound" style="background-color:#EFEFEF;border:1px solid #CCCCCC;padding:10px;">
	<div>
		<?php 
				if((sizeof($this->map['copy_setting_id_list'])>1))
				{?>
		<form name="CopyBlockSettingForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
			<input type="hidden" value="copy_setting" name="cmd" />
			<table><tr><td width="150"><?php echo Portal::language('copy_from');?></td><td> <select  name="copy_setting_id"><?php
					if(isset($this->map['copy_setting_id_list']))
					{
						foreach($this->map['copy_setting_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('copy_setting_id').value = "<?php echo addslashes(URL::get('copy_setting_id',isset($this->map['copy_setting_id'])?$this->map['copy_setting_id']:''));?>";</script>
	</select> <input type="submit" name="copy_setting" value="  <?php echo Portal::language('copy');?>  "/></td></tr></table>
		<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
		
				<?php
				}
				?>
		<form name="ListBlockSettingForm" method="post" enctype="multipart/form-data" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
		<p><table><tr><td width="150"><?php echo Portal::language('name');?></td><td> <input  name="name" id="name" / type ="text" value="<?php echo String::html_normalize(URL::get('name'));?>"></td></tr></table></p>
		<?php $column = 1;?>
<div class="tab-pane-1" id="tab-pane-item_type_field">
<?php
					if(isset($this->map['groups']) and is_array($this->map['groups']))
					{
						foreach($this->map['groups'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['groups']['current'] = &$item1;?>
	<div class="tab-page" id="tab-page-item_type_field-<?php echo $this->map['groups']['current']['id'];?>" style="height:100%;z-index:10;"> 
		<h1 class="tab"><?php echo $this->map['groups']['current']['name'];?></h1>
		<?php 
			$first = true;
		?>
			<table cellpadding="0" cellspacing="0" width="99%">
			<tr valign="top"><td>
			<?php
					if(isset($this->map['groups']['current']['items']) and is_array($this->map['groups']['current']['items']))
					{
						foreach($this->map['groups']['current']['items'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['groups']['current']['items']['current'] = &$item2;?>
			<?php if($this->map['groups']['current']['items']['current']['group_column'] != 1)
			{
				echo '</td><td>';
			}
			else
			if(!$first)
			{
				echo '</td></tr></table>';
				echo '<table cellpadding="0" cellspacing="0" width="99%">
					<tr valign="top"><td>';
			}
			else
			{
				$first = false;
			}
			?>
			<p>
			<a id="anchor_<?php echo $this->map['groups']['current']['items']['current']['id'];?>"></a>
			<?php 
				if(($this->map['groups']['current']['items']['current']['style']==1))
				{?>
			<div style="display:inline;width:250px;" title="<?php echo $this->map['groups']['current']['items']['current']['id'];?>" onclick="holdtext.innerText = '<?php echo $this->map['groups']['current']['items']['current']['id'];?>';Copied = holdtext.createTextRange(); Copied.execCommand('Copy');">
					<strong><?php echo $this->map['groups']['current']['items']['current']['name'];?></strong>
			</div>
			 <?php }else{ ?>
				<span style="font-weight:bold;font-size:14px" title="<?php echo $this->map['groups']['current']['items']['current']['id'];?>" onclick="holdtext.innerText = '<?php echo $this->map['groups']['current']['items']['current']['id'];?>';Copied = holdtext.createTextRange(); Copied.execCommand('Copy');"><?php echo $this->map['groups']['current']['items']['current']['name'];?></span><br />
				<?php 
				if(($this->map['groups']['current']['items']['current']['description']!=""))
				{?>
				<p><?php echo $this->map['groups']['current']['items']['current']['description'];?></p>
				
				<?php
				}
				?>
			
				<?php
				}
				?>
			<?php echo $this->map['groups']['current']['items']['current']['value'];?>
			<?php 
				if(($this->map['groups']['current']['items']['current']['style']==1))
				{?>
				<?php 
				if(($this->map['groups']['current']['items']['current']['description']!=""))
				{?>
				<p><?php echo $this->map['groups']['current']['items']['current']['description'];?></p>
				
				<?php
				}
				?>
			
				<?php
				}
				?>
			</p>
			
							
						<?php
							}
						}
					unset($this->map['groups']['current']['items']['current']);
					} ?>
			</td></tr></table>
</div>

							
						<?php
							}
						}
					unset($this->map['groups']['current']);
					} ?>
</div>		
<table width="100%" id="util_options"><tr>
<td id="notice" align="right" style="color:#FF3300;font-weight:bold;display:none;" width="50%"><?php echo Portal::language('data_is_updated');?>...!</td>
<td align="right">
<input type="button" value=" <?php echo Portal::language('close');?> " class="big_button" onclick="window.close();">
<input type="submit" name="save" value="   <?php echo Portal::language('save');?>   " class="big_button">
<a name="bottom_anchor" ><img src="<?php echo Portal::template('core');?>/images/top.gif" title="<?php echo Portal::language('top');?>" border="0" alt="<?php echo Portal::language('top');?>"></a>
</td>
</tr></table>      
<input type="hidden" name="confirm" value="1" />
<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
</div>
</div>
<?php if(Url::get('suss')){?>
<script type="text/javascript">
$('notice').style.display = ''
setTimeout("$('notice').style.display = 'none'",2000);
</script>
<?php }?>