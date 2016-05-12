<div class="title-all list-clb">
	<nav class="tab">
    <ul>
    	 <?php
					if(isset($this->map['mua_giais']) and is_array($this->map['mua_giais']))
					{
						foreach($this->map['mua_giais'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['mua_giais']['current'] = &$item1;?>
      <li><a<?php echo (Session::get('mua_giai_id')==$this->map['mua_giais']['current']['id'])?' class="active"':''?> href="<?php echo Url::build_current(array('clb_id','vi_tri_id','mua_giai_id'=>$this->map['mua_giais']['current']['id']));?>"><?php echo $this->map['mua_giais']['current']['ten'];?></a></li>
      
							
						<?php
							}
						}
					unset($this->map['mua_giais']['current']);
					} ?>
    </ul>
  </nav>
  <h1>Danh sách câu lạc bộ</h1>
  <div class="list-player">
      <div class="search-player">
      		<form name="SsnhListCauThuForm" method="post">
          <div class="search-name">
            <input  name="ten" id="ten" placeholder="Nhập tên câu lạc bộ"/ type ="text" value="<?php echo String::html_normalize(URL::get('ten'));?>">
            <input type="submit" name="search" value="Tìm kiếm"/>
          </div>
          <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
      </div><!--End .search-player-->
      <table cellspacing="0" cellpadding="0">
          <tbody><tr class="accent2">
              <th title="Ảnh đại diện">Ảnh đại diện</th>
              <th title="Tên cầu thủ">Câu lạc bộ</th>
              <th title="Câu lạc bộ">Mã</th>
              <th title="Vị trí thi đấu">Ngày thành lập</th>
              <th title="Tổng điểm">Sân vận động</th>
          </tr>
          <?php
					if(isset($this->map['clbs']) and is_array($this->map['clbs']))
					{
						foreach($this->map['clbs'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['clbs']['current'] = &$item2;?>
          <tr>
              <td style="text-align: center;"><a href="clb/<?php echo $this->map['clbs']['current']['name_id'];?>.html"><img src="<?php echo $this->map['clbs']['current']['logo'];?>"/></a></td>
              <td style="text-align: left;"><span style="display: inline-block;width: 30%"></span><a href="clb/<?php echo $this->map['clbs']['current']['name_id'];?>.html"><?php echo $this->map['clbs']['current']['ten'];?></a></td>
              <td style="text-align: left;"><span style="display: inline-block;width: 30%"></span><a href="clb/<?php echo $this->map['clbs']['current']['name_id'];?>.html"><?php echo $this->map['clbs']['current']['ten_viet_tat'];?></a></td>
              <td style="text-align: left;"><span style="display: inline-block;width: 30%"></span><?php echo $this->map['clbs']['current']['ngay_thanh_lap'];?></td>
              <td style="text-align: left;"><span style="display: inline-block;width: 30%"></span><?php echo $this->map['clbs']['current']['san_van_dong'];?></td>              
          </tr>
          
							
						<?php
							}
						}
					unset($this->map['clbs']['current']);
					} ?>
      </tbody></table>
      <div class="paging"><?php echo $this->map['paging'];?></div>
  </div><!--End .list-player-->
</div>