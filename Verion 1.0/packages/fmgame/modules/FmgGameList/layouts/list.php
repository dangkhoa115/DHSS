<h1 class="title">MINI GAME</h1>
<table class="table">
		  </thead>
				<tbody>		
				<!--LIST:items-->	
				<tr bgcolor="<?php if((URL::get('just_edited_id',0)==[[=items.id=]]) or (is_numeric(array_search(MAP['items']['current']['id'],[[=just_edited_ids=]])))){ echo Portal::get_setting('crud_just_edited_item_bgcolor','#FFFFDD');} else {echo Portal::get_setting('crud_item_bgcolor','white');}?>" valign="middle" <?php Draw::hover(Portal::get_setting('crud_item_hover_bgcolor','#FFFFDD'));?> style="cursor:hand;<?php if([[=items.index=]]%2){echo 'background-color:#F9F9F9';}?>" id="FmgGameList_tr_[[|items.id|]]">
					<td width="1%"><img src="https://sieusaongoaihang.vn/[[|items.small_thumb_url|]]" width="100" /></td >
					<td  align="left">
          	<a href="#" class="hvr-bob" data-toggle="modal" data-target="#game[[|items.id|]]" target="_blank" onClick="jQuery('#gameFrame[[|items.id|]]').html('<?php echo str_replace(array("'","\""),"\'",String::string2js([[=items.description_1=]]));?>')">[[|items.name|]]</a>
            <p style="color:#999;">[[|items.brief|]]</p>
           </td>
				</tr>
				<!--/LIST:items-->
				</tbody>
	  </table>
		<table width="100%" cellpadding="6" cellspacing="0" style="background-color:#F0F0F0;border:1px solid #E7E7E7;height:8px;#width:99%" align="center">
			<tr>
			<td width="48%" align="left"></td>
			<td width="31%">[[|paging|]]</td>
</tr></table>
<!--LIST:items-->
<div class="modal fade" id="game[[|items.id|]]" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#f00;">&times;</span></button>
        <h4 class="modal-title">[[|items.name|]]</h4>
      </div>
      <div class="modal-body">
        <div id="gameFrame[[|items.id|]]"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
<!--/LIST:items-->