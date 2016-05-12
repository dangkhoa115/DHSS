<div class="nav">
    <ul class="left">
        <li><a href="">Trang chủ</a></li>
        <li><span> » </span></li>
        <li><a href="trang-video/">Video</a></li>
        <?php 
				if(($this->map['category_name_id']))
				{?>              
        <li><span> » </span></li>
        <li><a href="trang-video/<?php echo $this->map['category_name_id'];?>" class="actived"><?php echo $this->map['category_name'];?></a></li>
        
				<?php
				}
				?>
    </ul>
</div>
<div class="content-r">
	<div class="title">
    	<h1><?php echo $this->map['category_name'];?></h1>
        <form name="VideoListForm" method="post">
        	<select  name="category_name_id" id="category_name_id" onchange="window.location='trang-video/'+this.value"><?php
					if(isset($this->map['category_name_id_list']))
					{
						foreach($this->map['category_name_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('category_name_id').value = "<?php echo addslashes(URL::get('category_name_id',isset($this->map['category_name_id'])?$this->map['category_name_id']:''));?>";</script>
	</select>
        <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
    </div>
    	<?php 
				if((!empty($this->map['items'])))
				{?>
        <div class="list news video">
        <?php 
				if((Url::get('tags')))
				{?><br />
          <div class="tags">Kết quả tìm kiếm với tags: <a href="trang-video/?tags=<?php echo Url::get('tags')?>"><strong><?php echo Url::get('tags')?></strong></a></div>
          
				<?php
				}
				?>
        <?php $i=0;?>
        <?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
        <div class="similar<?php echo ($i%3==0)?' first':'';$i++;?>">
            <div class="img-container">
                <a href="trang-video/<?php echo $this->map['items']['current']['category_name_id'];?>/<?php echo $this->map['items']['current']['name_id'];?>.html"><img class="play-video" src="skins/ssnh/images/play_video.png" alt="Play"></a>
                <a href="trang-video/<?php echo $this->map['items']['current']['category_name_id'];?>/<?php echo $this->map['items']['current']['name_id'];?>.html"><img src="<?php echo $this->map['items']['current']['image_url'];?>" /></a>
            </div><!--End .img-container-->
            <h2><a href="trang-video/<?php echo $this->map['items']['current']['category_name_id'];?>/<?php echo $this->map['items']['current']['name_id'];?>.html"><?php echo $this->map['items']['current']['name'];?></a></h2>
        </div>
        
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>       
        </div><!--Enn .list-news-->
    <div class="paging">
        <?php echo $this->map['paging'];?>
    </div><!--End .pt-->
     <?php }else{ ?>
    <div class="similar"><h2>Không có tin bài trong chuyên mục này</h2></div>
    
				<?php
				}
				?>
</div><!--End .content-r-->