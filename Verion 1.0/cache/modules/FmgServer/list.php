<script type="text/javascript" src="packages/core/includes/js/jquery/jquery.validate.js"></script>
<script type="text/javascript">
jQuery(function(){
	$rules = {
		name: {
			required: true,
			minlength: 3,
			maxlength: 225
		}
	};
	$messages = {	
			name: {
			required: '<br>Yêu cầu nhập',
			minlength: '<br>Phải nhập tối thiểu 3 ký tự',
			maxlength: 'Bạn chỉ được nhập tiêu đề tối đa 225 ký tự'
		}
	};
	$rules.logo = {required: true};
	$messages.logo = {required: 'Vui lòng nhập logo câu lạc bộ'};
	jQuery('#SsnhDangTinForm').validate({
		success: function(label) {
			label.html("").addClass("success");
		},
		rules: $rules,//	remote : 'form.php?block_id=<?php //echo Module::block_id(); ?>&cmd=check_ajax'
		messages: $messages
	});
});
function readURL(input,target) {
		if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
						jQuery(target).attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
		}
}
</script>
<link href="../../../../../skins/ssnh/styles/bootstrap.min.css" rel="stylesheet" type="text/css">

<div id="FmgServer">
  <div class="title-all col-md-12">
    <div class="row">
      <div class="col-md-8">	
        <div class="title"><h1>ĐỘI HÌNH SIÊU SAO</h1></div>
      </div>
      <div class="col-md-4">
        <div class="transfer-status dong-cua">Thị trường chuyển nhượng đã đóng cửa</div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 clb">
        <div class="row">
          <div class="col-md-8">
            <div class="title">
              <h2><?php echo Url::get('id')?'Sửa':'Tạo';?> server</h2>
            </div>
            <div class="row">
              <div class="col-md-12">
              <div><?php if(Form::$current->is_error()) echo Form::$current->error_messages();?></div>
              <form name="CreateTeamForm" id="SsnhDetailClbForm" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                	<div class="input-group">
                    <span class="input-group-addon">Tên server</span>
                    <input  name="name" id="name" class="form-control" type ="text" value="<?php echo String::html_normalize(URL::get('name'));?>">
                  </div>
                </div>
                <div class="col-md-6">
                	<div class="input-group">
                    <span class="input-group-addon">Ngày mở</span>
                    <input  name="open_date" id="open_date" class="form-control" type ="text" value="<?php echo String::html_normalize(URL::get('open_date'));?>">
                  </div>
                </div>
                <div class="col-md-6">
                	<div class="input-group">
                    <span class="input-group-addon">Ngày kết thúc</span>
                    <input  name="close_date" id="close_date" class="form-control" type ="text" value="<?php echo String::html_normalize(URL::get('close_date'));?>">
                  </div>
                </div>
                <div class="col-md-12">
                <hr><div class="alert alert-warning" role="alert">Tạo câu lạc bộ hoàn toàn miễn phí!</div>
                <center><input  name="save" value="Ghi lại và tiếp tục" class="btn btn-primary" type ="submit" value="<?php echo String::html_normalize(URL::get('save'));?>"> <?php if(Url::get('id')){?><input type="button" value="Không thay đổi" class="btn btn-default" onClick="window.location='<?php echo Url::build_current();?>'"><?php }?></center>
                </div>
              <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <h2>Server List</h2>
            <div>
            	<table width="100%" border="1" bordercolor="#999" cellspacing="0" cellpadding="5">
                <tbody>
                  <tr>
                    <th width="1%">STT</th>
                    <th>Server</th>
                    <th>Open</th>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>    
      </div>
    </div>
  </div>
</div>
