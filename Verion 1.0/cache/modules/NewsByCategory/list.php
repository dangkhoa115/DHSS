<div class="content-r">
  <?php $j=1;?>
  <?php
					if(isset($this->map['news_categories']) and is_array($this->map['news_categories']))
					{
						foreach($this->map['news_categories'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['news_categories']['current'] = &$item1;?>
  <div class="list news">
    <h2 class="title"><a href="tin-tuc/<?php echo $this->map['news_categories']['current']['name_id'];?>" title="<?php echo $this->map['news_categories']['current']['name'];?>"><?php echo $this->map['news_categories']['current']['name'];?></a></h2>
    <div class="view-more"><a href="tin-tuc/<?php echo $this->map['news_categories']['current']['name_id'];?>" title="<?php echo $this->map['news_categories']['current']['name'];?>">Xem thêm &raquo;</a></div>
    <ul>
    	<?php $i=1;?>
        <?php
					if(isset($this->map['news_categories']['current']['items']) and is_array($this->map['news_categories']['current']['items']))
					{
						foreach($this->map['news_categories']['current']['items'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['news_categories']['current']['items']['current'] = &$item2;?>
        <li <?php echo ($j==1)?' class="tin-moi-nhat"':'';?>>
            <a href="tin-tuc/<?php echo $this->map['news_categories']['current']['items']['current']['category_name_id'];?>/<?php echo $this->map['news_categories']['current']['items']['current']['name_id'];?>.html" title="<?php echo $this->map['news_categories']['current']['items']['current']['name'];?>">
            <?php echo String::display_sort_title(strip_tags($this->map['news_categories']['current']['items']['current']['name']),15);?>
            <?php if($i==1){?><img alt="<?php echo $this->map['news_categories']['current']['items']['current']['name'];?>" src="<?php echo $this->map['news_categories']['current']['items']['current']['small_thumb_url'];?>" <?php echo ($j==1)?'style="width:100% !important;max-height:415px;"':''?> /><?php }?></a>
            <?php if($i==1 and $j!=1){echo '<div class="brief">'.String::display_sort_title(strip_tags($this->map['news_categories']['current']['items']['current']['brief']),40).'</div>';} $i++;?>
        </li>
        
							
						<?php
							}
						}
					unset($this->map['news_categories']['current']['items']['current']);
					} ?>
    </ul>
  </div><!--End #tabs-->
  <?php $j++;?>
  
							
						<?php
							}
						}
					unset($this->map['news_categories']['current']);
					} ?>
</div><!--End .container-->
<script type="text/javascript">
function update_hitcount_(id){
	jQuery.ajax({
		method: "POST",
		url: 'form.php?block_id=<?php echo Module::block_id(); ?>',
		data : {
			'do':'update_hitcount',
			'id':id
		},
		success: function(){
		}
	});
}
</script>