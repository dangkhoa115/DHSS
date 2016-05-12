<div class="content-r binh-chon">
  <div class="title"><h1>Tham gia bình chọn</h1></div>
  <div class="detail">
  	<?php if(Form::$current->is_error()){echo Form::$current->error_messages();}?>	
    <form name="SsnhGetiGoldForm" id="SsnhGetiGoldForm" method="post" enctype="multipart/form-data">
    <table width="100%" border="1" cellspacing="0" cellpadding="5" bordercolor="#CCC">
      <thead>
      	<tr>
          <th width="1%" align="center">STT</th>
          <th>Chọn đội</th>
          <th>iGold</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td align="center">1</td>
          <td><select  name="clb_id_1" id="clb_id_1" onChange="updateTotal();"><?php
					if(isset($this->map['clb_id_1_list']))
					{
						foreach($this->map['clb_id_1_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('clb_id_1').value = "<?php echo addslashes(URL::get('clb_id_1',isset($this->map['clb_id_1'])?$this->map['clb_id_1']:''));?>";</script>
	</select></td>
          <td align="right" id="total_igold_1" class="igold-amount"></td>
        </tr>
        <tr>
          <td align="center">2</td>
          <td><select  name="clb_id_2" id="clb_id_2" onChange="updateTotal();"><?php
					if(isset($this->map['clb_id_2_list']))
					{
						foreach($this->map['clb_id_2_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('clb_id_2').value = "<?php echo addslashes(URL::get('clb_id_2',isset($this->map['clb_id_2'])?$this->map['clb_id_2']:''));?>";</script>
	</select></td>
          <td align="right" id="total_igold_2" class="igold-amount">&nbsp;</td>
        </tr>
        <tr>
          <td align="center">3</td>
          <td><select  name="clb_id_3" id="clb_id_3" onChange="updateTotal();"><?php
					if(isset($this->map['clb_id_3_list']))
					{
						foreach($this->map['clb_id_3_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('clb_id_3').value = "<?php echo addslashes(URL::get('clb_id_3',isset($this->map['clb_id_3'])?$this->map['clb_id_3']:''));?>";</script>
	</select></td>
          <td align="right" id="total_igold_3" class="igold-amount">&nbsp;</td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="right"><strong>Tổng cộng</strong></td>
          <td align="right" id="total" class="igold-amount">0</td>
        </tr>
      </tbody>
    </table>
    <div class="binh-chon-button">
    	<input  name="binh-chon" value="Bình chọn" class="button" type ="button" value="<?php echo String::html_normalize(URL::get('binh-chon'));?>">
    </div>
    <input  name="total_amount" id="total_amount" type ="hidden" value="<?php echo String::html_normalize(URL::get('total_amount'));?>">
    <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
    <br clear="all">
  </div>
</div>