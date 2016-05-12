<fieldset id="toolbar">
	<legend><?php echo Portal::language('System_manage');?></legend>
	<div id="toolbar-info"><?php echo Portal::language('statistic');?></div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="<?php echo Portal::language('Help');?>"> </span> <?php echo Portal::language('Help');?> </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<div style="height:8px;"></div>
<fieldset id="toolbar">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25%" valign="top">
		<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
		<tr>
			<td width="60%" style="background-color:#F0F0F0"><b><?php echo Portal::language('user_online');?></b></td>
			<td width="40%"><b><?php echo $this->map['user_online'];?></b></td>		
		  </tr>		 
			  <tr>
			<td width="60%" style="background-color:#F0F0F0"><b><?php echo Portal::language('date_page_view');?></b></td>
			<td width="40%"><b><?php echo $this->map['date_page_view'];?></b></td>		
		  </tr>
		<tr>
			<td width="60%" style="background-color:#F0F0F0"><b><?php echo Portal::language('month_page_view');?></b></td>
			<td width="40%"><b><?php echo $this->map['month_page_view'];?></b></td>		
		  </tr>
		 <tr>
			<td width="60%" style="background-color:#F0F0F0"><b><?php echo Portal::language('year_page_view');?></b></td>
			<td width="40%"><b><?php echo $this->map['year_page_view'];?></b></td>		
		  </tr>		
		   <tr>
			<td width="60%" style="background-color:#F0F0F0"><b><?php echo Portal::language('total_page_view');?></b></td>
			<td width="40%"><b><?php echo $this->map['total_page_view'];?></b></td>		
		  </tr>  
	  </table> 
	</td>
	<td valign="top">&nbsp;</td>
    <td width="75%" valign="top">
		<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
		  <tr style="background-color:#F0F0F0">
		  	<th align="center"><a><?php echo Portal::language('chart_statistis');?></a>
			<form name="Statistic" method="post">
			&nbsp;<select  name="month" class="select" id="month"><?php
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
			&nbsp;<select  name="year" class="select" id="year"><?php
					if(isset($this->map['year_list']))
					{
						foreach($this->map['year_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('year').value = "<?php echo addslashes(URL::get('year',isset($this->map['year'])?$this->map['year']:''));?>";</script>
	</select>
			<input name="view" type="submit"  value="<?php echo Portal::language('view');?>" id="view">	
			<script>
				document.getElementById('month').value = '<?php echo Url::get('month',date('m'));?>';
				document.getElementById('year').value = '<?php echo Url::get('year',date('Y'));?>';
			</script>
			<input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
			</th>
		 </tr>
		 <tr>
		 	<td valign="bottom" align="center">
			 <div id="placeholder" style="width:90%;height:300px;"></div>
				<script src="packages/core/includes/js/jquery/jquery-1.7.1.js"></script>
				<script src="packages/core/includes/js/jquery/jquery.flot.js"></script>
				<script language="javascript" type="text/javascript">
				jQuery(function () {
					var data = [];
						<?php
					if(isset($this->map['data']) and is_array($this->map['data']))
					{
						foreach($this->map['data'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['data']['current'] = &$item1;?>
					   data.push([<?php echo intval($this->map['data']['current']['id']);?>, <?php echo $this->map['data']['current']['amount'];?>]);	
						
							
						<?php
							}
						}
					unset($this->map['data']['current']);
					} ?>
					var plot = jQuery.plot(
						$("#placeholder"),
						   [{ data: data, label: "<?php echo Portal::language('page_view_day_in_month').' '.Url::get('month',date('m')).' '.Portal::language('year').' '.Url::get('year',date('Y'));?>"}],
						   { 
							 lines: { show: true },
							 points: { show: true},
							 selection: { mode: "xy" },
							 grid: { 
								hoverable: true
								,clickable: true 
								,color: '#000000'
								,borderWidth:0.4
							 },
							 yaxis: {tickSize:((<?php echo $this->map['max'];?>/300)*100),min:0, max: (<?php echo $this->map['max'];?>+10) },
							 xaxis: {tickSize:1,min:0,max:<?php echo cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y')); ?>}
							}
					);
					function showTooltip(x, y, contents) {
						jQuery('<div id="tooltip">' + contents + '</div>').css( {
							position: 'absolute',
							display: 'none',
							top: y + 5,
							left: x + 5,
							border: '1px solid #fdd',
							padding: '2px',
							'background-color': '#fee',
							opacity: 0.80
						}).appendTo("body").fadeIn(200);
					}
				
					var previousPoint = null;
					jQuery("#placeholder").bind("plothover", function (event, pos, item) {
						jQuery("#x").text(pos.x);
						jQuery("#y").text(pos.y);
							if (item) {
								if (previousPoint != item.datapoint) {
									previousPoint = item.datapoint;
									
									jQuery("#tooltip").remove();
									var x = item.datapoint[0],
										y = item.datapoint[1];
									
									showTooltip(item.pageX, item.pageY,
												item.series.label = "<?php echo Portal::language('page_view');?>" + y +'(<?php echo Portal::language('date');?>:'+x+')');
								}
							}
							else {
								jQuery("#tooltip").remove();
								previousPoint = null;            
							}
					});
				});
				</script>
			</td>
		 </tr>
		</table>	
	</td>
  </tr>
</table>	 
 <table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:8px;" border="1" bordercolor="#E7E7E7" align="center">
	<tr bgcolor="#F0F0F0">
		<th align="left"><a><?php echo Portal::language('stt');?></a></th>
		<th align="left" nowrap><a><?php echo Portal::language('user_id');?></a></th>
		<th align="left"><a><?php echo Portal::language('Ip');?></a></th>
		<th align="left"><a><?php echo Portal::language('Client');?></a></th>
		<th align="left"><a><?php echo Portal::language('country');?></a></th>
		<th align="left"><a><?php echo Portal::language('time');?></a></th>
		<th align="left"><a><?php echo Portal::language('on_page');?></a></th>
	</tr>
	<?php $i = 0;?>
	<?php
					if(isset($this->map['list']) and is_array($this->map['list']))
					{
						foreach($this->map['list'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['list']['current'] = &$item2;?>
	<tr <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if($i%2){echo 'background-color:#F9F9F9';}?>">
		<td><?php echo $i++;?></td>
		<td><strong><?php echo $this->map['list']['current']['user_id'];?></strong></td>
		<td><?php echo $this->map['list']['current']['ip'];?></td>
		<td><div style="width:500px;overflow:auto"><?php echo $this->map['list']['current']['client'];?></div></td>
		<td><?php echo $this->map['list']['current']['country'];?></td>
		<td><?php echo date('H\h:i\' d/m/Y',$this->map['list']['current']['time']);?></td>
		<td>
			<div  style="height:70px;overflow:auto;width:380px;">
			<?php
					if(isset($this->map['list']['current']['pages']) and is_array($this->map['list']['current']['pages']))
					{
						foreach($this->map['list']['current']['pages'] as $key3=>&$item3)
						{
							if($key3!='current')
							{
								$this->map['list']['current']['pages']['current'] = &$item3;?>
			<div><?php echo $this->map['list']['current']['pages']['current']['page'];?></div>
			
							
						<?php
							}
						}
					unset($this->map['list']['current']['pages']['current']);
					} ?>		
			</div>
		</td>
	</tr>
	
							
						<?php
							}
						}
					unset($this->map['list']['current']);
					} ?>
</table>	
<div style="#height:8px"></div>
</fieldset>
