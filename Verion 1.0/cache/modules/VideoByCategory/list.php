<div class="nav">
    <ul class="left">
        <li><a href="">Trang chủ</a></li>
        <li><span> » </span></li>
        <li><a href="trang-video-tong-hop.html">Video</a></li>        
    </ul>
</div>
<div class="content-r">
	<div class="title">
    	<h1>Trang tổng hợp video giải Ngoại Hạng</h1>
    </div>
  <?php $j=1;?>
  <?php
					if(isset($this->map['news_categories']) and is_array($this->map['news_categories']))
					{
						foreach($this->map['news_categories'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['news_categories']['current'] = &$item1;?>
  <div class="list news" style="border:0px;box-shadow:none;">
    <h2 class="title"><a href="trang-video/<?php echo $this->map['news_categories']['current']['name_id'];?>" title="<?php echo $this->map['news_categories']['current']['name'];?>"><?php echo $this->map['news_categories']['current']['name'];?></a></h2>
    <div class="view-more"><a href="trang-video/<?php echo $this->map['news_categories']['current']['name_id'];?>" title="<?php echo $this->map['news_categories']['current']['name'];?>">Xem thêm &raquo;</a></div>
    <!--IF:cond1(!empty($this->map['news_categories']['current']['items']))-->
    <div class="list news video">
    <?php $i=0;?>
    <?php
					if(isset($this->map['news_categories']['current']['items']) and is_array($this->map['news_categories']['current']['items']))
					{
						foreach($this->map['news_categories']['current']['items'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['news_categories']['current']['items']['current'] = &$item2;?>
    <div class="similar<?php echo ($i%3==0)?' first':'';$i++;?>">
        <div class="img-container">
            <a href="trang-video/<?php echo $this->map['news_categories']['current']['items']['current']['category_name_id'];?>/<?php echo $this->map['news_categories']['current']['items']['current']['name_id'];?>.html"><img class="play-video" src="skins/ssnh/images/play_video.png" alt="Play"></a>
            <a href="trang-video/<?php echo $this->map['news_categories']['current']['items']['current']['category_name_id'];?>/<?php echo $this->map['news_categories']['current']['items']['current']['name_id'];?>.html"><img src="<?php echo $this->map['news_categories']['current']['items']['current']['image_url'];?>" /></a>
        </div><!--End .img-container-->
        <h2><a href="trang-video/<?php echo $this->map['news_categories']['current']['items']['current']['category_name_id'];?>/<?php echo $this->map['news_categories']['current']['items']['current']['name_id'];?>.html"><?php echo $this->map['news_categories']['current']['items']['current']['name'];?></a></h2>
    </div>
    
							
						<?php
							}
						}
					unset($this->map['news_categories']['current']['items']['current']);
					} ?>
  </div>
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