<div class="nav">
    <ul class="left">
        <li><a href="">Trang chủ</a></li>
        <li><span> » </span></li>
        <li><a href="tin-tong-hop">Tin tức</a></li>
        <?php 
				if(($this->map['category_name_id']))
				{?>              
        <li><span> » </span></li>
        <li><a href="tin-tuc/<?php echo $this->map['category_name_id'];?>" class="actived"><?php echo $this->map['category_name'];?></a></li>
        
				<?php
				}
				?>
    </ul>
</div>
<div class="content-r">
		<div class="title"><h1><?php echo $this->map['category_name'];?></h1></div>
    <div class="list-news">
    	<?php 
				if((Url::get('tags')))
				{?><br />
          <div class="tags">Kết quả tìm kiếm với tags: <a href="tin-tuc.html?tags=<?php echo Url::get('tags')?>"><strong><?php echo Url::get('tags')?></strong></a></div>
          
				<?php
				}
				?>
        <?php 
				if((!empty($this->map['news_all'])))
				{?>
        <?php
					if(isset($this->map['news_all']) and is_array($this->map['news_all']))
					{
						foreach($this->map['news_all'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['news_all']['current'] = &$item1;?>
        <div class="similar">
            <div class="img-container">
               <a href="tin-tuc/<?php echo $this->map['news_all']['current']['category_name_id'];?>/<?php echo $this->map['news_all']['current']['name_id'];?>.html" title="<?php echo $this->map['news_all']['current']['name'];?>"><img src="<?php echo $this->map['news_all']['current']['small_thumb_url'];?>" alt="<?php echo $this->map['news_all']['current']['name'];?>" /></a>
            </div><!--End .img-container-->
            <h2><a href="tin-tuc/<?php echo $this->map['news_all']['current']['category_name_id'];?>/<?php echo $this->map['news_all']['current']['name_id'];?>.html"><?php echo $this->map['news_all']['current']['name'];?></a></h2>
                <span>Thời gian: <?php echo date('d/m/Y',$this->map['news_all']['current']['time'])?> </span>
                <p><?php echo String::display_sort_title(strip_tags($this->map['news_all']['current']['description']),System::check_user_agent()?20:100);?></p>
                <h6><a href="tin-tuc/<?php echo $this->map['news_all']['current']['category_name_id'];?>/<?php echo $this->map['news_all']['current']['name_id'];?>.html">Chi tiết </a></h6>
        </div>
        
							
						<?php
							}
						}
					unset($this->map['news_all']['current']);
					} ?>
        <div class="paging">
            <?php echo $this->map['paging'];?>
        </div><!--End .pt-->
         <?php }else{ ?>
        <div class="note"><h2>Không có tin bài trong chuyên mục này</h2></div>
        
				<?php
				}
				?>
    </div><!--Enn .list-news-->
</div><!--End .content-r-->