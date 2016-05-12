<div class="survey-wrapper full">
<?php if($this->map['check']==1){?>
<div class="title"><h3><?php echo $this->map['question'];?></h3></div>
<div class="row">
<table  width="100%"  cellpadding="5" cellspacing="0">
<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
	<tr>
		<td width="100%">
		<span class="option"><?php echo $this->map['items']['current']['name'];?></span> (<?php echo $this->map['items']['current']['count'];?> kết quả / <?php echo $this->map['items']['current']['percent'];?>%)
		<table width="100%" cellpadding="0" cellspacing="0" class="result">
			<tr>
				<td bgcolor="#1B6FAC" width="<?php echo $this->map['items']['current']['width'];?>%" height="5"></td>
                <td style="font-size:6px;">&nbsp;</td>
			</tr>
		</table>
		</td>
	</tr>

							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
</table>	
</div>
<?php }else{?>
<table width="100%" cellpadding="3" cellspacing="2">
	<tr>
		<td><?php echo Portal::language('no_result');?><br /></td>
	</tr>
</table>
<?php }?><hr size="1" color="#CCC">
<div class="button-wrapper"><button onclick="window.close()"><?php echo Portal::language('close');?></button></div>
</div>