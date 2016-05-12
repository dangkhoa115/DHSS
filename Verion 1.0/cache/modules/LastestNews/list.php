<div class="news-top">
	<div class="img"><a href="http://doihinhsieusao.com" target="_blank" title="Game bóng đá hấp dẫn có thưởng" class="btn btn-default">Game bóng đá hấp dẫn có thưởng!<br><img src="http://doihinhsieusao.com/skins/ssnh/images/fm_game/qc_web.jpg" alt="Đội hình siêu sao" width="100%"></a><br><br></div>
    <h3 class="title">Tin mới nhất</h3>
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