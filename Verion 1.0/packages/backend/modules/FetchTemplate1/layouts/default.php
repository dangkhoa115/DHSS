<fieldset id="toolbar">
	<legend>[[.content_manage_system.]]</legend>
	<div id="toolbar-title">
		[[.fetch_template.]]
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="Help"> </span> [[.Help.]] </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<fieldset id="toolbar">
<legend>[[.template_list.]]</legend>
	<div class="bound-template" align="center">
		<div>
			<a href="<?php echo Url::build_current(array('cmd'=>'fetch_dantri'));?>" class="link-template">[[.fetch_dantri.]]</a>					
			<a href="http://dantri.com.vn" target="_blank"><br>(Báo dân trí)</a>
		</div>
	</div>	
	<div  class="bound-template" align="center">
		<div>
			<a href="<?php echo Url::build_current(array('cmd'=>'fetch_vnexpress'));?>" class="link-template">[[.fetch_vnexpress.]]</a>
			<a href="http://vnexpress.net" target="_blank"><br>(Báo vnexpress)</a>
		</div>	
	</div>
	<div  class="bound-template" align="center">
		<div>
			<a href="<?php echo Url::build_current(array('cmd'=>'fetch_tuoitre'));?>" class="link-template">[[.fetch_tuoitre.]]</a>
			<a href="http://www.tuoitre.com.vn" target="_blank"><br>(Báo tuổi trẻ)</a>	
		</div>	
	</div>
	<div  class="bound-template" align="center">
		<div>
			<a href="<?php echo Url::build_current(array('cmd'=>'fetch_vnnet'));?>" class="link-template">[[.fetch_vietnamnet.]]</a>
			<a href="http://vietnamnet.vn/" target="_blank"><br>(Báo vietnamnet)</a>	
		</div>	
	</div>
</fieldset>
