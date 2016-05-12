<style>
	.multi-edit-input input{font-size:11px;}
</style>
<script src="packages/core/includes/js/multi_items.js"></script>
<span style="display:none">
	<span id="mi_warranty_status_sample">
		<span id="input_group_#xxxx#" style="float:left;border-bottom:1px solid #999;padding:0px 0px 5px 0px;margin-bottom:10px;background:#FFF;">
            <span class="multi-edit-input">
            	<span class="multi-input" id="index_#xxxx#" style="width:50px;font-size:10px;color:#F30;"></span>
              <input  name="mi_warranty_status[#xxxx#][id]" type="hidden" id="id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1">
              <input  name="mi_warranty_status[#xxxx#][status_id]" type="hidden" id="status_id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1">
              <input  name="mi_warranty_status[#xxxx#][name]" style="width:150px;border:0px;" class="multi-edit-text-input" type="text" id="name_#xxxx#"  tabindex="-1" readonly="readonly">
            </span>
            <span class="multi-edit-input"><input  name="mi_warranty_status[#xxxx#][price]" style="width:70px;" class="multi-edit-text-input" type="text" id="price_#xxxx#"  tabindex="2"></span>
            <span class="multi-edit-input">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  name="mi_warranty_status[#xxxx#][selected]" class="warranty_selected" type="checkbox" id="selected_#xxxx#" value="1"  tabindex="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </span><br clear="all">
	</span>
</span>
<span style="display:none">
	<span id="mi_form_status_sample">
		<span id="input_group_#xxxx#" style="float:left;border-bottom:1px solid #999;padding:0px 0px 5px 0px;margin-bottom:10px;background:#FFF;">
      <span class="multi-edit-input">
        <input  name="mi_form_status[#xxxx#][id]" type="hidden" id="id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1">
        <input  name="mi_form_status[#xxxx#][status_id]" type="hidden" id="status_id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1">
        <input  name="mi_form_status[#xxxx#][name]" style="width:150px;border:0px;" class="multi-edit-text-input" type="text" id="name_#xxxx#"  tabindex="-1" readonly="readonly">
      </span>
      <span class="multi-edit-input"><input  name="mi_form_status[#xxxx#][price]" style="width:70px;" class="multi-edit-text-input" type="text" id="price_#xxxx#"  tabindex="2"></span>
      <span class="multi-edit-input">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  name="mi_form_status[#xxxx#][selected]" class="form_selected" type="checkbox" id="selected_#xxxx#" value="1"  tabindex="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
      <span class="multi-edit-input"><input  name="mi_form_status[#xxxx#][relateds]" style="width:90px;" class="multi-edit-text-input" type="text" id="relateds_#xxxx#"  tabindex="4"></span>
      <!--<span class="multi-edit-input"><a href="#" onclick="showWarrantySelectPanel(this,'#xxxx#');return false;" style="position:relative;">Bảo hành</a></span> -->
  	</span><br clear="all">
	</span>
</span>
<fieldset id="toolbar">
 	<div id="toolbar-title">
		[[.edit_item.]] <span style="font-size:16px;color:#0B55C4;">[ <?php echo Portal::language(Url::get('cmd','list'));?> ]</span>
	</div>
	<div id="toolbar-content" align="right">
	<table>
	  <tbody>
		<tr>
		  <td id="toolbar-save"  align="center"><a onclick="EditItemAdmin.submit();"> <span title="Edit"> </span> Ghi lại </a> </td>
		  <td id="toolbar-cancel"  align="center"><a href="<?php echo Url::build_current(array('cmd'=>'list'));?>#"> <span title="New"> </span> Hủy </a> </td>
		</tr>
	  </tbody>
	</table>
    </div>
