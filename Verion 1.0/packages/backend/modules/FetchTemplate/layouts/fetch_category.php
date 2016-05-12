<style>
	.list li{list-style:none;margin-bottom:5px;float:left;width:300px;}
	.list li button{float:right;}
	.list li.lv1{font-weight:bold;}
	.list li.lv2{}
	.list li.lv3{}
</style>
<div id="mask">Loading...</div>
<fieldset id="toolbar">
	<legend>[[.content_manage_system.]]</legend>
	<div id="toolbar-title">
		Lấy dữ liệu từ trang khác
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-back" align="center"><a href="<?php echo Url::build_current();?>#"> <span title="[[.List.]]"> </span> [[.List.]] </a> </td><?php }?>
		  <?php if(User::can_view(false,ANY_CATEGORY)){?><td id="toolbar-help" align="center"><a href="<?php echo Url::build('help');?>#"> <span title="Help"> </span> [[.Help.]] </a> </td><?php }?>
		</tr>
	  </tbody>
	</table>
	</div>
</fieldset>
<br>
<fieldset id="toolbar">
<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
<form method="post" name="form1">	
	<table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr valign="top">
      <td width="30%">
      	<table cellpadding="5" cellspacing="0" width="100%" style="#width:99%;" border="1" bordercolor="#E7E7E7" align="center">
          <tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
            <th width="26%" align="left"><a>[[.field_name.]]</a></th>
            <th width="70%" align="left"><a>[[.value.]]</a></th>
          </tr>
          <tr>
            <td>[[.url.]] (<span class="require">*</span>)</td>
            <td><input name="url" type="text" class="input-large" id="url"/></td>
          </tr>
          <tr>
            <td>Trạng thái</td>
            <td><span class="form_input">
              <select name="status" id="status">
                </select>
            </span></td>
            </tr>
          <tr>
            <td>Hành động</td>
            <td><select name="action" id="action" class="select-large">
              </select></td>
            </tr>	  
           <tr>
             <td colspan="2"><input name="fetch" type="submit" value=" Lấy dữ liệu " /></td>
            </tr>
        </table>
      </td>
      <td width="30%">
      	<h2>Danh mục hiện tại</h2>
      	<ul class="list">
        	<!--LIST:categories-->
        	<li class="[[|categories.class|]]">[[|categories.indent|]][[|categories.name|]] <?php if(Url::get('category_id') == [[=categories.id=]]){ echo '<span style="color:#FF0000;"> [Vừa lấy]</span>';}?><!--IF:cond([[=categories.can_crawler=]])--><button type="button" onclick="window.location='<?php echo Url::build_current(array('cmd'=>'fetch_product','category_id'=>[[=categories.id=]]));?>';">Lấy SP</button><!--/IF:cond--></li>
          <!--/LIST:categories-->
        </ul>
      </td>
      <td width="40%">
      	
      </td>
    </tr>
  </table>
</form>
</fieldset>
