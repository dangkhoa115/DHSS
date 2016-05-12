 <div class="header-blue">
    <span class="title">Tin tức</span>
    <ul class="brands">
        <?php
					if(isset($this->map['categories']) and is_array($this->map['categories']))
					{
						foreach($this->map['categories'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['categories']['current'] = &$item1;?>
        <li><a href="trang-tin/<?php echo $this->map['categories']['current']['name_id'];?>.html"><?php echo $this->map['categories']['current']['name'];?></a></li>
        
							
						<?php
							}
						}
					unset($this->map['categories']['current']);
					} ?>
    </ul>
</div><!--End .header-blue-->