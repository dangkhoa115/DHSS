<div class="catalogue">
<div class="show">
<form name="ShoppingCartForm" method="post" id="ShoppingCartForm">
<h3>Chi tiết đơn hàng<span></h3>
	<div><?php if(Form::$current->is_error()) echo Form::$current->error_messages();?></div>
	<table width="100%" align="center" cellspacing="0" cellpadding="3">
      <tbody>
        <tr>
          <td valign="top" width="50%" id="cart-box"><div><h2>. Thông tin cá nhân</h2></div>
            <table width="100%" align="center" cellspacing="0" cellpadding="3">
              <tbody>
                <tr>
                  <td>Họ và tên*<br>
                    <input name="full_name" type="text" id="full_name" size="40" value="[[|full_name|]]"></td>
                </tr>
                <tr>
                  <td>Số điện thoại*<br>
                     <input name="phone" type="text" id="phone" size="40" value="[[|phone|]]"></td>
                </tr>
                <tr>
                  <td>Email*<br>
                    <input name="email" type="text" id="email" size="40" value="[[|email|]]"></td>
                </tr>
                <tr>
                  <td>Địa chỉ*<br>
                    <input name="address" type="text" id="address" size="40" value="[[|address|]]"></td>
                </tr>
                <tr>
                  <td>Tỉnh / TP*<br>
                    <select name="zone_id" id="zone_id"></select><script>jQuery('#zone_id').val([[|zone_id|]]);</script></td>
                </tr>
              </tbody>
            </table></td>
          <td valign="top" width="50%"><div><h2>2. Địa chỉ chuyển hàng</h2></div>
             <table width="100%" align="center" cellspacing="0" cellpadding="3">
              <tbody>
                <tr>
                  <td>Họ và tên*<br>
                    <input name="ship_full_name" type="text" id="ship_full_name" size="40" value="[[|ship_full_name|]]"></td>
                </tr>
                <tr>
                  <td>Số điện thoại*<br>
                     <input name="ship_phone" type="text" id="ship_phone" size="40" value="[[|ship_phone|]]"></td>
                </tr>
                <tr>
                  <td>Email*<br>
                    <input name="ship_email" type="text" id="ship_email" size="40" value="[[|ship_email|]]"></td>
                </tr>
                <tr>
                  <td>Địa chỉ*<br>
                    <input name="ship_address" type="text" id="ship_address" size="40" value="[[|ship_address|]]"></td>
                </tr>
                <tr>
                  <td>Tỉnh / TP*<br>
                    <select name="ship_zone_id" id="ship_zone_id"></select><script>jQuery('#ship_zone_id').val([[|ship_zone_id|]]);</script></td>
                </tr>
              </tbody>
            </table></td>
        </tr>
      </tbody>
    </table>
    <br>
    <br>
    <div>
      <h2>Hình thức thanh toán</h2>
      <input type="radio" name="payment" value="dh" checked="checked">
      <strong>Thanh toán sau khi đặt hàng</strong> <br>
    </div>
    <div class="clearfix"></div>
	<div class="clear-both"></div>
</form>
</div> <!--end .show-->
<div class="show">
<div>
 	<h2>Sản phẩm đã đặt hàng</h2>
    <table width="100%" cellpadding="2" cellspacing="0" border="1" bordercolor="#CCCCCC">
      <tr bgcolor="#EFEFEF">
        <th>Ảnh</th>
        <th align="left">Sản phẩm</th>
        <th align="right">Giá</th>
        <th align="center">Số lượng</th>
        <th align="right">Thành tiền</th>
        </tr>
      <?php $total = 0;?>
      <!--LIST:items-->
      <tr>
        <td width="1%" class="img"><a target="_blank" href="chi-tiet/[[|items.category_name_id|]]/[[|items.name_id|]]-id[[|items.id|]].html"><img src="[[|items.thumb_url|]]" width="100" /></a></td>
        <td width="40%" class="name"><a target="_blank" href="chi-tiet/[[|items.category_name_id|]]/[[|items.name_id|]]-id[[|items.id|]].html">[[|items.name|]]</a><br />[[|items.description|]]</td>
        <td align="right" class="price">[[|items.price|]]vnđ</td>
        <td align="center" class="quantity">[[|items.quantity|]]</td>
        <td align="right" class="price">[[|items.amount|]]vnđ</td>
        </tr>
      <?php $total += System::calculate_number([[=items.amount=]]);?>
      <!--/LIST:items-->
      <tr style="display:none;">
        <td colspan="4" align="right" class="total-label">Mã khuyến mãi</td>
        <td class="total" align="right">[[|promotion_code|]]</td>
      </tr>
      <tr style="display:none;">
        <td colspan="4" align="right" class="total-label">Khuyến mãi</td>
        <td class="total" align="right"><strong><?php echo System::display_number([[=promotion_value=]]);?>vnđ</strong></td>
      </tr>
      <tr>
        <td colspan="4" align="right" class="total-label">Tổng cộng:</td>
        <td class="total" align="right"><strong><?php echo System::display_number($total - [[=promotion_value=]]);?>vnđ</strong></td>
        </tr>
    </table>
</div>
</div>
</div><!--end catalogue-->
<p>&nbsp;</p>