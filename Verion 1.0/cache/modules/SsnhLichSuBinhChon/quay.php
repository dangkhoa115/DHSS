<script type="text/javascript" src="skins/ssnh/scripts/winwheel_new/lib.js"></script>
<link rel="stylesheet" href="skins/ssnh/scripts/winwheel_new/style.css" type="text/css" />
<div class="content-r binh-chon">
  <div class="title"><h1>Quay chọn người chơi trúng thưởng bình chọn <form name="TrungThuongForm" method="post">
      <select  name="vong_dau_id" id="vong_dau_id" onchange="TrungThuongForm.submit()"><?php
					if(isset($this->map['vong_dau_id_list']))
					{
						foreach($this->map['vong_dau_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('vong_dau_id').value = "<?php echo addslashes(URL::get('vong_dau_id',isset($this->map['vong_dau_id'])?$this->map['vong_dau_id']:''));?>";</script>
	</select>
      <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			</h1></div>
  <div id="main">
    <div id="left-column">
        <form class="iform" action="#" method="get">
            <div id="spin-button-wrapper"><button class="spin-trigger button big round">Quay</button></div>
            <a class="choi-tiep" href="#">Tiếp tục</a>
            <input type="hidden" id="current_winner" value="0"> 
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			        
        <canvas class="canvas" width="500" height="500"></canvas> 
    </div>
    <div id="right-column">
        <p class="winner"><span>&nbsp;</span></p>
        <ul class="participants"></ul>
        <table cellpadding="2" cellspacing="0" width="100%" align="center" class="ds-nguoi-choi">
      	<tr>
      	  <th align="center" width="1%">STT</th>
        	<th align="left" width="120">Người chơi</th>
          </tr>
        <?php
					if(isset($this->map['binhchons']) and is_array($this->map['binhchons']))
					{
						foreach($this->map['binhchons'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['binhchons']['current'] = &$item1;?>
        <tr>
          <td align="center"><?php echo $this->map['binhchons']['current']['i'];?></td>
          <td id="nguoi_choi_<?php echo $this->map['binhchons']['current']['i'];?>"><?php echo $this->map['binhchons']['current']['account_id'];?></td>
          </tr>
        
							
						<?php
							}
						}
					unset($this->map['binhchons']['current']);
					} ?>
      </table>
        </ul>
    </div>
    <div style="clear:both"></div>  
  </div>
</div>
<script>
var totalSpin = 5;
jQuery(document).ready(function(){
	var total = to_numeric(<?php echo sizeof($this->map['binhchons'])?>);
	var bc_arr = [];
	for(var j=0;j<total;j++){
		bc_arr[j] = j+1;
	}
	setupWheel(total,bc_arr);
	jQuery('.spin-trigger').click(function(){
		jQuery(this).html('...');
		jQuery(this).attr('disabled',true);
		jQuery('.choi-tiep').hide();
	});
	jQuery('.choi-tiep').click(function(){
		jQuery('.spin-trigger').attr('disabled',false);
		jQuery('.spin-trigger').html('Quay thưởng');
		jQuery('.winner').hide();
		var index_  = to_numeric(jQuery('#current_winner').val()) - 1;
		if(typeof bc_arr[index_] !== 'undefined' && bc_arr.length > 1) {
			bc_arr,bc_arr[index_] = 'OK';
			jQuery('#spin-button-wrapper').html('<button class="spin-trigger button big round" onclick="jQuery(this).html(\'...\');		jQuery(this).attr(\'disabled\',true);		jQuery(\'.choi-tiep\').hide();">Quay</button>');
			setupWheel(total,bc_arr,'.spin-trigger');
		}
		jQuery(this).hide();
		return false;
	});
});
</script>
