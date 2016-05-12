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
			<a href="<?php echo Url::build_current(array('cmd'=>'fetch_category'));?>" class="link-template">Lấy danh mục</a>					
		</div>
	</div>	
	<div  class="bound-template" align="center">
		<div>
			<a href="<?php echo Url::build_current(array('cmd'=>'fetch_sản phẩm'));?>" class="link-template">Lấy sản phẩm</a>
		</div>	
	</div>	
	</div>
</fieldset>
