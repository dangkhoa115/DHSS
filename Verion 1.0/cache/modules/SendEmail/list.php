<?php
if(Url::get('send_mail') && (Url::get('send_mail') == 'ok')) {
	echo '<script>jQuery(function(){
						jQuery.blockUI({
							message: "Gửi email thành công!",
							fadeIn: 700,
							fadeOut:700,
							timeout:2000
							});
						});</script>';
}
?>
<fieldset id="toolbar" style="margin-top:4px;position:relative;">
	<div id="toolbar-title">EMAIL MARKETING (<a href="#">>> Export txt</a>)</div>
</fieldset>
<fieldset id="toolbar" style="margin-top:4px;position:relative;">
	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
	<form name="SendEmail" id="SendEmail" method="post" action="?<?php echo htmlentities($_SERVER['QUERY_STRING']);?>">
			<table cellpadding="6" cellspacing="0" width="100%" bgcolor="" border="0" style="">
				<tr>
					<td width="100%">
						<label>Phân loại gửi : </label>
            <select  name="is_active" id="is_active" onchange="getId('cmd').value='search';SendEmail.submit();"><?php
					if(isset($this->map['is_active_list']))
					{
						foreach($this->map['is_active_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('is_active').value = "<?php echo addslashes(URL::get('is_active',isset($this->map['is_active'])?$this->map['is_active']:''));?>";</script>
	</select>
            <label>Subject của email:</label>
            <input  name="email_title" id="email_title" style="padding:5px;width:200px;"/ type ="text" value="<?php echo String::html_normalize(URL::get('email_title'));?>">
            <label>Template : </label><select  name="email_template" id="email_template"style="padding:5px"><?php
					if(isset($this->map['email_template_list']))
					{
						foreach($this->map['email_template_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('email_template').value = "<?php echo addslashes(URL::get('email_template',isset($this->map['email_template'])?$this->map['email_template']:''));?>";</script>
	</select>
            <label>Thời gian chờ:</label>
            <input value="<?php echo Url::get('duration',30)?>" name="duration" type="text" id="duration" style="padding:5px;width:50px;" />              
            <label><?php echo Portal::language('Email_refer');?>:</label>
              <select  name="email_refer" id="email_refer"><?php
					if(isset($this->map['email_refer_list']))
					{
						foreach($this->map['email_refer_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('email_refer').value = "<?php echo addslashes(URL::get('email_refer',isset($this->map['email_refer'])?$this->map['email_refer']:''));?>";</script>
	</select>                        
  						<input  name="send_email" value="Gửi email" id="send_email" style="cursor:pointer;font-weight:bold;padding:5px;" onclick="sendmail();" type ="button" value="<?php echo String::html_normalize(URL::get('send_email'));?>">
					</td>
				</tr>
		</table>
        <div id="email_content" style="display:none;position:fixed;border:1px solid red;border-radius:10px;box-shadow:#333 3px 3px 10px;width:300px;background-color:#FFFFCC;right:50px;padding:10px;color:blue;font-weight:bold;font-size:14px;"></div>
		<table cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:-1px;" border="1" bordercolor="#E7E7E7" align="center">
			<thead>
                <tr valign="middle" bgcolor="#F0F0F0" style="line-height:20px">
					<th width="2%" align="center" nowrap><a>#</a></th>
					<th width="3%"  align="center">
					  <input type="checkbox" value="1" id="SendEmail_all_checkbox" onclick="select_all_checkbox(this.form,'SendEmail',this.checked,'<?php echo '#FFFFFF';?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');"<?php if(URL::get('cmd')=='delete') echo ' checked';?>></th />
					<th width="2%" align="left" nowrap>Kích hoạt</th>
        	<th width="25%" align="left" nowrap>Họ và tên</th>
        	<th width="5%" align="left" nowrap>igold</th>
          <th width="15%" align="left" nowrap><a><?php echo Portal::language('email');?></a></th>
          <th width="25%" align="left" nowrap>CMTND</th>
          <th width="25%" align="left" nowrap><a><?php echo Portal::language('address');?></a></th>
          <th align="left" nowrap><a>Tháng sinh</a></th>
				</tr>
        <tr valign="middle" style="line-height:20px">
        <th align="left" nowrap>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th><input  name="keyword" type="text" id="keyword" onchange="SendEmail.submit();" class="form-control" style="width:100%;" placeholder="Nhập từ khóa tìm kiếm" value="<?php echo Url::get('keyword');?>" /></th>
        <th align="left" nowrap>&nbsp;</th>             
        <th align="left" nowrap>&nbsp;</th>
        <th align="left" nowrap>&nbsp;</th>
        <th align="left" nowrap><select  name="zone_id" id="zone_id" onchange="document.SendEmail.submit();"><?php
					if(isset($this->map['zone_id_list']))
					{
						foreach($this->map['zone_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('zone_id').value = "<?php echo addslashes(URL::get('zone_id',isset($this->map['zone_id'])?$this->map['zone_id']:''));?>";</script>
	
        </select></th>
        <th width="" align="left" nowrap><select  name="month" id="month" class="inputbox" size="1" onchange="document.SendEmail.submit();"><?php
					if(isset($this->map['month_list']))
					{
						foreach($this->map['month_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('month').value = "<?php echo addslashes(URL::get('month',isset($this->map['month'])?$this->map['month']:''));?>";</script>
	</select></th>
				</tr>
		  </thead>
				<tbody>
				<?php $i=0;$total = $this->map['total'];?>
				<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
				<tr valign="middle"  style="cursor:hand;" id="SendEmail_tr_<?php echo $this->map['items']['current']['id'];?>">
					<th width="2%" align="center" nowrap><?php echo $this->map['items']['current']['i'];?></th>
					<td width="3%" align="center"><input name="selected_ids[]" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>" onclick="select_checkbox(this.form,'SendEmail',this,'<?php echo '#FFFFFF';?>','<?php echo Portal::get_setting('crud_item_bgcolor','white');?>');" class="selected_ids" id="SendEmail_checkbox" <?php if(URL::get('cmd')=='delete') echo 'checked';?>></td>
					<td align="center" ><?php echo ($this->map['items']['current']['is_active']?'<span>Đã KH</span>':'<span style="color:#F00;">Chưa KH</span>');?></td>
					<td align="left" ><?php echo $this->map['items']['current']['full_name'];?></td>
					<td align="right" style="font-weight:bold;color:#FF6226;"><?php echo $this->map['items']['current']['igold'];?></td>
          <td align="left" ><?php 
				if((isset($this->map['items']['current']['disabled_email']) and $this->map['items']['current']['disabled_email']))
				{?><span style="text-decoration:line-through"><?php echo $this->map['items']['current']['email'];?></span> <?php }else{ ?><?php echo $this->map['items']['current']['email'];?>
				<?php
				}
				?></td>
          <td align="left" ><?php echo $this->map['items']['current']['cmtnd'];?></td>
          <td align="left" ><?php echo $this->map['items']['current']['zone_name'];?></td>
					<td align="left" ><?php echo ($this->map['items']['current']['birth_date']);?></td>
				</tr>
				
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
				</tbody>
	  </table>
		<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid <?php echo '#F1F1F1';?>;border-top:0px;height:8px;#width:99%" align="center">
		<tr>
			<td width="50%"><?php echo $this->map['paging'];?></td>
    </tr>
		</table>
		<input type="hidden" name="cmd" value="" id="cmd"/>
  <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
  <div style="#height:8px;"></div>
</fieldset>
<style>
	.quick-menu-item.add,
	.quick-menu-item.edit,
	.quick-menu-item.delete,
	.quick-menu-item.update,
	.quick-menu-item.move,
	.quick-menu-item.cache,
	.quick-menu-item.cache,
	.quick-menu-item.save,
	.quick-menu-item.list,
	.quick-menu-item.print
	{
		display:none;
	}
</style>
<script>
function sendmail(){
	jQuery('#email_content').fadeIn();
	jQuery('#email_content').append('.');
	var speed = jQuery('#duration').val()*1000;
	// init timer and stores it's identifier so it can be unset later
	var timer = setInterval(runSendMail, speed);
	var articles =  jQuery("#SendEmail input[type='checkbox']:checked")
	var length = articles.length;
	var index = 0;	
	function runSendMail() {
		if(length > 0){
			id = articles.eq(index).val();
			check_send_email(id,index);
			index++;
			if (index >= length) {
			 clearInterval(timer);
			}
		}else{
			alert('Bạn phải chọn ít nhật một tài khoản!');
			jQuery('#email_content').fadeOut();
			clearInterval(timer);
		}
	}
}
function check_send_email(id,index)
{
	jQuery.ajax({
		method: "POST",
		url: 'send_email.php',
		data : {
			duration:jQuery('#duration').val(),
			template:jQuery('#email_template').val(),
			email_title:jQuery('#email_title').val(),
			email_refer:jQuery('#email_refer').val(),
			id:id
		},
		beforeSend: function(){
			jQuery('#email_content').append('<span id="'+index+'"></span>');
			dot_content = setInterval("jQuery('#"+index+"').append('.');",1000);
		},
		success: function(content){
			clearInterval(dot_content);
			jQuery('#email_content').css('display','block');
			if(index>3)
			{
				jQuery('#'+(index-3)).fadeOut();
			}
			jQuery('#'+index).append('<br />'+content);
		}
	});
}
function CreateFullNameForm(id,value){
	var str = '<input  name="full_name_input_'+id+'" type="text" id ="full_name_input_'+id+'" value="'+value+'" />&nbsp;&nbsp;<input  name="update_fullname" onclick="UpdateFullName(\''+id+'\');" id="update_fullname" value="save" / type ="button" value="<?php echo String::html_normalize(URL::get('update_fullname'));?>">';
	jQuery('#full_name_'+id).html(str);
}
function UpdateFullName(id){
	jQuery.ajax({
		method: "POST",
		url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
		data : {
			cmd:'UpdateFullName',
			value:jQuery('#full_name_input_'+id).val(),
			nguoi_choi_id:id
		},
		beforeSend: function(){
		},
		success: function(content){
			jQuery('#full_name_'+id).html(content);
		}
	});
}
</script>
