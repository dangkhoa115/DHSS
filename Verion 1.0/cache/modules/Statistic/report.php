<fieldset id="toolbar">
	<div id="toolbar-info">Báo cáo định mức hàng tháng <?php echo Url::get('month')?></div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		 	<td>
      <form name="ReportForm" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
       Tháng <select  name="month" id="month"><?php
					if(isset($this->map['month_list']))
					{
						foreach($this->map['month_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('month').value = "<?php echo addslashes(URL::get('month',isset($this->map['month'])?$this->map['month']:''));?>";</script>
	</select>
        <input type="submit" value="OK">
      <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
      </td>
	  </tbody>
	</table>
	</div>
</fieldset>
<fieldset id="toolbar">
	<table width="100%" border="1" cellspacing="0" cellpadding="5">
  <tbody>
  	<?php
					if(isset($this->map['reports']) and is_array($this->map['reports']))
					{
						foreach($this->map['reports'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['reports']['current'] = &$item1;?>
    <tr <?php echo ($this->map['reports']['current']['id']=='label')?'style="font-weight:bold;background:#DDD;"':'';?>>
      <td><?php echo $this->map['reports']['current']['name'];?></td>
      <?php
					if(isset($this->map['dates']) and is_array($this->map['dates']))
					{
						foreach($this->map['dates'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['dates']['current'] = &$item2;?>
      <td><?php echo $this->map['reports']['current'][$this->map['dates']['current']['id']];?></td>
      
							
						<?php
							}
						}
					unset($this->map['dates']['current']);
					} ?>
    </tr>
    
							
						<?php
							}
						}
					unset($this->map['reports']['current']);
					} ?>
  </tbody>
</table>

</fieldset>
<script>
jQuery(document).ready(function(){
	jQuery('#date_from').datepicker();
	jQuery('#date_to').datepicker();
});

</script>