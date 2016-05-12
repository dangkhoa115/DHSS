<script type="text/javascript" src="packages/core/includes/js/jquery/jquery.validate.js"></script>
<script type="text/javascript">
jQuery(function(){
	<?php 
				if((!Url::get('name')))
				{?>
	jQuery('#name').popover({title: "Nhập tên đội để bắt đầu tạo đội hình", content: "<div>Nhập tên CLB của bạn để bắt đầu</div>", html: true}); 
	window.setTimeout("jQuery('#name').popover('show')",1500);
	
				<?php
				}
				?>
	 
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
	
	<?php 
				if((!Url::get('logo')))
				{?>
	//$rules.logo = {required: true};
	//$messages.logo = {required: 'Vui lòng nhập logo câu lạc bộ'};
	
				<?php
				}
				?>
	jQuery('#CreateTeamForm').validate({
		success: function(label) {
			label.html("").addClass("success");
		},
		rules: $rules,
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
<div id="FmMyTeam">
  <div class="title-all col-xs-12">
    <div class="row">
      <div class="col-xs-12">	
        <div class="title"><h1>ĐỘI HÌNH SIÊU SAO</h1></div>
      </div>      
    </div>
    <div class="row">
      <div class="col-xs-12 clb">
        <div class="row">
          <div class="col-xs-8">
            <div class="title">
              <h2><?php echo Url::get('id')?'Sửa':'Tạo';?> câu lạc bộ</h2>
            </div>
            <div class="row">
              <div class="col-xs-12">
              <div><?php if(Form::$current->is_error()) echo Form::$current->error_messages();?></div>
              <form name="CreateTeamForm" id="CreateTeamForm" method="post" enctype="multipart/form-data">
                <div class="col-xs-<?php echo (Url::get('do')=='edit')?'8':'12'?>">
                  <?php if(FMGAME::my_team_id()==false){?>
                  <input  name="name" id="name" class="form-control" placeholder="Nhập tên đội của bạn" autocomplete="off" type ="text" value="<?php echo String::html_normalize(URL::get('name'));?>">
                  <?php }else{?>
                  <?php 
				if(($this->map['doi_ten']==true))
				{?>
                  <input  name="name" id="name" class="form-control" placeholder="Nhập tên đội của bạn" autocomplete="off" type ="text" value="<?php echo String::html_normalize(URL::get('name'));?>">
                  <div><br><img src="<?php echo $this->map['the_doi_ten_img'];?>" alt="Thẻ đổi tên" width="30"> ÁP DỤNG VỚI CLB CÓ THẺ ĐỔI TÊN</div>
                   <?php }else{ ?>
                  <input  name="name" id="name" class="form-control" placeholder="Nhập tên đội của bạn" autocomplete="off" readonly type ="text" value="<?php echo String::html_normalize(URL::get('name'));?>">
                  <a class="btn btn-default" href="?page=fmg_shop">
                  <img src="<?php echo $this->map['the_doi_ten_img'];?>" alt="Thẻ đổi tên" width="100">
                  <br>
                  Mua thẻ đổi tên</a>
                  
				<?php
				}
				?>
                   <?php }?>
                  <?php 
				if((!$this->map['server']))
				{?>
                  
                   <?php }else{ ?>
                  <br><?php echo $this->map['server'];?>
                  
				<?php
				}
				?>
                </div>
                <?php 
				if((Url::get('do')=='edit'))
				{?>
                <div class="col-xs-4">
                  <input  name="logo" id="logo" class="form-control" onchange="readURL(this,'#preview_image');" value="" accept="image/x-png, image/gif, image/jpeg" type ="file" value="<?php echo String::html_normalize(URL::get('logo'));?>">
                  <span><strong>Logo CLB</strong><br>(Ảnh cỡ nhỏ hơn 400x400 pixel)</span>
                  <br><img id="preview_image" src="<?php echo Url::get('logo')?Url::get('logo'):'skins/ssnh/images/fm_game/logo_clb.png';?>" width="200" alt="Logo">
                </div>
                
				<?php
				}
				?>
                <div class="col-xs-12">
                <hr><div class="alert alert-warning" role="alert">Chọn tên CLB của bạn phải thuần phong mỹ tục đấy nhé...!</div>
                <center><input  name="save" value="Ghi lại và tiếp tục" class="btn btn-lg btn-danger" type ="submit" value="<?php echo String::html_normalize(URL::get('save'));?>">
								<?php if(Url::get('do')!='edit'){?><br><br>
								<div class="alert sub-alert">Sau khi thực hiện bước này bạn sẽ được tặng ngay <span class="highlight">30 iGold</span></div><?php }?>
								<?php if(Url::get('id')){?><input type="button" value="Không thay đổi" class="btn btn-default" onClick="window.location='dhss'"><?php }?></center>
                </div>
              <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
            </div>
          </div>
        </div>  
        <div class="col-xs-4">
            <div class="prize">
            	<img src="skins/fmgame/images/phanthuong.png" alt="Phần thưởng">
            </div>
          </div>  
      </div>
    </div>
  </div>
</div>
