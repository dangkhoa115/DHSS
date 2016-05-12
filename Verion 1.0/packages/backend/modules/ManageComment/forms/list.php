<?php
class ManageCommentForm extends Form
{
	function ManageCommentForm()
	{
		Form::Form('ManageCommentForm');
		$this->link_css('skins/default/css/cms.css');
	}
	function on_submit()
	{
	}
	function draw()
	{
		$cond = '1';
		$item_per_page = 10;
		if(Url::sget('page')=='manage_comment')
		{
			$table = 'news';
			$cond .= ' and comment.type="NEWS"';
		}
		else
		{
			$table = 'product';
			$cond .= ' and comment.type="PRODUCT"';
		}
		Url::get('item_id')?$cond.=' and comment.item_id ='. intval(Url::get('item_id')):'';
		$count = ManageCommentDB::get_total_comment($table,$cond);
		require_once 'packages/core/includes/utils/paging.php';
		$paging = paging($count['acount'],$item_per_page);
		$comments = ManageCommentDB::get_comments($item_per_page,$table,$cond);
		$this->parse_layout('list',array(
			'paging'=>$paging,
			'comments'=>$comments,
			'table'=>$table
		));
	}
}
?>