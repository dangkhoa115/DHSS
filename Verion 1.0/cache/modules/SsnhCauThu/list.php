<div class="title-all">
  <h1>Danh sách cầu thủ</h1>
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
  <div class="list-player">
      <div class="row search-player">
      		<form name="SsnhListCauThuForm" method="get" action="cau-thu">
          <div class="col-md-5 col-xs-12">
          	<div class="col-md-8">
            <input  name="ten_cau_thu" id="ten_cau_thu" placeholder="Nhập tên cầu thủ" class="form-control"/ type ="text" value="<?php echo String::html_normalize(URL::get('ten_cau_thu'));?>">
            </div>
            <div class="col-md-4">
            <input type="submit" name="search" value="Tìm kiếm" class="btn btn-warning"/>
            </div>
          </div>
          <div class="col-md-7 col-xs-12 view-style">
          	<select  name="vong_dau_id" id="vong_dau_id" onchange="SsnhListCauThuForm.submit()" class="form-control"><?php
					if(isset($this->map['vong_dau_id_list']))
					{
						foreach($this->map['vong_dau_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('vong_dau_id').value = "<?php echo addslashes(URL::get('vong_dau_id',isset($this->map['vong_dau_id'])?$this->map['vong_dau_id']:''));?>";</script>
	</select>
            <select  name="vi_tri_id" id="vi_tri_id" onchange="SsnhListCauThuForm.submit()" class="form-control"><?php
					if(isset($this->map['vi_tri_id_list']))
					{
						foreach($this->map['vi_tri_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('vi_tri_id').value = "<?php echo addslashes(URL::get('vi_tri_id',isset($this->map['vi_tri_id'])?$this->map['vi_tri_id']:''));?>";</script>
	</select>
            <select  name="clb_id" id="clb_id" onchange="SsnhListCauThuForm.submit()" class="form-control"><?php
					if(isset($this->map['clb_id_list']))
					{
						foreach($this->map['clb_id_list'] as $key=>$value)
						{
							echo '<option value="'.$key.'"';
							echo '>'.$value.'</option>';
							
						}
					}
					?><script type="text/javascript">getId('clb_id').value = "<?php echo addslashes(URL::get('clb_id',isset($this->map['clb_id'])?$this->map['clb_id']:''));?>";</script>
	</select>
          </div><!--End .view-style-->
          <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
      </div><!--End .search-player-->
      <table cellspacing="0" cellpadding="0">
          <tbody><tr class="accent2">
              <th title="Ảnh đại diện">Ảnh đại diện</th>
              <th title="Tên cầu thủ">Tên cầu thủ</th>
              <th title="Câu lạc bộ">Câu lạc bộ</th>
              <th title="Vị trí thi đấu">Vị trí thi đấu</th>
              <th title="Tổng điểm">Tổng điểm</th>
              <?php 
				if((Url::get('vong_dau_id')))
				{?>
              <th>Điểm <?php echo $this->map['vong_dau'];?></th>
              
				<?php
				}
				?>
              <th></th>
          </tr>
          <?php
					if(isset($this->map['cau_thus']) and is_array($this->map['cau_thus']))
					{
						foreach($this->map['cau_thus'] as $key2=>&$item2)
						{
							if($key2!='current')
							{
								$this->map['cau_thus']['current'] = &$item2;?>
          <tr>
              <td><a href="cau-thu/<?php echo $this->map['cau_thus']['current']['name_id'];?>-id<?php echo $this->map['cau_thus']['current']['id'];?>.html" title="<?php echo $this->map['cau_thus']['current']['ten'];?>" class="img"><img src="<?php echo $this->map['cau_thus']['current']['anh_dai_dien'];?>" alt="<?php echo $this->map['cau_thus']['current']['ten'];?>"/></a></td>
              <td><a href="cau-thu/<?php echo $this->map['cau_thus']['current']['name_id'];?>-id<?php echo $this->map['cau_thus']['current']['id'];?>.html" title="<?php echo $this->map['cau_thus']['current']['ten'];?>"><?php echo $this->map['cau_thus']['current']['ten'];?></a></td>
              <td><?php echo $this->map['cau_thus']['current']['clb'];?></td>
              <td><?php echo $this->map['cau_thus']['current']['vi_tri'];?></td>
              <td><?php echo $this->map['cau_thus']['current']['tong_diem'];?></td>
              <?php 
				if((Url::get('vong_dau_id')))
				{?>
              <td><span style="color: red;"><?php echo $this->map['cau_thus']['current']['diem_vong_hien_tai'];?></span></td>
              
				<?php
				}
				?>
              <td><a href="cau-thu/<?php echo $this->map['cau_thus']['current']['name_id'];?>-id<?php echo $this->map['cau_thus']['current']['id'];?>.html" class="btn btn-default">Chi tiết</a></td>
          </tr>
          
							
						<?php
							}
						}
					unset($this->map['cau_thus']['current']);
					} ?>
      </tbody></table>
      <div class="paging"><?php echo $this->map['paging'];?></div>
  </div><!--End .list-player-->
</div>