<h1 class="title">MINI GAME</h1>
<table class="table">
		  </thead>
				<tbody>		
				<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>	
				<tr bgcolor="<?php if((URL::get('just_edited_id',0)==$this->map['items']['current']['id']) or (is_numeric(array_search($this->map['items']['current']['id'],$this->map['just_edited_ids'])))){ echo Portal::get_setting('crud_just_edited_item_bgcolor','#FFFFDD');} else {echo Portal::get_setting('crud_item_bgcolor','white');}?>" valign="middle" <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if($this->map['items']['current']['index']%2){echo 'background-color:#F9F9F9';}?>" id="FmgGameList_tr_<?php echo $this->map['items']['current']['id'];?>">
					<td width="1%"><img src="https://sieusaongoaihang.vn/<?php echo $this->map['items']['current']['small_thumb_url'];?>" width="100" /></td >
					<td  align="left">
          	<a href="#" class="hvr-bob" data-toggle="modal" data-target="#game<?php echo $this->map['items']['current']['id'];?>" target="_blank" onClick="jQuery('#gameFrame<?php echo $this->map['items']['current']['id'];?>').html('<?php echo str_replace(array("'","\""),"\'",String::string2js($this->map['items']['current']['description_1']));?>')"><?php echo $this->map['items']['current']['name'];?></a>
            <p style="color:#999;"><?php echo $this->map['items']['current']['brief'];?></p>
           </td>
				</tr>
				
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
				</tbody>
	  </table>
		<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
			<tr>
			<td width="48%" align="left"></td>
			<td width="31%"><?php echo $this->map['paging'];?></td>
</tr></table>
<?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['items']['current'] = &$item2;?>
<div class="modal fade" id="game<?php echo $this->map['items']['current']['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#f00;">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->map['items']['current']['name'];?></h4>
      </div>
      <div class="modal-body">
        <div id="gameFrame<?php echo $this->map['items']['current']['id'];?>"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>

							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>