</fieldset>
<br clear="all">
<fieldset id="toolbar">
	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>
	<form name="EditItemAdmin" id="EditItemAdmin" method="post" enctype="multipart/form-data">
		<table cellspacing="4" cellpadding="4" border="0" width="100%" style="background-color:#FFFFFF;">
		<tr>
		  <td valign="top">
	    <table cellpadding="4" cellspacing="0" border="0">
					<tr>
					  <td width="16%" align="left">Phân loại (<span class="require">*</span>)</td>
					  <td width="28%" align="left"><select name="category_id" id="category_id" class="select-large"></select></td>
					  <td width="10%" align="left">&nbsp;</td>
            <td>&nbsp;</td>
            <td align="left">Model</td>
            <td align="left"><select name="model_id" id="model_id" class="select-large">
            </select></td>
            </tr>
					<tr>
					  <td align="left">Tình trạng kho</td>
					  <td align="left"><input name="product_status" type="text" id="product_status" /></td>
					  <td align="left">&nbsp;</td>
					  <td align="left">&nbsp;</td>
					  <td align="left">Hệ ĐH</td>
					  <td align="left"><select name="os_id" id="os_id" class="select-large"></select></td>
					  </tr>
					<tr>
					  <td align="left" class="price-label">Giá gốc</td>
					  <td align="left"><input name="public_price" type="text" id="public_price" /></td>
					  <td align="left">&nbsp;</td>
					  <td align="left">&nbsp;</td>
					  <td align="left">Kiểm duyệt</td>
					  <td><input  name="checked" type="checkbox" value="1" id="checked" <?php if(Url::get('checked')==1){echo 'checked="checked"';}?> /></td>
					  </tr>
					<tr>
					  <td align="left" class="price-label">Giảm giá</td>
					  <td align="left"><input name="discount" type="text" id="discount" style="width:30px" />
					    %</td>
					  <td align="left">&nbsp;</td>
					  <td align="left">&nbsp;</td>
					  <td align="left">Vị trí</td>
					  <td align="left"><input name="position" type="text" id="position" /></td>
					  </tr>
					<tr>
					  <td align="left" class="price-label">Giá bán</td>
					  <td align="left"><input name="price" type="text" id="price" /></td>
						<td align="left">&nbsp;</td>
						<td align="left">&nbsp;</td>
						<td align="left">&nbsp;</td>
						<td align="left">&nbsp;</td>
					</tr>
					<tr>
					  <td align="left" class="price-label">Giá trả góp</td>
					  <td align="left"><input name="installment_price" type="text" id="installment_price" /></td>
					  <td align="left">&nbsp;</td>
					  <td align="left">&nbsp;</td>
					  <td align="left">&nbsp;</td>
					  <td align="left">&nbsp;</td>
		    </tr>
				</table>
