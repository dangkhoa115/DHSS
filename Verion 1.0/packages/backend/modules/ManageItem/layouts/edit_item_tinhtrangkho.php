<style>
	.multi-edit-input input{font-size:11px;}
</style>
<script src="packages/core/includes/js/multi_items.js"></script>
<span style="display:none">
	<span id="mi_store_status_sample">
		<span id="input_group_#xxxx#" style="float:left;border-bottom:1px solid #999;padding:0px 0px 5px 0px;margin-bottom:10px;background:#FFF;">
            <span class="multi-edit-input">
              <input  name="mi_store_status[#xxxx#][id]" type="hidden" id="id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1">
              <input  name="mi_store_status[#xxxx#][status_id]" type="hidden" id="status_id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1">
              <input  name="mi_store_status[#xxxx#][name]" style="width:180px;border:0px;" class="multi-edit-text-input" type="text" id="name_#xxxx#"  tabindex="-1" readonly="readonly">
            </span>
            <span class="multi-edit-input"><input  name="mi_store_status[#xxxx#][price]" style="width:100px;" class="multi-edit-text-input" type="text" id="price_#xxxx#"  tabindex="2"></span>
        </span><br clear="all">
	</span>
</span>
<span style="display:none">
	<span id="mi_form_status_sample">
		<span id="input_group_#xxxx#" style="float:left;border-bottom:1px solid #999;padding:0px 0px 5px 0px;margin-bottom:10px;background:#FFF;">
            <span class="multi-edit-input">
              <input  name="mi_form_status[#xxxx#][id]" type="hidden" id="id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1">
              <input  name="mi_form_status[#xxxx#][status_id]" type="hidden" id="status_id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1">
              <input  name="mi_form_status[#xxxx#][name]" style="width:180px;border:0px;" class="multi-edit-text-input" type="text" id="name_#xxxx#"  tabindex="-1" readonly="readonly">
            </span>
            <span class="multi-edit-input"><input  name="mi_form_status[#xxxx#][price]" style="width:100px;" class="multi-edit-text-input" type="text" id="price_#xxxx#"  tabindex="2"></span>
        </span><br clear="all">
	</span>
</span>
<span style="display:none">
	<span id="mi_selling_promotion_sample">
		<span id="input_group_#xxxx#" style="float:left;border-bottom:1px solid #999;padding:0px 0px 5px 0px;margin-bottom:10px;background:#FFF;">
            <span class="multi-edit-input">
              <input  name="mi_selling_promotion[#xxxx#][id]" type="hidden" id="id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1">
              <input  name="mi_selling_promotion[#xxxx#][s_p_id]" type="hidden" id="s_p_id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1">
              <input  name="mi_selling_promotion[#xxxx#][name]" style="width:180px;border:0px;" class="multi-edit-text-input" type="text" id="name_#xxxx#"  tabindex="-1" readonly="readonly">
            </span>
            <span class="multi-edit-input"><input  name="mi_selling_promotion[#xxxx#][price]" style="width:100px;" class="multi-edit-text-input" type="text" id="price_#xxxx#"  tabindex="2"></span>
        </span><br clear="all">
	</span>
