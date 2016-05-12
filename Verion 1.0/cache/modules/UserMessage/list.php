<div class="row">
	<div class="col-xs-12 tin-nhan">
  	<h2 class="title"><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span> TIN NHẮN</h2>
  	<nav class="tab">
  	<ul>
      <li><a href="<?php echo Url::build_current(array('act'=>'nhan'));?>" <?php echo (Url::get('act')=='nhan')?' class="active"':''?>>Nhận</a></li>
      <li><a href="<?php echo Url::build_current(array('act'=>'gui'));?>" <?php echo (Url::get('act')=='gui')?' class="active"':''?>>Đã gửi</a></li>
    </ul>
  </nav>
    <form name="ListUserMessageForm" method="post">
    <div class="form-group hide">
      Từ khóa <input  name="keyword" id="keyword" class="form-control" / type ="text" value="<?php echo String::html_normalize(URL::get('keyword'));?>">
      Từ ngày <input  name="task_start_time" id="task_start_time" class="form-control" / type ="text" value="<?php echo String::html_normalize(URL::get('task_start_time'));?>">
      Đến <input  name="task_finish_time" id="task_finish_time" class="form-control" / type ="text" value="<?php echo String::html_normalize(URL::get('task_finish_time'));?>">
      <input  name="task_search" class="btn btn-default" value="Xem" / type ="submit" value="<?php echo String::html_normalize(URL::get('task_search'));?>"> 
    </div>
    <div class="list message" id="main_message_list">					
      <table width="100%" border="1" cellspacing="0" cellpadding="5" class="table">
        <?php 
				if(($this->map['items']))
				{?>
        <tr valign="top">
          <th width="1%" align="center">STT</th>
          <th width="60%" align="left">Nội dung tin nhắn</th>
          <th align="center">Gửi lúc</th>
          </tr>
        <?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
        <tr valign="top">
          <td><?php echo $this->map['items']['current']['no'];?>. </td>
          <td class="<?php echo $this->map['items']['current']['class'];?> <?php echo (!$this->map['items']['current']['read'] and Url::get('act')!='gui')?'unread':'read';?>">
            <span class="name"><?php echo $this->map['items']['current']['content'];?></span><?php echo (Url::get('act')=='gui')?' | Gửi đến':' | Gửi từ'?> <a class="creator small" href="<?php echo $_SERVER['REQUEST_URI'];?>#smf" onClick="jQuery('#account_id').focus();updateFullName('<?php echo (Url::get('act')=='gui')?User::encode_password($this->map['items']['current']['to']):User::encode_password($this->map['items']['current']['from']);?>');jQuery('#account_id').css({'color':'#00F'});" title="Trả lời"><?php echo (Url::get('act')=='gui')?$this->map['items']['current']['display_to']:$this->map['items']['current']['display_from'];?> <img src="skins/ssnh/images/fm_game/reply.png" alt="Trả lời"></a></td>
          <td nowrap="nowrap"><span class="<?php echo $this->map['items']['current']['class'];?>"><?php echo $this->map['items']['current']['time'];?> <?php echo $this->map['items']['current']['today_icon'];?></span></td>
          </tr>
        
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
         <?php }else{ ?>
        <tr valign="top">
          <td align="center" colspan="4">
            <div class="note">Không có tin nhắn</div>
          </td>
        </tr>
        
				<?php
				}
				?>
      </table>
      <div class="paging"><?php echo $this->map['paging'];?></div>
    </div>
    <a name="smf"></a>
    <div class="box">
    	<h4><span class="glyphicon glyphicon-send" aria-hidden="true"></span> Gửi tin nhắn</h4>
    	<div class="col-lg-6">
        <input  name="account_id" id="account_id" class="form-control" placeholder="ID người nhận" onChange="checkValidAccount(this)" type ="hidden" value="<?php echo String::html_normalize(URL::get('account_id'));?>">
        <input  name="full_name" type="text" id="full_name" class="form-control" placeholder="Tên người nhận" readonly value="<?php echo $this->map['full_name'];?>">
        <div class="input-group">
        <input  name="user_message" id="user_message" class="form-control" placeholder="Nhập nội dung tin nhắn" type ="text" value="<?php echo String::html_normalize(URL::get('user_message'));?>">
        <span class="input-group-btn">
          <button class="btn btn-success" type="button" onClick="sendMessage(this)">Gửi</button>
        </span>
      	</div><!-- /input-group -->
      </div>
    </div>
    <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
  </div>
</div>
<script>
jQuery(document).ready(function(){
	jQuery();
});
function updateFullName(account_id){
	jQuery('#account_id').val(account_id);
	jQuery.ajax({
		method: "POST",
		url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
		data : {
			'do':'get_full_name',
			'account_id':account_id
		},
		beforeSend: function(){

		},
		success: function(content){
			jQuery('#full_name').val(content);
		},
		error: function(){
			custom_alert("Lỗi...Bạn vui lòng kiểm tra lại kết nối!");	
		}
	});
}
function checkValidAccount(obj){
	jQuery.ajax({
		method: "POST",
		url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
		data : {
			'do':'check_valid_acc',
			'id':obj.value
		},
		beforeSend: function(){

		},
		success: function(content){
			if(content == 'true'){
				jQuery(obj).css({'color':'#00F'});
			}else {
				jQuery(obj).css({'color':'#F00'});
				custom_alert("ID này không tồn tại");	
			}
		},
		error: function(){
			custom_alert("Lỗi...Bạn vui lòng kiểm tra lại kết nối!");	
		}
	});
}
function sendMessage(obj){
	if(!jQuery('#account_id').val()){
		custom_alert('Bạn vui lòng nhập ID');
		return;
	}
	if(!jQuery('#user_message').val()){
		custom_alert('Bạn vui lòng nhập nội dung tin nhắn');
		return;
	}
	jQuery.ajax({
		method: "POST",
		url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
		data : {
			'do':'send_message',
			'id':jQuery('#account_id').val(),
			'message':jQuery('#user_message').val()
		},
		beforeSend: function(){
			jQuery(obj).html('Đang gửi...');
			jQuery(obj).click(function(){
				custom_alert('Hệ thống đang gửi tin nhắn, bạn vui lòng chờ trong giây lát!');
				return false;
			});
		},
		success: function(content){
			jQuery(obj).html('Gửi');
			if(content == 'true'){
				jQuery('#account_id').val('');
				jQuery('#full_name').val('');
				jQuery('#user_message').val('');
				jQuery('#main_message_list').html('Nhấn F5 cập nhật lại tin nhắn...<br4>' + jQuery('#main_message_list').html());
				custom_alert('Gửi thành công!');
			}else {
				custom_alert('Lỗi gửi tin nhắn...Bạn vui lòng kiểm tra lại kết nối!');
			}
		},
		error: function(){
			custom_alert('Lỗi...Bạn vui lòng kiểm tra lại kết nối!');
		}
	});
}
</script>