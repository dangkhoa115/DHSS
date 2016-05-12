<div class="row">
  <div class="col-md-8">
    <div class="title-all">
        <h1><?php echo $this->map['name'];?></h1>
    </div>
    <div class="module-video">
        <div class="video-play" id="video-play">
          <?php 
				if(($this->map['url']))
				{?>
        <div id="mediaspace" >
                <video width="100%" height="auto" controls>
                  <source src="<?php echo str_replace(' ','%20',$this->map['url']);?>" type="video/mp4">
                	Your browser does not support the video tag.
                </video>
            </div>
             <?php }else{ ?>
           <?php echo preg_replace("/width=\'([^\"]+)\'/",'width="100%"',$this->map['embed']);?> 
            
				<?php
				}
				?>
        </div>
        <div class="video-description">
          <?php echo $this->map['description'];?>
        </div>
        <?php 
				if(($this->map['tags']))
				{?>
        <div class="tags"><?php echo $this->map['tags'];?></div>
        
				<?php
				}
				?>
    </div><!--End .module-video-->
    <div class="cmt-fb">
      <br clear="all" />
      <script>
      (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) {return;}
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
      //js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1&appId=370201246402325";
      fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
      <div id="fb-root"></div>
      <div class="fb-comments" data-href="<?php echo $_SERVER['HTTP_HOST'];?>/trang-video/<?php echo $this->map['category_name_id'];?>/<?php echo $this->map['name_id'];?>.html" data-num-posts="10" data-width="100%"></div>
    </div>
  </div> <!-- End .col-left -->  
  <div class="col-md-4">
    <div class="other-video">
        <div class="title">
            <?php if(Url::iget('cap_dau_id')){?>
            <script>
              jQuery(document).ready(function(e) {
                jQuery('.header').hide();
                jQuery('.top-line').hide();								
                jQuery('.banner').hide();
                jQuery('.table-competition').hide();
                jQuery('.navbar').hide();
								jQuery('.logo-clb').hide();
                jQuery('.navinformation').hide();
                jQuery('.footer').hide();
              });
            </script>
            <h2>Video <?php echo $this->map['cap_dau'];?></h2>
            <span class="arrow"></span>
            <?php }else{?>
            <form name="VideoForm" method="post">
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
			
			
            <span class="arrow"></span>
            <?php }?>
        </div>
        <ul>
            <?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
            <li><a href="trang-video/<?php echo $this->map['items']['current']['category_name_id'];?>/<?php echo $this->map['items']['current']['name_id'];?>.html<?php echo Url::iget('cap_dau_id')?'?cap_dau_id='.Url::iget('cap_dau_id'):'';?>">
                <span class="img">
                <img src="<?php echo $this->map['items']['current']['image_url'];?>" width="120" height="80"/>
                </span>
                <p><?php echo $this->map['items']['current']['name'];?><span><?php echo $this->map['items']['current']['hitcount'];?> lượt xem</span></p>
            </a></li>
            
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
        </ul>
        <div class="view-more"><a target="_blank" href="trang-video/<?php echo $this->map['category_name_id'];?>">Xem thêm</a></div>
    </div><!--End .other-video-->
  </div>
</div>