<script type="text/javascript" src="skins/ssnh/scripts/winwheel_new/lucky_wheel_lib.js"></script>
<link rel="stylesheet" href="skins/ssnh/scripts/winwheel_new/style.css" type="text/css" />
<div class="content-r lucky-wheel">
  <div class="title"><h1>VÒNG QUAY MAY MẮN - LUCKY WHEEL</h1></div>
  <div id="main">
    <div class="col-md-7 left">
    	<center>
      	<span class="arrow"></span>
        <div>
        <form class="iform" action="#" method="get">
            <input type="hidden" id="current_winner" value="0">
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
        </div>      
        <canvas class="canvas" width="500" height="540"></canvas>
        <br><br>
      <div id="igold_fly" style="float:left;display:none;font-size:25px;font-weight:bold;background:#FAFFCC;padding:10px;border-radius:10px;border:1px solid #FF6E00" class="igold">iGold</div>  
      <div id="x2_item" style="display:none;"><img src="skins/ssnh/images/x2.png" /></div>
      </center>
    </div>
    <div class="col-md-5 right">
    		<a href="#" class="igold-help" onClick="return false;">2 iGold / lượt</a>
        <p class="winner"><span>&nbsp;</span></p>
        <ul class="participants"></ul>
        <div class="hide" id="totaliGold"></div>
    </div>
    <input type="button" class="spin-trigger button big round" value="Quay" />
  </div>
</div>
<script src="skins/ssnh/scripts/jBeep/jBeep.min.js" type="text/javascript"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
<script>
var totalSpin = 1;
var blockId = <?php echo Module::block_id(); ?>;
var total = 25;
var bc_arr1 = []; 
var bc_arr = [];
for(i=0;i<total;i++){
	bc_arr[i] = 'X';
	bc_arr1[i] = 0;
	if(i%2==0 && i>0){
		bc_arr1[i] = 2;
		bc_arr[i] = '2 iGold';
	}
	if(i==6){
		bc_arr1[i] = 5;
		bc_arr[i] = '5 iGold';
	}
	if(i==12){
		bc_arr1[i] = 5;
		bc_arr[i] = '5 iGold';
	}
}
bc_arr1[10] = 10;bc_arr[10] = '10 iGold';
bc_arr1[18] = 'X2';bc_arr[18] = 'item X2';
jQuery(document).ready(function(){
	jQuery("body").on("contextmenu",function(){
		return false;
	});
	var img1 = new Image('skins/ssnh/images/lucky_wheel/girl_bored.png');
	var img2 = new Image('skins/ssnh/images/lucky_wheel/girl_smile.png');
	setupWheel(total,bc_arr);
	var time = Cookies.get('lucky_wheel_time')?Cookies.get('lucky_wheel_time'):0;
	iGoldObj = jQuery('#igold');
	jQuery('.spin-trigger').click(function(){
		if(checkiGold(blockId,2)){
			payiGold(blockId);
			jQuery('.col-md-4.right').attr('class','col-md-4 right');
			//jBeep('skins/ssnh/media/rotate_play.mp3');
			jQuery(this).val('...');
			jQuery(this).attr('disabled',true);
			time = to_numeric(time)+2;
			Cookies.set('lucky_wheel_time',time);
			iGoldObj.addClass( "igold small", 1000, "easeOutBounce",function(){iGoldObj.removeClass('small',1000,"easeOutBounce")});
			jQuery('#totaliGold').html(time);
		}
	});
	jQuery('#totaliGold').html(time);
});
</script>
