<script type="text/javascript" src="packages/core/includes/js/jquery/jquery.validate.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#NapiGoldInListForm').validate({
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
        <h1>Nạp iGold cho tài khoản: <?php echo $this->map['user_id'];?></h1>
      </div>
    </div>
  <div class="col-md-12">
  	 <form name="NapiGoldInListForm" id="NapiGoldInListForm" method="post">
      	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>	
     <div class="box-khuyen-mai">
        <div class="title"><h3>Thông tin khuyến mại</h3></div>
        <ul>
          <li><img src="skins/ssnh/images/KM.png" alt="Khuyến mại hấp dẫn"></li>
          <li><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Bạn nạp mệnh giá <strong>50,000 đến 100,000</strong> sẽ được tặng thêm <strong>10 iGold</strong><span class="old-igold">/5 iGold</span></li>
          <li><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Bạn nạp mệnh giá <strong>200,000 đến 300,000</strong> sẽ được tặng thêm <strong>30 iGold</strong><span class="old-igold">/25 iGold</span></li>
          <li><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Bạn nạp mệnh giá <strong>500,000</strong> sẽ được <strong>tặng</strong> thêm <strong>110 iGold</strong><span class="old-igold">/55 iGold</span></li>
          <li><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Bạn nạp mệnh giá <strong>1,000,000</strong> sẽ được tặng thêm <strong>250 iGold</strong><span class="old-igold">/150 iGold</span></li>
          <li><img src="skins/ssnh/images/tamgiac.png" alt="Nạp ngay"></li>
        </ul>
      </div>
      <a name="napthe"></a>
        <div class="card-box">
          <div class="title">
            <h3>Chọn loại thẻ để nạp</h3>
          </div>
          <table align="center" width="100%">
            <tr>
                <td colspan="3">
                    <table width="100%">
                        <tr>
                        <td>
                        	<ul class="card-list">
                            <li><label for="92"><img  src="nl/includes/images/mobifone.jpg" alt="Mobifone" /></label> 
                            <input type="radio" name="select_method" value="VMS" id="92"  /></li>
                            <li><label for="93"><img  src="nl/includes/images/vinaphone.jpg" alt="vinaphone" /></label>
                            <input type="radio"  name="select_method" value="VNP" id="93" /></li>
                            <li><label for="107"><img  src="nl/includes/images/viettel.jpg" alt="viettel" width="110" height="35" /></label>
                            <input type="radio"  name="select_method" value="VIETTEL" id="107" /></li>
                            <li><label for="121"><img width="100" height="35" alt="vtc" src="nl/includes/images/vtc.jpg"></label> 
                            <input type="radio" id="121" value="VCOIN" name="select_method"></li>
                            <li> <label for="120"><img width="100" height="35" alt="gate" src="nl/includes/images/gate.jpg"></label>
                            <input type="radio" id="120" value="GATE" name="select_method"></li>
                         	</ul>
                        </td>
                        </tr>
                      </table>
                  </td>
              </tr>
              
              <tr>
                  <td align="right" style="padding-bottom:10px">Số Seri :</td>
                  <td colspan="2"><input  name="txtSoSeri" id="txtSoSeri" class="form-control" / type ="text" value="<?php echo String::html_normalize(URL::get('txtSoSeri'));?>"></td>
              </tr>
               <tr>
                  <td align="right">Mã số thẻ : </td>
                  <td colspan="2">
                    <input  name="txtSoPin" id="txtSoPin" class="form-control" / type ="text" value="<?php echo String::html_normalize(URL::get('txtSoPin'));?>">
                      
                  </td>
              </tr>
             
            <tr>
                <td colspan="3" align="center" style="padding-bottom:10px;padding-right:10px">
                  <input type="submit" id="ttNganluong" name="NLNapThe" value="Nạp Thẻ" class="btn btn-default"  /> 
                  <hr>
                  <div class="warning">
                  	<strong>Chú ý</strong>: Nếu bạn nhập sai thông tin quá 5 lần thì tài khoàn của bạn sẽ bị khóa vì lý do chống gian lận. Khi đó bạn vui lòng liên hệ với BTC để được hỗ trợ.
                  </div>
               </td>
              </tr>	
          </table>
        </div> 
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
  </div>
</div>