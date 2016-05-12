<div class="nav">
    <ul class="left">
        <li><a href="">Trang chủ</a></li>
        <li><span> » </span></li>
        <li><a href="gaming">Gaming</a></li>
        <?php 
				if(($this->map['category_name_id']))
				{?>              
        <li><span> » </span></li>
        <li><a href="gaming/<?php echo $this->map['category_name_id'];?>" class="actived"><?php echo $this->map['category_name'];?></a></li>
        
				<?php
				}
				?>
    </ul>
</div>
<div class="content-r">
    <div class="list-game">
    	<?php 
				if((Url::get('tags')))
				{?><br />
          <div class="tags">Kết quả tìm kiếm với tags: <a href="gaming.html?tags=<?php echo Url::get('tags')?>"><strong><?php echo Url::get('tags')?></strong></a></div>
          
				<?php
				}
				?>
        <?php 
				if((!empty($this->map['game_all'])))
				{?>
        <?php
					if(isset($this->map['game_all']) and is_array($this->map['game_all']))
					{
						foreach($this->map['game_all'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['game_all']['current'] = &$item1;?>
        <div class="similar">
            <div class="img-container">
               <a href="gaming/<?php echo $this->map['game_all']['current']['category_name_id'];?>/<?php echo $this->map['game_all']['current']['name_id'];?>.html"><img src="<?php echo $this->map['game_all']['current']['small_thumb_url'];?>" /></a>
            </div><!--End .img-container-->
            <h2><a href="gaming/<?php echo $this->map['game_all']['current']['category_name_id'];?>/<?php echo $this->map['game_all']['current']['name_id'];?>.html"><?php echo $this->map['game_all']['current']['name'];?></a></h2>
                <span>Thời gian: <?php echo date('d/m/Y',$this->map['game_all']['current']['time'])?> </span>
                <p><?php echo String::display_sort_title(strip_tags($this->map['game_all']['current']['description']),System::check_user_agent()?20:100);?></p>
                <div><a href="gaming/<?php echo $this->map['game_all']['current']['category_name_id'];?>/<?php echo $this->map['game_all']['current']['name_id'];?>.html" class="btn btn-default">Chơi game</a></div>
        </div>
        
							
						<?php
							}
						}
					unset($this->map['game_all']['current']);
					} ?>
        <div class="paging">
            <?php echo $this->map['paging'];?>
        </div><!--End .pt-->
         <?php }else{ ?>
        <div class="note"><h2>Không có tin bài trong chuyên mục này</h2></div>
        
				<?php
				}
				?>
    </div><!--Enn .list-game-->
</div><!--End .content-r-->