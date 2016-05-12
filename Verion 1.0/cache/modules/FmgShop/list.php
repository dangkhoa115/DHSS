<div class="content-r shop">
	<div class="title"><h1>SHOP ITEM</h1></div>    
  <div class="detail col-md-8">
    <ul class="nav nav-tabs" role="tablist">
     <li role="presentation"<?php echo !Url::get('tab')?' class="active"':'';?>>
      <a href="#mua_item" role="tab" data-toggle="tab">Mua item</a>        
     </li>
     <li role="presentation"<?php echo (Url::get('tab')=='your_item')?' class="active"':'';?>>
      <a href="#item_da_mua" role="tab" data-toggle="tab">Item của bạn</a>
     </li>
     <li class="hide" role="presentation"<?php echo (Url::get('tab')=='used_item')?' class="active"':'';?>>
      <a href="#item_da_su_dung" role="tab" data-toggle="tab">Item đã sử dụng</a>
     </li>
    </ul>
    <div class="tab-content">
    	<div class="loading">Đang tải ... </div>
      <div class="mask"></div>
      <div class="tab-pane fade <?php echo !Url::get('tab')?'active':'';?> in" id="mua_item">
        <ul class="item">
          <?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
          <li><a id="item_<?php echo $this->map['items']['current']['id'];?>" itemId="<?php echo $this->map['items']['current']['id'];?>" class="item-name" href="#" title="<?php echo $this->map['items']['current']['name'];?>" desc="<?php echo $this->map['items']['current']['description'];?>" type="<?php echo $this->map['items']['current']['type'];?>" img="<?php echo $this->map['items']['current']['icon'];?>" price="<?php echo $this->map['items']['current']['price'];?>" max_quantity="<?php echo $this->map['items']['current']['max_quantity'];?>"><img src="<?php echo $this->map['items']['current']['icon'];?>" alt="<?php echo $this->map['items']['current']['name'];?>"><span><?php echo $this->map['items']['current']['price']?($this->map['items']['current']['price'].'iGold'):'Miễn phí';?></span></a></li>
          
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
        </ul>
      </div>
      <div class="tab-pane fade <?php echo (Url::get('tab')=='your_item')?'active':'';?> in" id="item_da_mua">
        <ul class="item">
          <?php
					if(isset($this->map['bought_items']) and is_array($this->map['bought_items']))
					{
						foreach($this->map['bought_items'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['bought_items']['current'] = &$item2;?>
          <li><a itemId="<?php echo $this->map['bought_items']['current']['id'];?>" class="item-name" href="#" title="<?php echo $this->map['bought_items']['current']['name'];?>" desc="<?php echo $this->map['bought_items']['current']['description'];?>" type="<?php echo $this->map['bought_items']['current']['type'];?>" img="<?php echo $this->map['bought_items']['current']['icon'];?>" price="<?php echo $this->map['bought_items']['current']['price'];?>"><img src="<?php echo $this->map['bought_items']['current']['icon'];?>" alt="<?php echo $this->map['bought_items']['current']['name'];?>"><span class="da-mua">Bạn có: <strong><?php echo $this->map['bought_items']['current']['quantity'];?></strong></span></a></li>
          
							
						<?php
							}
						}
					unset($this->map['bought_items']['current']);
					} ?>
        </ul>
      </div>
      <div class="tab-pane fade <?php echo (Url::get('tab')=='used_item')?'active':'';?> in" id="item_da_su_dung">
        <ul class="item">
          <?php
					if(isset($this->map['used_items']) and is_array($this->map['used_items']))
					{
						foreach($this->map['used_items'] as $key3=>&$item3)
						{
							if($key3!='current')
							{
								$this->map['used_items']['current'] = &$item3;?>
          <li><a itemId="<?php echo $this->map['used_items']['current']['id'];?>" class="item-name" href="<?php echo $this->map['used_items']['current']['href'];?>" title="<?php echo $this->map['used_items']['current']['name'];?>" desc="<?php echo $this->map['items']['current']['description'];?>" type="<?php echo $this->map['used_items']['current']['type'];?>" img="<?php echo $this->map['used_items']['current']['icon'];?>" price="<?php echo $this->map['used_items']['current']['price'];?>"><img src="<?php echo $this->map['used_items']['current']['icon'];?>" alt="<?php echo $this->map['used_items']['current']['name'];?>"><span class="da-mua"><strong><?php echo $this->map['used_items']['current']['vong_dau'];?></strong><br><strong>Sử dụng: <?php echo date('H:i\' d/m/Y',$this->map['used_items']['current']['time'])?></strong></span></a></li>
          
							
						<?php
							}
						}
					unset($this->map['used_items']['current']);
					} ?>
        </ul>
        <br clear="all">
        <div class="pt"><?php echo $this->map['paging'];?></div>
      </div>
    </div>
  </div>
  <div class="col-md-4 bought-item">
    <h2></h2>
    <div class="detail">
      <div id="boughtItem" class="detai-inner"></div>	
    </div>
  </div>
