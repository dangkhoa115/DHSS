<?php
class PageContentForm extends Form
{
	function PageContentForm()
	{
		//khoi tao form
		Form::Form('pageContentForm');
		$this->link_css(Portal::template_css('default').'/css/system.css');
		
	}
	function draw_list($region, $items)
	{
		$i = 0;
		$last = false;
		foreach ($items as $key=>$item)
		{
			unset($this->all_blocks[$key]);
			if($i)
			{
				if($i>1)
				{
					$last['move_up'] = '<a href="'.Url::build_current(array('block_id'=>$last['id'],'move'=>'up','container_id')).'"><img src="skins/default/images/buttons/up_arrow.gif" alt="Move up"></a>';
				}
				$last['move_down'] = '<a href="'.Url::build('template_preview',array('block_id'=>$last['id'],'move'=>'down','container_id')).'"><img src="skins/default/images/buttons/down_arrow.gif" alt="Move down"></a>';
			}
			$i++;
			if($item['module_id']==514)
			{
				$items[$key]['href']=Url::build_current(array('id','container_id'=>$item['id']));
			}
			else
			{
				$items[$key]['href']=Url::build('block_setting',array('block_id'=>$item['id']));
			}
			$last = &$items[$key];
		}
		if($i>1)
		{
			$items[$key]['move_up']='<a href="'.Url::build('template_preview',array('id','block_id'=>$item['id'],'move'=>'up','container_id')).'"><img src="skins/default/images/buttons/up_arrow.gif" alt="Move up"></a>';
		}
		foreach($items as $id=>$item)
		{
			if($item['name'] == 'Content')
			{
				$items[$id]['regions'] = $this->get_content_regions($item);
			}
			else
			{
				$items[$id]['regions'] = $this->get_item_regions($item);
			}
		}
		$layout = new Layout('list_block',array('items'=>$items,'name'=>$region));
		ob_start();
		$layout->show();
		$text = ob_get_contents();
		ob_end_clean();
		return $text;
	}
	function draw()
	{
		$this->all_blocks = DB::fetch_all('
			select 
				block.id, 
				block.module_id, 
				block.page_id, 
				block.container_id, 
				block.region, 
				block.position, 
				block.name as block_name, 
				module.name, 
				module.path, 
				"" as move_up, 
				"" as move_down 
			from 
				`block` 
				inner join module on module.id=module_id 
			where 
				page_id='.$_REQUEST['id'].' 
			order by 
				position 
		');
		$this->get_layout();
		ob_start();
		$this->layout->pure_show();
		$regions = ob_get_contents();
		ob_end_clean();
		$this->get_new_modules();
		
		$this->get_packages();
		
		$this->parse_layout('page_content', $this->page+array(
			//'layout_id_list'=>String::get_list(DB::fetch_all('select id, name from layout order by name')),
			'package_id_list'=>array(''=>'')+$this->package_id_list,
			'layout_list'=>$this->get_all_layouts(),
			'regions'=>$regions,
			'new_modules'=>$this->new_modules,
			'packages'=>$this->packages
		));
	}
	function get_layout()
	{
		require_once 'packages/core/includes/portal/layout.php';
		$this->page_id = $_REQUEST['id'];
		DB::query('
			select 
				page.*,
				title_'.Portal::language().' as title
			from
				page
			where
				id='.$this->page_id
		);
		$this->page = DB::fetch();
	
		$this->layout_text = file_get_contents($this->page['layout']);
		
		$this->get_regions();
		$this->layout = new Layout(false, $this->regions, $this->layout_text.($this->all_blocks?'<p><h1>Undefined region modules</h1>[[|undefined_regions|]]</p>':''));
		$_REQUEST['layout'] = $this->page['layout'];
	}
	function get_regions()
	{
		$this->regions = array();
		if(
			preg_match_all('/\[\[\|([^\|]+)\|\]\]/i', $this->layout_text, $region_matchs,PREG_SET_ORDER))
		{
			foreach($region_matchs as $region)
			{
				$modules = DB::fetch_all('
					select 
						block.id, 
						block.module_id, 
						block.page_id, 
						block.container_id, 
						block.region, 
						block.position, 
						block.name as block_name,
						module.name, 
						module.path, 
						"" as move_up, 
						"" as move_down 
					from 
						`block` 
						inner join module on module.id=module_id 
					where 
						page_id='.$this->page_id.' 
						and region="'.$region[1].'" 
						and container_id=0 
					order by 
						position
				');
				$this->regions[$region[1]] = $this->draw_list($region[1], $modules);
			}
		}
		$this->regions['undefined_regions'] = $this->draw_list('undefined_regions', $this->all_blocks);
	}
	function get_packages()
	{
		$this->packages = DB::fetch_all('select * from package order by structure_id');
		$this->package_id_list = String::get_list($this->packages);
		
		foreach($this->packages as $package)
		{
			$this->packages[$package['id']]['modules'] = array();
		}
		$modules = DB::fetch_all('select id, name,package_id from module order by name');
		foreach($modules as $module)
		{
			if(isset($this->packages[$module['package_id']]))
			{
				$this->packages[$module['package_id']]['modules'][$module['id']] = $module;
			}
		}
	}
	function get_new_modules()
	{
		DB::query('
			(select
				*
			from 
				module
			where 
				name like "Footer" 
				or name like "Navigation" 
				or name like "ColumnLayout" 
				or name like "TabLayout" 
				or name like "Frame" 
				or name like "Banner" 
				or name like "HTML"
				or name like "Content"
				or name like "Advertisment"
				or name like "SignIn" 
			order by 
				id desc
			limit 0,16
			)
			union
			(select
				*
			from 
				module
			order by 
				id desc
			limit 0,5
			)
		');
		$this->new_modules = DB::fetch_all();
	}
	function get_item_regions($item)
	{
		if(!is_dir($item['path'].'layouts'))
		{
			return '';
		}
		$dir = opendir($item['path'].'layouts');
		$regions = array();
		$layout = '';
		while($file=readdir($dir))
		{
			if(is_file($item['path'].'layouts/'.$file))
			{
				if($file == 'layout.php')
				{
					$current_module = &Module::$current;
					$row = DB::select('block',$item['id']);
					$row['settings'] = String::get_list(DB::fetch_all('select setting_id as id, value as name from block_setting where block_id="'.$item['id'].'"'),'name');
					$row['module'] = DB::select('module',$row['module_id']);
					$object = new Module($row);
					ob_start();
					eval('?>'.file_get_contents($item['path'].'layouts/'.$file).'<?php ');
					$layout = ob_get_clean();
					Module::$current = &$current_module;
					$text = $layout;
				}
				else
				{
					$text = file_get_contents($item['path'].'layouts/'.$file);
				}
				if(preg_match_all('/\[\[--([^\-\]]+)--\]\]/i', $text, $patterns))
				{
					foreach($patterns[1] as $pattern)
					{
						if(!isset($regions[$pattern]))
						{
							$regions[$pattern] = '';
							$regions[$pattern] .= '<table width="100%"  border="0" cellpadding="3" bgcolor="#FFFFFF" 
				ondragenter="event.returnValue = false;event.dataTransfer.dropEffect = \'copy\';" 
				ondrop="if(!block_moved){event.returnValue = false;event.dataTransfer.dropEffect = \'copy\';if(event.dataTransfer.getData(\'Text\')<0){ location = \''.Url::build_current(array('id','container_id'=>$item['id'])).'&region='.$pattern.'&module_id=\'+(-event.dataTransfer.getData(\'Text\'));}else {location = \''.Url::build_current(array('id','container_id'=>$item['id'],'cmd'=>'move_block')).'&region='.$pattern.'&block_id=\'+event.dataTransfer.getData(\'Text\');}; block_moved = true;}"
				ondragover="event.returnValue = false;event.dataTransfer.dropEffect = \'copy\';">
		  <tr valign="top">
			<td><fieldset><legend>'.$pattern.'</legend><br><br><table cellpadding="5px">';
							$modules = DB::fetch_all('
								select 
									block.*, 
									module.name, 
									module.path, 	
									"" as move_up, 
									"" as move_down 
								from 
									`block` 
									inner join module on module.id=module_id 
								where 
									page_id='.$this->page_id.' 
									and region="'.$pattern.'" 
									and container_id='.$item['id'].' 
								order by 
									position
							');
							foreach($modules as $module)
							{
								unset($this->all_blocks[$module['id']]);
								$move_up = '<a href="'.Url::build_current(array('block_id'=>$module['id'],'move'=>'up','container_id'=>$item['id'])).'"><img src="skins/default/images/buttons/up_arrow.gif" alt="Move up"></a>';
								$move_down = '<a href="'.Url::build_current(array('block_id'=>$module['id'],'move'=>'down','container_id'=>$item['id'])).'"><img src="skins/default/images/buttons/down_arrow.gif" alt="Move down"></a>';
								$href = Url::build('block_setting',array('block_id'=>$module['id']));
								$regions[$pattern] .= '<tr valign="top" '.'>
					  <td height="19" valign="top" nowrap><strong><font color="black">&raquo;&nbsp;&nbsp;</font></strong></td>
					  <td align="left" valign="top" nowrap><strong><a href="'.$href.'" ondragstart="event.dataTransfer.setData(\'Text\', \''.$module['id'].'\');event.dataTransfer.effectAllowed = \'copy\'; ">'.$module['name'].'</a>&nbsp;&nbsp;&nbsp;</strong></td>
					  <td valign="top"><a href="'.URL::build_current(array('cmd'=>'delete')).'&id='.$module['id'].'"><strong><img src="skins/default/images/buttons/delete.gif" width="12" height="12" border="0" ></strong></a></td>
					  <td valign="top"><strong>'.$move_up.'</strong></td>
					  <td valign="top"><strong>'.$move_down.'</strong></td>
					  
					</tr>';
								$regions[$pattern] .= '<tr><td colspan="5">'.$this->get_item_regions($module).'</td></tr>';
								
							}
							$regions[$pattern] .= '</table><a href="'.Url::build('module',array('page_id'=>$_REQUEST['id'],'container_id'=>$item['id'])).'&region='.$pattern.'">[[.Add_block.]]</a></fieldset></td></tr></table>';
						}
					}
				}
			}
		}
		
		closedir($dir);
		if($layout)
		{
			foreach($regions as $name=>$value)
			{
				$layout = str_replace('[[--'.$name.'--]]',$value,$layout);
			}
		}
		else
		{
			$layout = join('',$regions);
		}
		return $layout;
	}
	function get_content_regions($item)
	{
		$list_layout_template = DB::fetch('select value from block_setting where block_id='.$item['id'].' and setting_id="5458_list_layout_template"','value');
		$list_detail_template = DB::fetch('select value from block_setting where block_id='.$item['id'].' and setting_id="5458_detail_layout_template"','value');
		$content_layout = '';
		$layout = '';
		if($list_layout_template and file_exists($list_layout_template.'/layout.php'))
		{
			$content_layout .= file_get_contents($list_layout_template.'/layout.php');
			if(file_exists($list_layout_template.'/region_layout.php'))
			{
				ob_start();
				eval('?>'.file_get_contents($list_layout_template.'/region_layout.php').'<?php ');
				$layout = ob_get_clean();
			}
		}
		if($list_detail_template and file_exists($list_detail_template.'/layout.php'))
		{
			$content_layout .= file_get_contents($list_detail_template.'/layout.php');
			if(file_exists($list_detail_template.'/region_layout.php'))
			{
				ob_start();
				eval('?>'.file_get_contents($list_detail_template.'/region_layout.php').'<?php ');
				$layout = ob_get_clean();
			}
		}
		
		$regions = array();
		if(preg_match_all('/\[\[--([^\-\]]+)--\]\]/i', $content_layout, $patterns))
		{
			foreach($patterns[1] as $pattern)
			{
				if(!isset($regions[$pattern]))
				{
					$regions[$pattern] = '';
					$regions[$pattern] .= '<table width="100%"  border="0" cellpadding="3" bgcolor="#FFFFFF" 
		ondragenter="event.returnValue = false;event.dataTransfer.dropEffect = \'copy\';" 
		ondrop="if(!block_moved){event.returnValue = false;event.dataTransfer.dropEffect = \'copy\';if(event.dataTransfer.getData(\'Text\')<0){ location = \''.Url::build_current(array('id','container_id'=>$item['id'])).'&region='.$pattern.'&module_id=\'+(-event.dataTransfer.getData(\'Text\'));}else {location = \''.Url::build_current(array('id','container_id'=>$item['id'],'cmd'=>'move_block')).'&region='.$pattern.'&block_id=\'+event.dataTransfer.getData(\'Text\');}; block_moved = true;}"
		ondragover="event.returnValue = false;event.dataTransfer.dropEffect = \'copy\';">
  <tr valign="top">
	<td><fieldset><legend>'.$pattern.'</legend><br><br><table cellpadding="5px">';
					$modules = DB::fetch_all('
						select 
							block.*, 
							module.name, 
							module.path, 
							"" as move_up, 
							"" as move_down 
						from 
							`block` 
							inner join module on module.id=module_id 
						where 
							page_id='.$this->page_id.' 
							and region="'.$pattern.'" 
							and container_id='.$item['id'].' 
						order by 
							position
					');
					foreach($modules as $module)
					{
						unset($this->all_blocks[$module['id']]);
						$move_up = '<a href="'.Url::build_current(array('block_id'=>$module['id'],'move'=>'up','container_id'=>$item['id'])).'"><img src="skins/default/images/buttons/up_arrow.gif" alt="Move up"></a>';
						$move_down = '<a href="'.Url::build_current(array('block_id'=>$module['id'],'move'=>'down','container_id'=>$item['id'])).'"><img src="skins/default/images/buttons/down_arrow.gif" alt="Move down"></a>';
						$href = Url::build('block_setting',array('block_id'=>$module['id']));
						$regions[$pattern] .= '<tr valign="top" '.'>
			  <td height="19" valign="top" nowrap><strong><font color="black">&raquo;&nbsp;&nbsp;</font></strong></td>
			  <td align="left" valign="top" nowrap><strong><a href="'.$href.'" ondragstart="event.dataTransfer.setData(\'Text\', \''.$module['id'].'\');event.dataTransfer.effectAllowed = \'copy\'; ">'.$module['name'].'</a>&nbsp;&nbsp;&nbsp;</strong></td>
			  <td valign="top"><a href="'.URL::build_current(array('cmd'=>'delete')).'&id='.$module['id'].'"><strong><img src="skins/default/images/buttons/delete.gif" width="12" height="12" border="0" ></strong></a></td>
			  <td valign="top"><strong>'.$move_up.'</strong></td>
			  <td valign="top"><strong>'.$move_down.'</strong></td>
			  <td width="100%">&nbsp;</td>
			</tr>';
						$regions[$pattern] .= '<tr><td colspan="6">'.$this->get_item_regions($module).'</td></tr>';
						
					}
					$regions[$pattern] .= '</table><a href="'.Url::build('module',array('page_id'=>$_REQUEST['id'],'container_id'=>$item['id'])).'&region='.$pattern.'">[[.Add_block.]]</a></fieldset></td></tr></table>';
				}
			}
		}		
		if($layout)
		{
			foreach($regions as $name=>$value)
			{
				$layout = str_replace('[[--'.$name.'--]]',$value,$layout);
			}
		}
		else
		{
			$layout = join('',$regions);
		}
		return $layout;
	}
	function get_all_layouts()
	{
		$layouts = array();
		if(is_dir(TEMPLATE_DIR))
		{
			$dir = opendir(TEMPLATE_DIR);
			while($file = readdir($dir))
			{
				if($file != '.' and $file != '..' and is_file(TEMPLATE_DIR.'/'.$file))
				{
					$layouts[TEMPLATE_DIR.'/'.$file] = TEMPLATE_DIR.'/'.substr($file, 0, strrpos($file,'.'));
				}
			}
			closedir($dir);
		}
		return $layouts;
	}
}
?>