<div>
<h1>Supply iGold for <strong><?php echo Url::get('user_id');?> / <?php echo $this->map['igold'];?> igold</strong></h1>
<hr>
<div>
	<form name="SupplyIgoldForm" method="post">
  	<label>iGold</label>
    <input  name="igold" id="igold" class="form-control" type ="text" value="<?php echo String::html_normalize(URL::get('igold'));?>">
    <input type="submit" value="  Save  " class="button">
    <input  name="user_id" id="user_id" type ="hidden" value="<?php echo String::html_normalize(URL::get('user_id'));?>">
  <input type="hidden" name="form_block_id" value="<?php echo isset(Module::$current->data)?Module::$current->data['id']:'';?>" />
			</form >
			
			
</div>
</div>