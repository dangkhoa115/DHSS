<script>
function printWebPart(tagid){
	if (tagid) {
		//build html for print page
        var html = "<HTML>\n<HEAD>\n"+
            jQuery("head").html()+
            "\n</HEAD>\n<BODY>\n"+
            jQuery("#"+tagid).html()+
            "\n</BODY>\n</HTML>";
        //open new window
        html = html.replace(/<script[^>]*>((.|[\r\n])*?)<\\?\/script>/ig, "");
		var printWP = window.open("","printWebPart");
        printWP.document.open();
        //insert content
        printWP.document.write(html);
        printWP.document.close();
        //open print dialog
        printWP.print();
    }
}
</script>
<div class="newsdetail-bound">
	<!--IF:cond(isset([[=name=]]))-->	
	<div class="newsdetail-detail-bound">
		<div class="newsdetail-detail-name"><?php echo strip_tags([[=name=]]); ?></div>
		<div class="newsdetail-detail-extra">
			<!--IF:show_time([[=show_time=]])-->
			<div class="newsdetail-detail-extra-time">
			<?php echo Portal::language(date('l',[[=time=]])).', '.date('d/m/Y',[[=time=]]); ?>
			</div>
			<!--/IF:show_time-->
			<div class="newsdetail-detail-extra-function">
				<!--IF:is_print([[=print_icon=]])-->
				<span onclick="printWebPart('<?php echo Module::block_id(); ?>')">
					<img style="height:12px; padding:0px 3px;" src="skins/default/images/news/detail_function_03.gif" />[[.Printer.]]
				</span>
				<!--/IF:is_print-->
				<!--IF:is_email([[=email_icon=]])-->
				<a href="mailto:?body=<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>">
					<img style="height:12px; margin:0px 3px;" src="skins/default/images/news/detail_function_05.gif" />[[.E_mail.]]
				</a>
				<!--/IF:is_email-->
			</div>
			<div class="clear"></div>
		</div>
		<!--IF:show_image([[=show_image=]])-->
		<div>
			<!--IF:exists_image(isset([[=image_url=]]) and file_exists([[=image_url=]]))-->
			<div class="newsdetail-detail-img"><img src="[[|image_url|]]" /></div>
			<!--/IF:exists_image-->
			<div class="newsdetail-detail-brief"><?php echo strip_tags([[=brief=]]);?></div>
			<div class="clear"></div>
		</div>
		<!--ELSE-->
		<div class="newsdetail-detail-brief">
			<?php echo strip_tags([[=brief=]]);?>
		</div>
		<!--/IF:show_image-->
		<div class="newsdetail-detail-description">[[|description|]]</div>
		<div class="clear"></div>
		<div align="right" class="admin-edit">
		<?php //if(User::can_edit(MODULE_MANAGECONTENT,CURRENT_CATEGORY)){?>
			[ <a style="color:#FF0000" href="<?php echo Url::build('news_admin',array('cmd'=>'edit','type'=>'NEWS','category_id'=>[[=category_id=]],'id'=>[[=id=]]))?>" target="_blank">[[.edit.]]</a> ]
		<?php //}?>
		<?php //if(User::can_delete(MODULE_MANAGECONTENT,CURRENT_CATEGORY)){?>
			<span>|</span>[ <a style="color:#FF0000" href="<?php echo Url::build('news_admin',array('cmd'=>'delete','type'=>'NEWS','category_id'=>[[=category_id=]],'id'=>[[=id=]]))?>" target="_blank">[[.delete.]]</a> ]
		<?php //}?>
		</div>
	</div>
	<!--ELSE-->
	<div class="newsdetail-detail-bound">
		<div class="not-exist-id">[[.id_dont_exist.]]</div>
	</div>
	<!--/IF:cond-->
</div>