<br>
				<table  cellpadding="4" cellspacing="0" border="0" width="100%" style="background-color:#F9F9F9;border:1px solid #D5D5D5" align="center">
					<tr>
						<td>
						<div class="tab-pane-1" id="tab-pane-category">
						<div class="tab-page" id="tab-page-category">
							<div class="form_input_label">Tên (<span class="require">*</span>)</div>
							<div class="form_input">
								 <input name="name" type="text" id="name" style="width:60%;border:1px solid #CCCCCC;"  />
							</div>
              <div class="tab-content">
                <div class="form_input_label">Thông số kỹ thuật</div>
                <div class="form_input">
                  <textarea id="specification" name="specification" cols="75" rows="20" style="width:99%; height:350px;overflow:hidden"><?php echo Url::get('specification','');?></textarea><br />
                  <script>advance_mce('specification');</script>
                </div>
              </div>
              <div class="tab-content">
                <div class="form_input_label">Mô tả / giới thiệu</div>
                <div class="form_input">
                  <textarea id="content" name="content" cols="75" rows="20" style="width:99%; height:350px;overflow:hidden"><?php echo Url::get('content','');?></textarea><br />
                  <script>advance_mce('content');</script>
                </div>
              </div>
						</div>
						</div>						
						</td>
				   </tr>
				</table>				
			</td>
			<td valign="top" style="width:420px;">
      	<div id="panel">
        	<div id="panel_1" class="panel"  style="margin-top:0px;"><h2>Nhập mã phụ kiện</h2>
          	<div style="margin-bottom:10px;">
            <input name="accessories" type="text" id="accessories" style="width:300px;" /><br />
            <span class="note">Ví dụ với mã 17 là phụ kiện iPhone 5</span>
            </div>
          </div><br> 
           <div id="panel_4" class="panel"  style="margin-top:0px;"><h2>Tình trạng bảo hành</h2>
          	<div id="mi_warranty_status_all_elems">
              <span style="white-space:nowrap;">
              	<span class="multi-input-header"><span style="width:50px;float:left;text-align:left">Chỉ số</span></span>
                <span class="multi-edit-input-header"><span style="width:155px;float:left;">Thời gian BH</span></span>
                <span class="multi-edit-input-header"><span style="width:80px;float:left;">Tiền cộng</span></span>
                <span class="multi-edit-input-header"><span style="width:30px;float:left;" title="Lựa chọn mặc định khi xem sản phẩm">Mặc định</span></span>
                <span class="multi-edit-input-header"><span style="width:20px;"><img src="skins/default/images/spacer.gif"/></span></span>
                <br clear="all">
              </span>
            </div>
          </div><br>
          <div id="panel_2" class="panel"  style="margin-top:0px;"><h2>Tình trạng máy</h2>
          	<div id="mi_form_status_all_elems">
              <span style="white-space:nowrap;">
                <span class="multi-edit-input-header"><span style="width:155px;float:left;">Tên</span></span>
                <span class="multi-edit-input-header"><span style="width:75px;float:left;">Giá</span></span>
                <span class="multi-edit-input-header"><span style="width:85px;float:left;" title="Lựa chọn mặc định khi xem sản phẩm">Mặc định</span></span>
                <span class="multi-edit-input-header"><span style="width:30px;float:left;">BH</span></span>
                <span class="multi-edit-input-header"><span style="width:20px;"><img src="skins/default/images/spacer.gif"/></span></span>
                <br clear="all">
              </span>
            </div>
          </div><br>
          <div id="panel_6" class="panel"  style="margin-top:0px;"><h2>Tags</h2>
         		<div>
            	<textarea name="tags" id="tags" style="width:90%;" rows="5"></textarea>
              <span class="note">Ví dụ: apple, iphone, galaxy, ...</span>
            </div>
			    </div><br>
         	<div id="panel_7" class="panel"  style="margin-top:8px;overflow:hidden;"><h2>Ảnh đại diện</h2>
          <table cellpadding="4" cellspacing="0" width="100%" border="1" bordercolor="#E9E9E9">	
              <tr valign="top">
                <td width="30%" align="right">[[.image_url.]]</td>
                  <td width="70%" align="left"><input  name="image_url" type="file" id="image_url" class="file" size="18">
                  <!--IF:cond(Url::get('image_url') and file_exists(Url::get('image_url')))-->
                  <img src="<?php echo Url::get('image_url');?>" width="210" />
                  <div id="delete_image_url">[<a href="<?php echo Url::build_current(array('cmd'=>'unlink','link'=>Url::get('image_url'),'id'));?>" onclick="jQuery('#delete_image_url').html('');" style="color:#FF0000">Xóa</a>]</div></td>
                  <!--/IF:cond-->
              </tr>					
            </table>
          </div><br>
          <div id="panel_8" class="panel"  style="margin-top:8px;overflow:hidden;"><h2>Thư viện ảnh</h2>
          	<ul class="item-image-bound">
            	<li><img src="<?php echo Url::get('item_image_url1');?>" width="50" onclick="window.open(this.src)" />Ảnh số 01
              <!--IF:cond(Url::get('item_image_url1'))-->[<a href="<?php echo Url::build_current(array('cmd'=>'unlink_item_image','link'=>Url::get('item_image_url1'),'id'));?>" onclick="jQuery('#delete_image_url').html('');" style="color:#FF0000">Xóa</a>]<!--ELSE--><input type="file" name="item_image_url1" id="item_image_url1" /><!--/IF:cond--></li>
              <li><img src="<?php echo Url::get('item_image_url2');?>" width="50" onclick="window.open(this.src)" />Ảnh số 02 
              <!--IF:cond(Url::get('item_image_url2'))-->[<a href="<?php echo Url::build_current(array('cmd'=>'unlink_item_image','link'=>Url::get('item_image_url2'),'id'));?>" onclick="jQuery('#delete_image_url').html('');" style="color:#FF0000">Xóa</a>]<!--ELSE--><input type="file" name="item_image_url2" id="item_image_url2" /><!--/IF:cond--></li>
              <li><img src="<?php echo Url::get('item_image_url3');?>" width="50" onclick="window.open(this.src)" />Ảnh số 03 
              <!--IF:cond(Url::get('item_image_url3'))-->[<a href="<?php echo Url::build_current(array('cmd'=>'unlink_item_image','link'=>Url::get('item_image_url3'),'id'));?>" onclick="jQuery('#delete_image_url').html('');" style="color:#FF0000">Xóa</a>]<!--ELSE--><input type="file" name="item_image_url3" id="item_image_url3" /><!--/IF:cond--></li>
              <li><img src="<?php echo Url::get('item_image_url4');?>" width="50" onclick="window.open(this.src)" />Ảnh số 04 
              <!--IF:cond(Url::get('item_image_url4'))-->[<a href="<?php echo Url::build_current(array('cmd'=>'unlink_item_image','link'=>Url::get('item_image_url4'),'id'));?>" onclick="jQuery('#delete_image_url').html('');" style="color:#FF0000">Xóa</a>]<!--ELSE--><input type="file" name="item_image_url4" id="item_image_url4" /><!--/IF:cond--></li>
              <li><img src="<?php echo Url::get('item_image_url5');?>" width="50" onclick="window.open(this.src)" />Ảnh số 05
              <!--IF:cond(Url::get('item_image_url5'))-->[<a href="<?php echo Url::build_current(array('cmd'=>'unlink_item_image','link'=>Url::get('item_image_url5'),'id'));?>" onclick="jQuery('#delete_image_url').html('');" style="color:#FF0000">Xóa</a>]<!--ELSE--><input type="file" name="item_image_url5" id="item_image_url5" /><!--/IF:cond--></li>
              <li><img src="<?php echo Url::get('item_image_url6');?>" width="50" onclick="window.open(this.src)" />Ảnh số 06 
              <!--IF:cond(Url::get('item_image_url6'))-->[<a href="<?php echo Url::build_current(array('cmd'=>'unlink_item_image','link'=>Url::get('item_image_url6'),'id'));?>" onclick="jQuery('#delete_image_url').html('');" style="color:#FF0000">Xóa</a>]<!--ELSE--><input type="file" name="item_image_url6" id="item_image_url6" /><!--/IF:cond--></li>
              <li><img src="<?php echo Url::get('item_image_url7');?>" width="50" onclick="window.open(this.src)" />Ảnh số 07 
              <!--IF:cond(Url::get('item_image_url7'))-->[<a href="<?php echo Url::build_current(array('cmd'=>'unlink_item_image','link'=>Url::get('item_image_url7'),'id'));?>" onclick="jQuery('#delete_image_url').html('');" style="color:#FF0000">Xóa</a>]<!--ELSE--><input type="file" name="item_image_url7" id="item_image_url7" /><!--/IF:cond--></li>
              <li><img src="<?php echo Url::get('item_image_url8');?>" width="50" onclick="window.open(this.src)" />Ảnh số 08
              <!--IF:cond(Url::get('item_image_url8'))-->[<a href="<?php echo Url::build_current(array('cmd'=>'unlink_item_image','link'=>Url::get('item_image_url8'),'id'));?>" onclick="jQuery('#delete_image_url').html('');" style="color:#FF0000">Xóa</a>]<!--ELSE--><input type="file" name="item_image_url8" id="item_image_url8" /><!--/IF:cond--></li>
              <li><img src="<?php echo Url::get('item_image_url8');?>" width="50" onclick="window.open(this.src)" />Ảnh số 09 
              <!--IF:cond(Url::get('item_image_url9'))-->[<a href="<?php echo Url::build_current(array('cmd'=>'unlink_item_image','link'=>Url::get('item_image_url9'),'id'));?>" onclick="jQuery('#delete_image_url').html('');" style="color:#FF0000">Xóa</a>]<!--ELSE--><input type="file" name="item_image_url9" id="item_image_url9" /><!--/IF:cond--></li>
            </ul>
          </div>
				</div>
			</td>
		</tr>
		</table>
    <div id="warrantyPanel" style="display:none;">
    <h1>Chọn thời hạn bảo hành<a href="#" onclick="jQuery('#warrantyPanel').hide();return false;" title="Đóng">X</a></h1>
    <ul>
    <li class="header"><span class="first">Thời gian BH</span><span class="second">Chọn</span></li>
    <?php foreach($_REQUEST['mi_warranty_status'] as $key=>$value){?>	
     <li><span class="first"><?php echo $value['name']?></span><span class="second"><input name="" type="checkbox" id="" value="1" /></span></li>
    <?php }?>
    </ul>
    </div>
	</form>