</div>   
<script>
jQuery(document).ready(function(e) {
	jQuery('.loading').hide();
	jQuery('.mask').fadeOut();
  jQuery('#mua_item .item-name').each(function(index, element) {
    jQuery(this).click(function(){
			var quantity_options = '<option value="">Chọn số lượng</option>';
			maxQuatity = to_numeric(jQuery(this).attr('max_quantity'));
			for(i=1;i<=maxQuatity;i++){
				quantity_options += '<option value="'+i+'">'+i+'</option>';
			}
			$html = '<img src="'+jQuery(this).attr('img')+'">'+'<label>'+jQuery(this).attr('title')+'</label><div class="desc">'+jQuery(this).attr('desc')+'</div>';
			if(to_numeric(jQuery(this).attr('price'))<=0){
				$html += '<span>Sử dụng miễn phí</span><a href="#"  onclick="useItem('+jQuery(this).attr('itemId')+','+jQuery(this).attr('type')+');return false;" class="btn btn-default">Sử dụng</a>';
			}else{
				$html += '<span>'+jQuery(this).attr('price')+' iGold</span><div style="padding:5px;"><center><select  name="quantity" id="quantity" onchange="updateTotal(this.value,'+jQuery(this).attr('itemId')+')" class="form-control">'+quantity_options+'</select></center></div><div><center><input  name="total_amount" id="total_amount" class="form-control" readonly placeholder="Tổng iGold" style=text-align:right;font-weight:bold;margin-bottom:5px;" type ="text" value="<?php echo String::html_normalize(URL::get('total_amount'));?>"></center></div><a class="btn btn-primary" onclick="buyItem('+jQuery(this).attr('itemId')+',to_numeric(jQuery(\'#quantity\').val()))"> Mua item</a>';
			}
			jQuery('#boughtItem').html($html);
			return false;
		});
  });
	jQuery('#item_da_mua .item-name').each(function(index, element) {
    jQuery(this).click(function(){
			jQuery('#boughtItem').html('<img src="'+jQuery(this).attr('img')+'">'+'<label>'+jQuery(this).attr('title')+'</label><div class="desc">'+jQuery(this).attr('desc')+'</div><a class="btn btn-primary" onclick="useItem('+jQuery(this).attr('itemId')+','+jQuery(this).attr('type')+');"> Sử dụng </a>');
			return false;
		});
  });
});
function updateTotal(quantity,itemId){
	price = to_numeric(jQuery('#item_'+itemId).attr('price'));
	total = quantity*price;
	jQuery('#total_amount').val(numberFormat(total));
}
function buyItem(itemId,quantity){
	if(quantity<1){
		custom_alert('Bạn vui lòng chọn số lượng item cần mua');
		return false;	
	}else{
		jQuery.ajax({
			method: "POST",
			url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
			data : {
				'do':'buy_item',
				'item_id':itemId,
				'quantity':quantity,
				'total_amount':to_numeric(jQuery('#total_amount').val())
			},
			beforeSend: function(){
				//jQuery('#notice').html('<h3>loading...</h3>');
			},
			success: function(content){
				if(content == 'true'){
					custom_alert('Bạn đã mua item thành công!');
					location.reload();
				}else if(content == 'false'){
					custom_alert('Số lượng item bạn mua lớn hơn số lượng item tối đa bạn được mua');
				} else if (content == 'not_enough_igold'){
					custom_alert('Số iGold của bạn không đủ để mua item. Vui lòng nạp thêm iGold để mua!');
					return false;
				}
			},
			error: function(){
				custom_alert('Update lỗi');
			}
		});
	}
}
function useItem(itemId,type){
	type = to_numeric(type);
	/*
		1=>Vong quay
		2=>'Con số may mắn',
		3=>'X2 điểm số',
		4=>'Tự động chọn 3 đội',
		5=>'Tổng bàn thắng 1 vòng'
	*/
	switch (type){
		case 1:
			window.location = '?page=fmg_lucky_wheel';
			break;			
		case 2:
			window.location = '?page=fmg_team&do=edit&item_id='+itemId; // THE DOI TEN
			break;
		case 3:
			window.location = '?page=fmg_shop&do=st&item_id='+itemId;// BOM THE LUC
			break;
		case 4:
			window.location = '?page=fmg_team&do=edit_team&act=transfer&item_id='+itemId; // The chuyen nhuong
			break;
		case 5:
			window.location = 'tham-gia-binh-chon/do/ban_thang.html';
			break;
	}
}
</script>