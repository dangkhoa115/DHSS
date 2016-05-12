<div class="news-top">
		<div class="img"><a href="tham-gia-binh-chon/do/bc.html" title="Tham gia bình chọn" class="btn btn-default">HÃY THAM GIA BÌNH CHỌN<br><img src="skins/ssnh/images/landing_page/phan_thuong.png" alt="Tham gia bình chọn"></a><br><br></div>
    <h3 class="title">Tin nổi bật</h3>
        <div class="body">
            <?php $i = 1;?>
            <?php
					if(isset($this->map['news']) and is_array($this->map['news']))
					{
						foreach($this->map['news'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['news']['current'] = &$item1;?>
            <div class="item">
                <a title="<?php echo $this->map['news']['current']['name'];?>" href="tin-tuc/<?php echo $this->map['news']['current']['category_name_id'];?>/<?php echo $this->map['news']['current']['name_id'];?>.html"><?php echo $this->map['news']['current']['name'];?></a>
            </div>
            
							
						<?php
							}
						}
					unset($this->map['news']['current']);
					} ?>
        </div>
</div><!--End .news-top--><br clear="all">