</fieldset>
<script>
mi_init_rows('mi_form_status',<?php if(isset($_REQUEST['mi_form_status'])){echo String::array2js($_REQUEST['mi_form_status']);}else{echo '[]';}?>);
mi_init_rows('mi_warranty_status',<?php if(isset($_REQUEST['mi_warranty_status'])){echo String::array2js($_REQUEST['mi_warranty_status']);}else{echo '[]';}?>);
jQuery(document).ready(function(){
	for(var i=101;i<=input_count;i++){
		if(getId('price_'+i)){
			getId('price_'+i).value = numberFormat(getId('price_'+i).value);
		}
		if(getId('index_'+i)){
			getId('index_'+i).innerHTML = i;
		}
		jQuery('.form_selected').click(function(){
			checked = jQuery(this).attr('checked');
			jQuery('.form_selected').attr('checked',false);
			jQuery(this).attr('checked',checked);
		});
		jQuery('.warranty_selected').click(function(){
			checked = jQuery(this).attr('checked');
			jQuery('.warranty_selected').attr('checked',false);
			jQuery(this).attr('checked',checked);
		});
		if(getId('relateds_'+i) && getId('relateds_'+i).value){
			var tmpStr = getId('relateds_'+i).value;
			var tmpArr = tmpStr.split(',');
			var name = '';
			var c = 0;
			for(var n in tmpArr){
				for(var j=101;j<=input_count;j++){
					if(jQuery('input[name="mi_warranty_status['+j+'][status_id]"]') && jQuery('input[name="mi_warranty_status['+j+'][status_id]"]').val() == tmpArr[n]){
						name = name + ((c>0)?',':'') + j;
						c++;
					}
				}
			}
			getId('relateds_'+i).value = name;
		}
		jQuery('#relateds'+i).change(function(){
			var tmpStr = jQuery(this).val();
			var tmpArr = tmpStr.split(',');
			var name = 'Bạn đã chọn bảo hành: ';
			var c = 0;
			for(var n in tmpArr){
				name += ((c>0)?', ':'') + jQuery('#name_'+tmpArr[n]).val();
				c++;
			}
			alert(name);
		});
	}
	
	jQuery('#discount').change(function(){
		updatePrice();	
	});
	jQuery('#public_price').change(function(){
		jQuery('#public_price').val(numberFormat(jQuery('#public_price').val()));
		updatePrice();	
	});
	jQuery('#price').change(function(){
		jQuery('#price').val(numberFormat(jQuery('#price').val()));
	});
	updateDiscountPercent();
});
function updatePrice(){
	var publicPrice = to_numeric(jQuery('#public_price').val());
	var discountPercent = to_numeric(jQuery('#discount').val());	
	var price = publicPrice - roundNumber(publicPrice*(discountPercent/100),2);
	price = numberFormat(price);
	jQuery('#price').val(price);
}
function updateDiscountPercent(){
	var publicPrice = to_numeric(jQuery('#public_price').val());
	if(publicPrice){
		var price = to_numeric(jQuery('#price').val());	
		var discount = ((publicPrice - price)/publicPrice)*100;
		jQuery('#discount').val(discount);
	}
}
function showWarrantySelectPanel(obj,index){
	var p = jQuery(obj).offset();
	jQuery('#warrantyPanel').css({left:p.left - 200,top:p.top+15});
	jQuery('#warrantyPanel').fadeIn();
}
</script>