</span>
<span style="display:none">
	<span id="mi_warranty_status_sample">
		<span id="input_group_#xxxx#" style="float:left;border-bottom:1px solid #999;padding:0px 0px 5px 0px;margin-bottom:10px;background:#FFF;">
            <span class="multi-edit-input">
              <input  name="mi_warranty_status[#xxxx#][id]" type="hidden" id="id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1">
              <input  name="mi_warranty_status[#xxxx#][status_id]" type="hidden" id="status_id_#xxxx#" class="multi-edit-text-input" style="width:40px;text-align:right;" value="(auto)" tabindex="-1">
              <input  name="mi_warranty_status[#xxxx#][name]" style="width:180px;border:0px;" class="multi-edit-text-input" type="text" id="name_#xxxx#"  tabindex="-1" readonly="readonly">
            </span>
            <span class="multi-edit-input"><input  name="mi_warranty_status[#xxxx#][price]" style="width:100px;" class="multi-edit-text-input" type="text" id="price_#xxxx#"  tabindex="2"></span>
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
					  <td align="left">Tình trạng</td>
					  <td align="left"><input name="product_status" type="text" id="product_status" /></td>
					  <td align="left">&nbsp;</td>
					  <td align="left">&nbsp;</td>
					  <td align="left">Hệ ĐH</td>
					  <td align="left"><select name="os_id" id="os_id" class="select-large"></select></td>
					  </tr>
					<tr>
					  <td align="left">Mầu sắc</td>
					  <td align="left"><input name="color" type="text" id="color" /></td>
					  <td align="left">&nbsp;</td>
					  <td align="left">&nbsp;</td>
					  <td align="left">Bảo hành</td>
					  <td><input name="warranty" type="text" id="warranty" /></td>
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
              <div class="tab-content">
                <div class="form_input_label">Phụ kiện</div>
                <div class="form_input">
                  <textarea id="accessories" name="accessories" cols="75" rows="20" style="width:99%; height:350px;overflow:hidden"><?php echo Url::get('accessories','');?></textarea><br />
                  <script>advance_mce('accessories');</script>
                </div>
              </div>
						</div>
						</div>						
						</td>
				   </tr>
				</table>				
			</td>
			<td valign="top" style="width:320px;">
      	<div id="panel">
        	<div id="panel_1" class="panel"  style="margin-top:0px;"><h2>Tình trạng kho</h2>
          	<div id="mi_store_status_all_elems">
              <span style="white-space:nowrap;">
                <span class="multi-edit-input-header"><span style="width:180px;float:left;">Tên</a></span></span>
                <span class="multi-edit-input-header"><span style="width:100px;float:left;">Giá</a></span></span>
                <span class="multi-edit-input-header"><span style="width:20px;"><img src="skins/default/images/spacer.gif"/></span></span>
                <br clear="all">
              </span>
            </div>
          </div><br>
          <div id="panel_2" class="panel"  style="margin-top:0px;"><h2>Tình trạng máy</h2>
          	<div id="mi_form_status_all_elems">
              <span style="white-space:nowrap;">
                <span class="multi-edit-input-header"><span style="width:180px;float:left;">Tên</a></span></span>
                <span class="multi-edit-input-header"><span style="width:100px;float:left;">Giá</a></span></span>
                <span class="multi-edit-input-header"><span style="width:20px;"><img src="skins/default/images/spacer.gif"/></span></span>
                <br clear="all">
              </span>
            </div>
          </div><br>
          <div id="panel_3" class="panel"  style="margin-top:0px;"><h2>Khuyến mại</h2>
          	<div id="mi_selling_promotion_all_elems">
              <span style="white-space:nowrap;">
                <span class="multi-edit-input-header"><span style="width:180px;float:left;">Khuyến mại</a></span></span>
                <span class="multi-edit-input-header"><span style="width:100px;float:left;">Tiền cộng thêm</a></span></span>
                <span class="multi-edit-input-header"><span style="width:20px;"><img src="skins/default/images/spacer.gif"/></span></span>
                <br clear="all">
              </span>
            </div>
          </div><br>
          <div id="panel_4" class="panel"  style="margin-top:0px;"><h2>Tình trạng bảo hành</h2>
          	<div id="mi_warranty_status_all_elems">
              <span style="white-space:nowrap;">
                <span class="multi-edit-input-header"><span style="width:180px;float:left;">Thời gian BH</a></span></span>
                <span class="multi-edit-input-header"><span style="width:100px;float:left;">Tiền cộng thêm</a></span></span>
                <span class="multi-edit-input-header"><span style="width:20px;"><img src="skins/default/images/spacer.gif"/></span></span>
                <br clear="all">
              </span>
            </div>
          </div><br>
          <div id="panel_5" class="panel"  style="margin-top:0px;"><h2>Tình trạng bảo hành</h2>
          	<div id="mi_warranty_status_all_elems">
              <span style="white-space:nowrap;">
                <span class="multi-edit-input-header"><span style="width:180px;float:left;">Thời gian BH</a></span></span>
                <span class="multi-edit-input-header"><span style="width:100px;float:left;">Tiền cộng thêm</a></span></span>
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
			    </div>
          <div id="panel_7" class="panel"  style="margin-top:8px;overflow:hidden;"><h2>Thư viện ảnh</h2>
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
	</form>
</fieldset>
<script>
<!--IF:cond(Url::get('category_id'))-->
jQuery('#category_id').val(<?php echo $_REQUEST['category_id'];?>);
<!--/IF:cond-->
jQuery(document).ready(function(){
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
mi_init_rows('mi_store_status',<?php if(isset($_REQUEST['mi_store_status'])){echo String::array2js($_REQUEST['mi_store_status']);}else{echo '[]';}?>);
mi_init_rows('mi_form_status',<?php if(isset($_REQUEST['mi_form_status'])){echo String::array2js($_REQUEST['mi_form_status']);}else{echo '[]';}?>);
mi_init_rows('mi_selling_promotion',<?php if(isset($_REQUEST['mi_selling_promotion'])){echo String::array2js($_REQUEST['mi_selling_promotion']);}else{echo '[]';}?>);
mi_init_rows('mi_warranty_status',<?php if(isset($_REQUEST['mi_warranty_status'])){echo String::array2js($_REQUEST['mi_warranty_status']);}else{echo '[]';}?>);
</script>
