<?php
/******************************
COPY RIGHT BY Catbeloved - Framework
WRITTEN BY catbeloved, khoand
******************************/
function combobox_indent(
	&$items, $spacer=' - - '
){
	$space = '';
	$last_id = 1;
	$last=false;
	foreach($items as $key=>$item){
		$level = IDStructure::level($item['structure_id']);
		$items[$key]['indent'] = '';
		$items[$key]['_grouping']=0;
		$items[$key]['level'] = $level;
		for($i=1;$i<$level;$i++){
			$items[$key]['indent'].= $spacer;
		}
		if($level==0){
			$items[$key]['_grouping']=1;
			$items[$key]['indent']='';
		}else{
			if(IDStructure::level($last['structure_id']) != 0 and IDStructure::level($last['structure_id']) != $level){
				$last['_grouping'] = $level - IDStructure::level($last['structure_id']);
			}
			$last = &$items[$key];
		}
		$items[$key]['name'] = $items[$key]['indent'].$item['name'];
	}
	if($last){
		$last['_grouping']=1-IDStructure::level($last['structure_id']);
	}
}
function category_indent(
	&$items, 
	$space = '<img src="skins/default/images/spacer.gif" width="15"/>',
	$level0 = -1,
	$tree_last = -1,
	$tree_next = -1,
	$move = true
){
	if($level0==-1)
	{
		$level0 = '<img src="skins/default/images/node.gif">';
	}
	if($tree_last == -1)
	{
		$tree_last = '<img src="skins/default/images/tree_last.gif">';
	}
	if($tree_next == -1)
	{
		$tree_next = '<img src="skins/default/images/tree_next.gif">';
	}
	$last_id = 1;
	$last=false;
	foreach($items as $key=>$item)
	{
		$level = IDStructure::level($item['structure_id']);
		if($space){
			$items[$key]['name']=str_pad($space,$level + 5,'--',STR_PAD_LEFT).$item['name'];
		}
		$items[$key]['indent']=' -- ';
		$items[$key]['_grouping']=0;
		$items[$key]['level']=$level;
		for($i=1;$i<$level;$i++)
		{
			$items[$key]['indent'].= ' - - ';
		}
		if($level==0)
		{
			$items[$key]['indent_image']=$level0;
			$items[$key]['_grouping']=1;
			$items[$key]['indent']=$space;
		}
		else
		{
			/*if($last['code'] =='133111')
			{
				echo IDStructure::level($last['structure_id']).' '.$level.' '.$item['structure_id'].' '.$last['structure_id'].'<br>';
			}*/
			if(IDStructure::level($last['structure_id'])!=0 and IDStructure::level($last['structure_id'])!=$level)
			{
				$last['indent_image']=$tree_last;
				$last['_grouping']=$level-IDStructure::level($last['structure_id']);
			}
			else
			{
				$last['indent_image']=$tree_next;
			}
			$last = &$items[$key];
		}
		
		if($move)
		{
			if ($level==0)
			{
				$items[$key]['move_up']='';
				$items[$key]['move_down']='&nbsp;';
			}
			else
			{
				$items[$key]['move_up']='<a href="'.Url::build_current(array('cmd'=>'move_up','id'=>$item['id'],'countries')).'"><img src="skins/default/images/buttons/up_arrow.gif" alt="Move up"></a>';
				$items[$key]['move_down']='<a href="'.Url::build_current(array('cmd'=>'move_down','id'=>$item['id'],'countries')).'"><img src="skins/default/images/buttons/down_arrow.gif" alt="Move down"></a>';
			}
		}
	}
	if($last)
	{
		$last['_grouping']=1-IDStructure::level($last['structure_id']);
		$last['indent_image']=$tree_last;
	}
	
}
function set_ul_structure($arr,$type=false,$block_id=false,$level=false){
	$st = '';
	if($level==false)
	{
		$level = 1;
	}
	$i = 1;
	$end = false;
	foreach($arr as $value)
	{
		$selected = false;
		if(Url::get('category_id')==$value['id'])
		{
			$selected = true;
		}
		if($i==sizeof($arr))
		{
			$end = true;
		}
		$sub_level = $level+1;
		if(isset($value['url']) and $value['url'])
		{
			$href = $value['url'];
		}
		else
		if(isset($value['href']) and $value['href'])
		{
			$href = $value['href'];
		}
		else if(Module::get_setting('url'))
		{
			if(Module::get_setting('type_params'))
			{
				$href = Url::build(Module::get_setting('url'),array(Module::get_setting('type_params')=>$value['type'],'category_id'=>$value['id']),Module::get_setting('use_rewrite_url'));
			}
			else
			{
				$href = Url::build(Module::get_setting('url'),array('category_id'=>$value['id']),Module::get_setting('use_rewrite_url'));
			}
		}
		else
		{
			if(isset($value['url']) and $value['url'])
			{
				$href = $value['url'];
			}
			else
			if(isset($value['href']) and $value['href'])
			{
				$href = $value['href'];
			}
			else
			{
				if($type=='ajax')
				{
					$href = '#';
				}
				else if(isset($value['type']))				
				{
					//$href = Url::build('test',array(Module::get_setting('category_id_param','category_id')=>$value['id']));
					$href = Url::build(strtolower($value['type']),array('category_id'=>$value['id']),Module::get_setting('use_rewrite_url'));
				}
				else
				{
					$href = Url::build_current(array('category_id'=>$value['id']),Module::get_setting('use_rewrite_url'));
				}
			}
		}
		if(Module::get_setting('extra_param'))
		{
			$href.= '&amp;'.Module::get_setting('extra_param');
		}
		if(isset($value['level']))
		{
			$st .= '<LI><a class="'.(($level==1)?'level_'.$value['level'].'':'').' '.(($selected)?'level_'.$value['level'].'_selected':'').'" href="'.$href.'" '.(($type=='ajax')?' onclick="ItemList.blockId = '.$block_id.';Object.extend(ItemList.params,{\'category_id\':'.$value['id'].'});ItemList.GetContent();return false;"':'').'><span>'.strip_tags($value['name']).'</span></a>';
		}
		else if(Module::get_setting('category_type')=='vertical')
		{
			$st .= '<LI><a class="'.(($level==1)?'level_1':'').' '.(($selected)?'selected':'').'" href="'.$href.'" '.(($type=='ajax')?' onclick="ItemList.blockId = '.$block_id.';Object.extend(ItemList.params,{\'category_id\':'.$value['id'].'});ItemList.GetContent();return false;"':'').'><span>'.strip_tags($value['name']).'</span></a>';		
		}
		else
		{
			$st .= '<LI><a '.($end?' style="border-bottom:0;"':'').'  class="'.(($level==1)?'head'.Module::get_setting('category_type').'':'').' '.(($selected)?'selected':'').'" href="'.$href.'" '.(($type=='ajax')?' onclick="ItemList.blockId = '.$block_id.';Object.extend(ItemList.params,{\'category_id\':'.$value['id'].'});ItemList.GetContent();return false;"':'').'><span>'.strip_tags($value['name']).'</span></a>';
		}
		if(isset($value['childs']))
		{
			if($childs = $value['childs'])
			//DB::fetch_all('select id,type,url,structure_id,name_'.Portal::language().' as name from portal_category where is_visible=1 and '.IDStructure::direct_child_cond($value['structure_id']).' order by structure_id')
			{
				$st  .= '<UL>';
				$st .= set_ul_structure($childs,$type,$block_id,$sub_level);
				$st  .= '</UL>';				
			}
		}
		$st  .= '</LI>';
		$i++;
	}
	return $st ;
}
function get_ul_structure(){	
	$file  = fopen('cache/category.php','r');
}
function make_structure_id_from_level_array(&$items, $level=1, $structure_id=false){
	if(!$structure_id)
	{
		$structure_id = number_format(ID_ROOT + ID_ROOT/100,0,'','');
	}
	while($current = current($items))
	{
		if($current['level'] == $level)
		{
			$items[$current['id']]['structure_id'] = $structure_id;
			next($items);
			make_structure_id_from_level_array($items, $level+1, number_format($structure_id+$structure_id/100,0,'',''));
			$structure_id = IDStructure::next($structure_id);
		}
		else
		{
			break;
		}
	}
}
function make_jquery_tree($category,$path,$type=false,$block_id=false,$level=false){
	$st = '';
	if($level==false)
	{
		$level = 1;
	}
	if($category)
	{
		foreach($category as $key=>$value)
		{
			$sub_level = $level+1;
			if(isset($path[$key]))
			{
				$st.= '<li><span class="folder"><a href="'.Url::build('manage_content',array('category_id'=>$key,'type'=>$value['type'],'cmd'=>'list')).'" >'.$value['name'].'</a></span>';
			}
			else
			{
				$st.= '<li class="closed"><span class="folder"><a href="'.Url::build('manage_content',array('category_id'=>$key,'type'=>$value['type'],'cmd'=>'list')).'" >'.$value['name'].'</a></span>';
			}
			if(isset($value['childs']))
			{
				if($childs = $value['childs'])
				//DB::fetch_all('select id,type,url,structure_id,name_'.Portal::language().' as name from portal_category where is_visible=1 and '.IDStructure::direct_child_cond($value['structure_id']).' order by structure_id')
				{
					$st .= '<UL>';
					$st .= make_jquery_tree($childs,$type,$block_id,$sub_level);
					$st .= '</UL>';				
				}
			}
			$st  .= '</LI>';			
		}
		return $st ;
	}
}
function convert_item_cat_to_ul($category,$block_id=false,$level=false,$child=true){
	$st = '';
	if($level==false){
		$level = 1;
	}
	if($category){
		foreach($category as $key=>$value){
			$sub_level = $level+1;
			$url = $value['url']?$value['url']:'tin-tuc/'.$value['name_id'].'';
			if($child == true and $childs = DB::fetch_all('select id,structure_id,name_'.Portal::language().' as name,name_id,url from category where category.status<>"HIDE" AND type="'.$value['type'].'" AND '.IDStructure::direct_child_cond($value['structure_id']).' order by structure_id')){
				$st.= '<li class="dropdown"'.(($level==1)?' page="'.$value['name_id'].'"':'').'>';
				$st.= (($level==1)?'<span class="dc-mega-icon"></span>':''.(($level==2)?'<span class="dc-mega-icon-2"></span>':'').'').'<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'.$value['name'].'<span class="caret"></span></a>';
				if($level >= 2){
					$st .= ' <ul class="dropdown-menu" role="menu">';
				}else{
					$st .= ' <ul class="dropdown-menu" role="menu">';
				}
				$st .= convert_item_cat_to_ul($childs,$block_id,$sub_level);
				if($level >=2 ){
					$st .= ' </ul>';
				}else{
					$st .= ' </ul>';
				}			
			}else{
				$st.= '<li'.(($level==1)?' page="'.$value['name_id'].'"':'').'><a href="'.$url.'" >'.$value['name'].'</a>';
			}
			$st  .= '</li>';			
		}
		return $st ;
	}
}
?>