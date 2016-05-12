<div class="survey-wrapper">
	<?php if($this->map['check']==1){?>
    <div class="title"><h3><?php echo $this->map['question_name'];?></h3></div>
    <div class="row">
        <table  width="100%"  cellpadding="2" cellspacing="2">			
            <?php
					if(isset($this->map['items']) and is_array($this->map['items']))
					{
						foreach($this->map['items'] as $key1=>&$item1)
						{
							if($key1!='current')
							{
								$this->map['items']['current'] = &$item1;?>
            <tr>
                <td width="100%" valign="top">
                <?php if ($this->map['type']==0)
                {?>
                    <input class="option" name="survey_id[]" id="survey_id_<?php echo $this->map['items']['current']['id'];?>" type="radio" value="<?php echo $this->map['items']['current']['id'];?>"> <label for="survey_id_<?php echo $this->map['items']['current']['id'];?>"><?php echo $this->map['items']['current']['name'];?></label>
                <?php }
                else
                {?>
                    <input class="option" name="survey_id[]" id="survey_id_<?php echo $this->map['items']['current']['id'];?>" type="checkbox" value="<?php echo $this->map['items']['current']['id'];?>"> <label for="survey_id_<?php echo $this->map['items']['current']['id'];?>"><?php echo $this->map['items']['current']['name'];?></label>
                <?php }?>
                </td>
            </tr>
            
							
						<?php
							}
						}
					unset($this->map['items']['current']);
					} ?>
        </table>
        <div class="button-wrapper">
            <input type="button" value=" <?php echo Portal::language('result');?> " onclick="ShowResult();" />&nbsp;&nbsp;
            <input type="button" value=" <?php echo Portal::language('vote');?> " onclick="ShowVote();" />
        </div><br clear="all">
        <?php }?>		
        <?php if(User::can_edit(false,ANY_CATEGORY)){?><?php echo $this->map['button'];?> | <a target="_blank" href="<?php echo Url::build('survey_admin');?>"><?php echo Portal::language('admin_survey');?></a><?php }?>
	</div>        
</div>
<script type="text/javascript">
function ShowResult(){
	window.open('<?php echo URL::build('survey');?>&cmd=view&id=<?php echo $this->map['survey_id'];?>','','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0, width=400, height=500, left = 100,top = 100');	
}
function ShowVote(){
	var selected = false;
	jQuery('.option').each(function(index, element) {
        if(jQuery(this).is(":checked")){
			selected = true;
		}
    });
	if(selected == true){
		window.open('<?php echo URL::build('survey');?>&cmd=view&id=<?php echo $this->map['survey_id'];?>&ids='+survey_list('survey_id[]'),'','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0, width=400, height=500, left = 10,top = 10');
		jQuery('.option').each(function(index, element) {
			jQuery(this).attr("checked",false);
		});
	}else{
		alert('Cho chúng tôi biết lựa chọn của bạn?');
	}
}
function survey_list(item_name)
{
	var arr = document.getElementsByName(item_name);
	if (arr.length)
	{
		st='';
		for (i=0;i<arr.length;i++)
		{
			if(arr[i].checked)
			{
				if(st!='')
				{
					st+=',';
				}
				st+=arr[i].value;
			}
		}
		return st;
	}
	else
	{
		if(arr.checked)
		{
			return arr.value;
		}
	}
	return '';
}
</script>