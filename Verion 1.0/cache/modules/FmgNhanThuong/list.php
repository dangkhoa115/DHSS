<script type="text/javascript" src="packages/core/includes/js/jquery/jquery.validate.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#FmgNhanThuongInListForm').validate({
		rules: {
			txtSoSeri:{
				required: true
			},
			txtSoPin: {
				required: true
			},
			select_method:{
				required: true
			}
		},
		messages: {
			txtSoSeri:{
				required: 'Bạn chưa nhập số Seri'
			},
			txtSoPin: {
				required: 'Bạn chưa nhập mã số thẻ'
			},
			select_method: {
				required: 'Bạn chưa chọn nhà mạng'
			}
		}
	});
});
</script>
<div class="row">
	<div class="title bxh">
      <div class="col-md-12">
        <h1>Nhận phần thưởng cho tài khoản <?php echo $this->map['user_id'];?> <?php echo $this->map['vong_dau'];?></h1>
      </div>
    </div>
  <div class="col-md-12">
  	 <form name="FmgNhanThuongInListForm" id="FmgNhanThuongInListForm" method="post">
      	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>	
     		<div class="box-phan-thuong">
          <div class="col-md-8">
          <div class="title"><h3>Người chiến thắng sẽ được nhận 1 trong 4 phần quà dưới đây</h3></div>
          <ul>
            <li><img src="skins/ssnh/images/fm_game/box.png" alt="Hộp quà"></li>
            <li><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Mã thẻ điện thoại  <strong>100k</strong> (25% cơ hội)</li>
            <li><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Mã thẻ điện thoại <strong>50k</strong> (25% cơ hội)</li>
            <li><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Phần quà hấp dẫn <strong>500,000</strong> (25% cơ hội)</li>
            <li><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Phần thưởng <strong>200 igold</strong> (25% cơ hội)</li>
          </ul>
         </div> 
         <div class="col-md-4 text-center"><br>
          <button type="button" class="btn btn-success phan-thuong" onClick="getPhanThuong()">NHẬN PHẦN THƯỞNG</button> 
            <div class="warning">
              <strong>Chú ý</strong>: Các HLV được nhận phần hòa hiện vật thì sẽ vui lòng để lại địa chỉ để BTC gửi phần quà đến cho các bạn.
            </div>
         </div
       ></div>
      <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
  </div>
</div>
<script>
jQuery(document).ready(function(e) {
  
});
function getPhanThuong(){
	jQuery.ajax({
		method: "POST",
		url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
		data : {
			'do':'get_phan_thuong'
		},
		beforeSend: function(){
			jQuery('.cssload-container').show();
		},
		success: function(content){
			alert(content);
			jQuery('.cssload-container').hide();
			switch(content){
				case 'true':
					loadFmMyTeam(cauThuId);
					break;
				default:
					custom_alert(' Lỗi nhận phần thưởng ');
					break;
			}
		},
		error: function(){
			custom_alert('Lỗi kết nối Internet. Bạn vui lòng kiểm tra lại kết nối!');
		}
	});
}
</script>