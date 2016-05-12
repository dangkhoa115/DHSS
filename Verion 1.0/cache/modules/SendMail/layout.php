<div class="send-mail-bound">
<div class="send-mail-title">Mail this page to someone you know, or send it to yourself as a reminder...</div>
<div class="contactus-content">
	<?php if(Url::get('cmd')=='success'){ ?>
    <div class="send-mail-success-title">Your message has been sent to <?php echo $this->map['to_email'];?></div>
    <table width="100%" border="0" cellspacing="5" cellpadding="5">
        <tr>
	        <td>From:</td>
            <td><?php echo $this->map['email'];?></td>
        </tr>
        <tr>
	        <td>To:</td>
            <td><?php echo $this->map['to_email'];?></td>
        </tr>
        <tr>
	        <td>Subject:</td>
            <td><?php echo $this->map['subject'];?></td>
        </tr>
        <tr>
	        <td>Message:</td>
            <td><?php echo $this->map['content'];?></td>
        </tr>
    </table>
    <div align="center" style="padding:20px 0;"><a onclick="window.close();">Close</a></div>
    <?php }else{ ?>
	<?php if(Form::$current->is_error()) echo Form::$current->error_messages();?>
    <form id="SendMailForm" name="SendMailForm" method="post">
        <table width="100%" cellspacing="5" cellpadding="4">
            <tr>
                <td class="send-mail-lable"><label for="from_name">From (name):</label></td>
                <td><input  name="from_name" id="from_name" class="send-mail-input-text" type ="text" value="<?php echo String::html_normalize(URL::get('from_name'));?>"></td>
            </tr>
            <tr>
                <td class="send-mail-lable"><label for="from_email">From (email):</label></td>
                <td><input  name="from_email" id="from_email" class="send-mail-input-text" type ="text" value="<?php echo String::html_normalize(URL::get('from_email'));?>"></td>
                </tr>
            <tr>
                <td class="send-mail-lable"><label for="to_email">To (email):</label></td>
                <td><input  name="to_email" id="to_email" class="send-mail-input-text" type ="text" value="<?php echo String::html_normalize(URL::get('to_email'));?>"></td>
            </tr>
            <tr>
                <td class="send-mail-lable"><label for="subject">Subject:</label></td>
                <td><input  name="subject" id="subject" class="send-mail-input-text" type ="text" value="<?php echo String::html_normalize(URL::get('subject'));?>"></td>
            </tr>
            <tr>
                <td class="send-mail-lable" valign="top"><label for="content">Message:</label></td>
                <td><textarea  name="content" id="content" class="send-mail-input-text-large"><?php echo String::html_normalize(URL::get('content',''));?></textarea></td>
            </tr>
            <tr>
                <td class="send-mail-lable" valign="top"><label for="verify_confirm_code"><?php echo Portal::language('verify_confirm_code');?></label></td>
                <td><div  style="float:left"><img id="imgCaptcha" src="capcha.php" /></div><div><input  name="verify_confirm_code" id="verify_confirm_code" style="width:103px;" maxlength="4"/ type ="text" value="<?php echo String::html_normalize(URL::get('verify_confirm_code'));?>"></div></td>
            </tr>
            <tr>
                <td colspan="2" align="right" class="send-mail-button"><input  name="save" value="Send Email" id="save" class="send-mail-submit" type ="submit" value="<?php echo String::html_normalize(URL::get('save'));?>"></td>						
            </tr>
        </table>
    <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
    <?php }?>
	</div>	
</div>
<script type="text/javascript">
jQuery(function(){
	jQuery('#from_name').focus();
	jQuery('#reset').click(function(){
		jQuery('#from_name').focus();
		jQuery('.error').empty();
		jQuery('.success').empty();
	});
	jQuery('#SendMailForm').validate({
		success: function(label) {
			label.text("Ok!").addClass("success");
		},
		rules: {
			from_name: {
				required: true
			},
			from_email: {
				required: true,
				email: true
			},
			to_email: {
				required: true,
				email: true
			},
			subject: {
				required: true
			},
			content: {
				required: true,
				maxlength: 1000
			},
			verify_confirm_code: {
				required: true,
				minlength: 4,
				remote : 'form.php?block_id=<?php echo Module::block_id(); ?>&cmd=check_ajax'
			}
		},
		messages: {
			from_name: {
				required: 'Name missing'
			},
			from_email: {
				required: 'Invalid sender e-mail',
				email: 'Incorrect email format'
			},		
			to_email: {
				required: 'Invalid recipient e-mail',
				email: 'Incorrect email format'
			},		
			subject: {
				required: 'Subject missing',
			},		
			content: {
				required: 'Message missing',
				maxlength: 'Please enter at smaller or with 1000 characters'
			},
			verify_confirm_code: {
				required: 'Verity confirm code is required',
				minlength: 'Verity confirm code is smaller 4',
				remote: 'Verify confirm code is invalid'
			}
		}
	});
});
</script>
