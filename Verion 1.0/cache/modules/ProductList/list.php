<?php 
$page = (Portal::language() == 1)?'san-pham':'product';
?>
<section id="feature" class="transparent-bg">
    <div class="container">
      <div class="top-selection">
          <div class="col-md-8">
              <ul class="breadcrumb">
                  <li><a href=""><?php echo Portal::language('home');?></a></li>
                  <li><a href="<?php echo $page.'/';?>"><?php echo Portal::language('product');?></a></li>
                  <?php 
				if(($this->map['category_name_id']!='san-pham' and $this->map['category_name_id']!='product'))
				{?>
                  <li><a href="<?php echo $page.'/';?><?php echo $this->map['category_name_id'];?>/"><?php echo $this->map['category_name'];?></a></li>
                  
				<?php
				}
				?>
              </ul>
          </div>
          <div class="col-md-4">
              <div class="selection">
                  <div>
                    <form name="ProductListForm" action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
                      <select  name="order_by" id="order_by" onchange="ProductListForm.submit()" class="form-control"><?php
					if(isset($this->map['order_by_list']))
					{
						foreach($this->map['order_by_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('order_by').value = "<?php echo addslashes(URL::get('order_by',isset($this->map['order_by'])?$this->map['order_by']:''));?>";</script>
	</select>
                     <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
                  </div>
              </div>
          </div>
      </div><!--End .top-selection-->
      <div class="row">
            <h1><?php echo $this->map['category_name'];?></h1>
           <?php 
				if((!empty($this->map['items'])))
				{?>
           <div class="col-md-12 product-list">
           <div class="row">
           <?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
              <div class="col-md-6 product-item">
                  <div class="img">
                      <a href="<?php echo $page;?>/<?php echo $this->map['items']['current']['category_name_id'];?>/<?php echo $this->map['items']['current']['name_id'];?>.html"><img src="<?php echo $this->map['items']['current']['small_thumb_url'];?>"/></a>
                      <h3><a href="<?php echo $page;?>/<?php echo $this->map['items']['current']['category_name_id'];?>/<?php echo $this->map['items']['current']['name_id'];?>.html"><?php echo $this->map['items']['current']['name'];?></a></h3>
                  </div>
                  <div class="bottom-tt">
                      <div class="price">
                          <p>
                              <span class="publish"><?php echo Portal::language('price');?>: <?php echo $this->map['items']['current']['publish_price'];?> vnđ</span>
                              <span class="sale"><?php echo Portal::language('promotion_price');?>: <?php echo $this->map['items']['current']['price'];?> vnđ</span>
                          </p>
                      </div>
                      <div class="button-cart">
                          <a class="btn btn-warning" href="cart.html?product_id=<?php echo $this->map['items']['current']['id'];?>">Mua hàng</a>
                      </div>
                  </div>
              </div><!--End .product-item-->
           
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
          </div>   
         </div>
           <?php }else{ ?>
          <div class="col-md-12">
              <div class="product-item">
                <div class="no-match"><?php echo Portal::language('product_was_not_update');?></div>
              </div>
          </div>
          
				<?php
				}
				?>
          <div class="pt"><?php echo $this->map['paging'];?></div>
      </div><!--End .main-list-->
    </div><!--End .list-products-->
</section>    