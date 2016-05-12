<div class="module-news row">
  <div class="latestnew features col-md-6">
      <div class="title">Tin tức mới nhất</div>
      <?php $i=1;?>
      <?php
					if(isset($this->map['tin_moi_nhats']) and is_array($this->map['tin_moi_nhats']))
					{
						foreach($this->map['tin_moi_nhats'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['tin_moi_nhats']['current'] = &$item1;?>
      <?php if($i==1){?>
      <div class="last">
          <h3><a href="tin-tuc/<?php echo $this->map['tin_moi_nhats']['current']['category_name_id'];?>/<?php echo $this->map['tin_moi_nhats']['current']['name_id'];?>.html" title="<?php echo $this->map['tin_moi_nhats']['current']['name'];?>"><?php echo $this->map['tin_moi_nhats']['current']['name'];?></a></h3>
          <img src="<?php echo $this->map['tin_moi_nhats']['current']['small_thumb_url'];?>" alt="<?php echo $this->map['tin_moi_nhats']['current']['name'];?>"/>
          <p><?php echo String::display_sort_title(strip_tags($this->map['tin_moi_nhats']['current']['brief']),30);?></p>
      </div>
      <?php }else{?>
      <?php if($i==2){?>
      <ul class="other">
      <?php }?>
          <li><a href="tin-tuc/<?php echo $this->map['tin_moi_nhats']['current']['category_name_id'];?>/<?php echo $this->map['tin_moi_nhats']['current']['name_id'];?>.html"><?php echo $this->map['tin_moi_nhats']['current']['name'];?></a></li>
      <?php if($i==sizeof($this->map['tin_moi_nhats'])){?>
      </ul>
      <?php }} $i++;?>
      
							
						<?php
							}
						}
					unset($this->map['tin_moi_nhats']['current']);
					} ?>
      <h6 class="view-all"><a href="tin-tuc/thong-tin-chung">Xem tất cả</a></h6>
  </div>
  <div class="playernew features col-md-6">
      <div class="title">Tin tức nổi bật</div>
       <?php $i=1;?>
      <?php
					if(isset($this->map['tin_hots']) and is_array($this->map['tin_hots']))
					{
						foreach($this->map['tin_hots'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['tin_hots']['current'] = &$item2;?>
      <?php if($i==1){?>
      <div class="last">
          <h3><a href="tin-tuc/<?php echo $this->map['tin_hots']['current']['category_name_id'];?>/<?php echo $this->map['tin_hots']['current']['name_id'];?>.html" title="<?php echo $this->map['tin_hots']['current']['name'];?>"><?php echo $this->map['tin_hots']['current']['name'];?></a></h3>
          <img src="<?php echo $this->map['tin_hots']['current']['small_thumb_url'];?>" alt="<?php echo $this->map['tin_hots']['current']['name'];?>"/>
          <p><?php echo String::display_sort_title(strip_tags($this->map['tin_hots']['current']['brief']),30);?></p>
      </div>
      <?php }else{?>
      <?php if($i==2){?>
      <ul class="other">
      <?php }?>
          <li><a href="tin-tuc/<?php echo $this->map['tin_hots']['current']['category_name_id'];?>/<?php echo $this->map['tin_hots']['current']['name_id'];?>.html"><?php echo $this->map['tin_hots']['current']['name'];?></a></li>
      <?php if($i==sizeof($this->map['tin_hots'])){?>
      </ul>
      <?php }} $i++;?>
      
							
						<?php
							}
						}
					unset($this->map['tin_hots']['current']);
					} ?>
      <h6 class="view-all"><a href="tin-tuc/tin-cau-thu">Xem tất cả</a></h6>
  </div>
</div><!--End .module-news-->