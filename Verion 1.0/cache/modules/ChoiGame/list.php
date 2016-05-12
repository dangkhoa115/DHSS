<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery.validator.addMethod("full_name", function(value) {
			return value != 'Họ và tên';
	});
	jQuery.validator.addMethod("email", function(value) {
			return value != 'Email của bạn';
	});
	jQuery.validator.addMethod("content", function(value) {
			return value != 'Nội dung...';
	});
	jQuery.validator.addMethod("verify_comfirm_code", function(value) {
			return value != 'Mã xác nhận';
	});
	jQuery('#NewsCommentForm').validate({
		success: function(label) {
			label.text("").addClass("success");
		},
		rules: {
			full_name:{
				required: true,
				full_name:'full_name'
			},
			email: {
				required: true,
				email: true
			},
			content: {
				required: true,
				content: "content"
			},
			verify_comfirm_code: {
				required: true,
				verify_comfirm_code:"verify_comfirm_code",
				minlength: 4,
				remote : 'form.php?block_id=<?php echo Module::block_id(); ?>&cmd=check_ajax'
			}
		},
		messages: {
			full_name:{
				required: 'Bạn chưa nhập họ và tên',
				full_name:'Bạn chưa nhập họ và tên'
			},
			email: {
				required: 'Bạn chưa nhập email',
				email: 'Bạn phải nhập email đúng định dạng'
			},
			content: {
				required: 'Bạn chưa nhập nội dung',
				content: 'Bạn chưa nhập nội dung'
			},
			verify_comfirm_code: {
				required: 'Bạn chưa nhập mã xác nhận',
				verify_comfirm_code: 'Bạn chưa nhập mã xác nhận',
				minlength: 'Bạn phải nhập ít nhất 4 ký tự',
				remote:'Mã xác nhận không hợp lệ'
			}
		}
	});
});
</script>	
  <div class="nav">
      <ul class="left">
          <li><a href="">Trang chủ</a></li>
          <li><span> » </span></li>
          <li><a href="gaming">Gaming</a></li>
          <?php 
				if((Url::get('name_id')))
				{?>
          <li><span> » </span></li>
          <li><a href="gaming/<?php echo $this->map['category_name_id'];?>" class="actived"><?php echo $this->map['category_name'];?></a></li>
          
				<?php
				}
				?>
      </ul>
      <ul class="right">
          <li>Cập nhật: <?php echo date('d/m/Y H:i:s A',$this->map['time']);?>. </li>
          <?php if(User::can_edit(MODULE_NEWSADMIN,false)){?><li>Lượt xem: <?php echo $this->map['hitcount'];?></li><?php }?>
      </ul>
  </div>
  <div class="content-r">
      <div class="news_detail">
          <h1><?php echo $this->map['name'];?> <?php if(User::can_edit(MODULE_NEWSADMIN,false)){?><a target="_blank" href="?page=game_admin&cmd=edit&id=<?php echo $this->map['id'];?>">[Sửa]</a><?php }?></h1>
					<?php echo $this->map['description'];?>
          <br clear="all"><br>
      </div><!--End .game_detail-->
      <div class="addthis-bound">
      	<div
          class="fb-like"
          data-share="true"
          data-width="450"
          data-show-faces="true">
        </div>
      </div> <!-- End .addthis-bound -->	
       <div class="send_comment">
       <div id="fb-root"></div>
			<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&appId=1612685782280827&version=v2.3";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
				<div class="fb-comments" data-href="http://<?php echo $_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI'];?>" data-version="v2.3" data-numposts="5" data-colorscheme="light" data-width="100%"></div>
       </div><!--End .send_comment-->
      <?php 
				if(($this->map['tags']))
				{?>
        <div class="tags"><p>Tags: <?php echo $this->map['tags'];?></p></div><br />
        
				<?php
				}
				?>
      <div class="int-related">
          <?php 
				if(($this->map['item_newer']))
				{?>
           <h2>TIN MỚI HƠN</h2>
           <ul class="tin_khac">
            <?php
					if(isset($this->map['item_newer']) and is_array($this->map['item_newer']))
					{
						foreach($this->map['item_newer'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['item_newer']['current'] = &$item1;?>
            <li><a href="tin-tuc/<?php echo $this->map['item_newer']['current']['category_name_id'];?>/<?php echo $this->map['item_newer']['current']['name_id'];?>.html"><?php echo str_replace(array('&nbsp;','+','-'),'',$this->map['item_newer']['current']['name']);?></a> <span>(<?php echo date('d/m/y',$this->map['item_newer']['current']['time'])?>)</span></li>
            
							
						<?php
							}
						}
					unset($this->map['item_newer']['current']);
					} ?>
           </ul>
           <div class="clear-both"></div>
           
				<?php
				}
				?>
           <?php 
				if(($this->map['item_related']))
				{?>
           <h2>TIN CŨ HƠN </h2>
           <ul class="tin_khac">
            <?php
					if(isset($this->map['item_related']) and is_array($this->map['item_related']))
					{
						foreach($this->map['item_related'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['item_related']['current'] = &$item2;?>
            <li><a href="tin-tuc/<?php echo $this->map['item_related']['current']['category_name_id'];?>/<?php echo $this->map['item_related']['current']['name_id'];?>.html"><?php echo str_replace(array('&nbsp;','+','-'),'',$this->map['item_related']['current']['name']);?></a> <span>(<?php echo date('d/m/y',$this->map['item_related']['current']['time'])?>)</span></li>
            
							
						<?php
							}
						}
					unset($this->map['item_related']['current']);
					} ?>
           </ul>
           <div class="clear-both"></div>
           
				<?php
				}
				?>
      </div><!--End .int-related-->
  </div><!--End .content-r-->
<script>
	/*function checkInput(){
		if(!getId('full_name').value || getId('full_name').value == 'Họ và tên'){
			alert('Bạn chưa nhập họ và tên');
			getId('full_name').focus();
			return false;
		}
	}*/
</script>