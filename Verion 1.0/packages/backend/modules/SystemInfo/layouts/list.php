<fieldset id="toolbar">
	<legend>[[.System_manage.]]</legend>
	<div id="toolbar-info">[[.system_info.]]</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		 <td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="[[.Help.]]"> </span> [[.Help.]] </a> </td>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<div style="height:8px;"></div>
<script type="text/javascript">
	jQuery(function() {
		jQuery('#SystemInfo').tabs();
		});
</script>
 <fieldset id="toolbar">
 <div id="SystemInfo" align="center">
	<ul>
		<li><a href="#system_info"><span>[[.system_info.]]</span></a></li>
		<li><a href="#PHP_core"><span>[[.PHP_core.]]</span></a></li>
		<li><a href="#PHP_configs"><span>[[.PHP_configs.]]</span></a></li>
		<li><a href="#apache2handler"><span>[[.apache2handler.]]</span></a></li>
		<li><a href="#Apache_environment"><span>[[.Apache_environment.]]</span></a></li>
		<li><a href="#gd"><span>[[.Graph_driver.]]</span></a></li>
		<li><a href="#mysql"><span>[[.mysql.]]</span></a></li>
		<li><a href="#session"><span>[[.session.]]</span></a></li>
	</ul>
	<div id="system_info">
		<br>
		<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
		  <tr style="background-color:#F0F0F0">
				<th colspan="2" align="left"><a>[[.System_info.]]</a></th>
		  </tr>
		  <tr >
			<td width="27%" align="left">PHP Version</td>
			<td width="73%" align="left"><?php echo phpversion();?></td>
		  </tr>
		  <tr>
			<td align="left">Zend Version</td>
			<td align="left"><?php echo zend_version();?></td>
		  </tr>
		  <tr >
			<td align="left">Client Browser</td>
			<td align="left"><?php echo $_SERVER['HTTP_USER_AGENT'];?></td>
		  </tr>
		  <tr >
			<td align="left">Server Name</td>
			<td align="left"><?php echo $_SERVER['SERVER_NAME'];?></td>
		  </tr>
		  <tr >
			<td align="left">Mysql Server Info</td>
			<td align="left"><?php echo mysql_get_server_info();?></td>
		  </tr>
		  <tr >
			<td align="left">GD2 Library</td>
			<td align="left"><?php $gd2 = gd_info();echo $gd2['GD Version'];?></td>
		  </tr>
		  <tr >
			<td align="left">Server IP</td>
			<td align="left"><?php echo gethostbyname($_SERVER['HTTP_HOST']);?></td>
		  </tr>
		  <tr >
			<td align="left">Client IP</td>
			<td align="left"><?php echo gethostbyname($_SERVER['REMOTE_ADDR']);?></td>
		</tr>
	</table>
	</div>
	<div id="PHP_core">
		<br>
		<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
		  <tr style="background-color:#F0F0F0">
				<th colspan="2" align="left"><a>[[.PHP_core.]]</a></th>
		  </tr>
		  <?php foreach($this->map['system_info']['Core'] as $key=>$value){?>
		  <tr >
			<td width="27%" align="left"><?php echo $key;?></td>
			<td width="73%" align="left"><?php echo is_array($value)?implode(',',$value):$value;?></td>
		  </tr>		 
		  <?php }?>
	</table>
	</div>
	<div id="PHP_configs">
		<br>
		<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
		  <tr style="background-color:#F0F0F0">
				<th colspan="2" align="left"><a>[[.PHP_configs.]]</a></th>
		  </tr>
		  <?php foreach($this->map['system_info']['PHP Configuration'] as $key=>$value){?>
		  <tr >
			<td width="27%" align="left"><?php echo $key;?></td>
			<td width="73%" align="left"><?php echo is_array($value)?implode(',',$value):$value;?></td>
		  </tr>		 
		  <?php }?>
	</table>
	</div>
	<div id="apache2handler">
		<br>
		<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
		  <tr style="background-color:#F0F0F0">
				<th colspan="2" align="left"><a>[[.apache2handler.]]</a></th>
		  </tr>
		  <?php foreach($this->map['system_info']['apache2handler'] as $key=>$value){?>
		  <tr >
			<td width="27%" align="left"><?php echo $key;?></td>
			<td width="73%" align="left"><?php echo is_array($value)?implode(',',$value):$value;?></td>
		  </tr>		 
		  <?php }?>
	</table>
	</div>
	<div id="Apache_environment">
		<br>
		<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
		  <tr style="background-color:#F0F0F0">
				<th colspan="2" align="left"><a>[[.Apache_environment.]]</a></th>
		  </tr>
		  <?php foreach($this->map['system_info']['Apache Environment'] as $key=>$value){?>
		  <tr >
			<td width="27%" align="left"><?php echo $key;?></td>
			<td width="73%" align="left"><?php echo is_array($value)?implode(',',$value):$value;?></td>
		  </tr>		 
		  <?php }?>
	</table>
	</div>
	<div id="gd">
		<br>
		<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
		  <tr style="background-color:#F0F0F0">
				<th colspan="2" align="left"><a>[[.Graph_driver.]]</a></th>
		  </tr>
		  <?php foreach($this->map['system_info']['gd'] as $key=>$value){?>
		  <tr >
			<td width="27%" align="left"><?php echo $key;?></td>
			<td width="73%" align="left"><?php echo is_array($value)?implode(',',$value):$value;?></td>
		  </tr>		 
		  <?php }?>
	</table>
	</div>
	<div id="mysql">
		<br>
		<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
		  <tr style="background-color:#F0F0F0">
				<th colspan="2" align="left"><a>[[.mysql.]]</a></th>
		  </tr>
		  <?php foreach($this->map['system_info']['mysql'] as $key=>$value){?>
		  <tr >
			<td width="27%" align="left"><?php echo $key;?></td>
			<td width="73%" align="left"><?php echo is_array($value)?implode(',',$value):$value;?></td>
		  </tr>		 
		  <?php }?>
	</table>
	</div>
	<div id="session">
		<br>
		<table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
		  <tr style="background-color:#F0F0F0">
				<th colspan="2" align="left"><a>[[.session.]]</a></th>
		  </tr>
		  <?php foreach($this->map['system_info']['session'] as $key=>$value){?>
		  <tr >
			<td width="27%" align="left"><?php echo $key;?></td>
			<td width="73%" align="left"><?php echo is_array($value)?implode(',',$value):$value;?></td>
		  </tr>		 
		  <?php }?>
	</table>
	</div>
</div>
<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
<tr>
	<td align="right">&nbsp;</td>
</tr>
</table>

</fieldset> 