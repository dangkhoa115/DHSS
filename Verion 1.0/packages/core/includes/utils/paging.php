<?php
/******************************
COPY RIGHT BY Catbeloved - Framework
WRITTEN BY catbeloved
******************************/		
	function paging($totalitem, $itemperpage, $numpageshow=10,$smart=false,$page_name='page_no',$params=array(),$page_label='Trang',$archo=false){
		$st = '';
		$new_row=array();
		if($params and is_array($params)){
			foreach($params  as $key=>$value){
				if(Url::get($value)!=''){
					$new_row[$value]=Url::get($value);
				}				
			}
		}
		$totalpage = ceil($totalitem/$itemperpage);
		if ($totalpage<2){
			return;
		}
		$currentpage=page_no($page_name);
		$currentpage=round($currentpage);
		if($currentpage<=0 ||$currentpage>$totalpage){
			$currentpage=1;
		}
		if($currentpage>($numpageshow/2)){
			$startpage = $currentpage-floor($numpageshow/2);
			if($totalpage-$startpage<$numpageshow){
				$startpage=$totalpage-$numpageshow+1;
			}
		}else{
			$startpage=1;
		}
		if($startpage<1){
			$startpage=1;
		}
		//Trang hien thoi
		$st .= '<ul class="pager">';//<span style="padding:5px;">'.$page_label.' </span>
		//Link den trang truoc
		if($currentpage>$startpage){
			$st .= '<li><a href = "'.Url::build_current($new_row+array($page_name=>$currentpage-1),$smart,$archo).'" >';
			$st .= '<<';
			$st .= '</a></li>';
		}
		//Danh sach cac trang
		$st .= '';
		if($startpage>1){
			$st .= '<li><a href= "'.Url::build_current($new_row+array($page_name=>'1'),$smart,$archo).' ">1</a></li>';		
			if($startpage>2){
				$st .= '...</a></li>';//
			}
		}
		for($i=$startpage; $i<=$startpage+$numpageshow-1&&$i<=$totalpage; $i++){
			if($i!=$startpage){
				$st .= '';//
			}
			if($i==$currentpage){
				if($i>1){
					$st .='';
				}
				$st .= '<li><a href="#" onclick="return false" class="current">'.$i.'</a></li>';
			}else{
				if($i>1){
					$st .='';	
				}
				$st .= '<li><a href= "'.Url::build_current($new_row+array($page_name=>$i),$smart,$archo).' ">'.$i.'</a></li>';
			}
		}
		if($i==$totalpage){
			$st .= '<li><a href= "'.Url::build_current($new_row+array($page_name=>$totalpage),$smart,$archo).' ">'.$totalpage.'</a></li>';//
		}
		else
		if($i<$totalpage){
			$st .= '<li><a>...</a></li><li><a href= "'.Url::build_current($new_row+array($page_name=>$totalpage),$smart,$archo).' ">'.$totalpage.'</a></li>';//
		}
		$st .= '';
		//Trang sau
		if($currentpage<$totalpage){
			$st .= '<li><a href = "'.Url::build_current($new_row+array($page_name=>$currentpage+1),$smart,$archo).'">';
			$st .= '>>';
			$st .= '</a></li>';
		}
		$st .= '</ul>';
		return $st.'';
	}
	function page_ajax($totalitem,$itemperpage,$reference = '',$numpageshow = 7,$page_name = 'page_no',$page_label = ''){
		$ref = '';
		if($reference){
			if(is_array($reference)){
				foreach($reference  as $key=>$value){
					if(Url::get($value)!=''){
						$ref.='&'.$value.'='.Url::get($value);
					}				
				}
			}else{
				$ref = '&'.$reference;
			}
		}
		$st = '';
		$totalpage = ceil($totalitem/$itemperpage);
		if ($totalpage<2){
			return $st;
		}
		$st .= '<div class="page-ajax-bound">';
		$currentpage=page_no($page_name);
		if($currentpage<=0 ||$currentpage>$totalpage){
			$currentpage=1;
		}
		$st .= '<span class="page-ajax-label">'.$page_label.' </span>';	
	
		$startpage = $currentpage - floor($numpageshow/2);
		if($startpage < 1) {
			$startpage  = 1;
		}
		$endpage = $startpage+ $numpageshow-1;
		if($endpage > $totalpage){
			$endpage = $totalpage;
			if(($endpage -$numpageshow) > 1){
				$startpage = $endpage -$numpageshow+1;				
			}
		}
		if($startpage == 2){ $startpage = 1; }
		if($endpage == ($totalpage-1)){ $endpage = $totalpage; }
		if($currentpage > $startpage){
			$st.= '<span alt="'.Portal::language('preview_page').'" class="page-ajax-preview" onclick=\'load_ajax("page_no='.($currentpage-1).$ref.'",'.Module::$current->data['id'].')\'>'.Portal::language('prev').'</span>';
		}else{
			$st.= '<span alt="'.Portal::language('preview_page').'" class="page-ajax-preview-block">'.Portal::language('prev').'</span>';
		}
		if($startpage > 2){
			$st.= '<span id="1" onclick=\'load_ajax("page_no=1'.$ref.'",'.Module::$current->data['id'].')\' class="page-ajax-normal">1</span><span>....</span>';
		}
		for($i = $startpage; $i<= $endpage; $i++){
			if($i==$currentpage){
				$st.= '<span id="'.$i.'" onclick=\'load_ajax("page_no='.$i.$ref.'",'.Module::$current->data['id'].')\' class="page-ajax-active">'.$i.'</span>';
			}else{
				$st.= '<span id="'.$i.'" onclick=\'load_ajax("page_no='.$i.$ref.'",'.Module::$current->data['id'].')\' class="page-ajax-normal">'.$i.'</span>';
			}
		}
		if($endpage < ($totalpage - 1)){
			$st.= '<span>....</span><span id="'.$totalpage.'" onclick=\'load_ajax("page_no='.$totalpage.$ref.'",'.Module::$current->data['id'].')\' class="page-ajax-normal">'.$totalpage.'</span>';
		}
		if($currentpage < $endpage){
			$st.= '<span alt="'.Portal::language('next_page').'" class="page-ajax-next" onclick=\'load_ajax("page_no='.($currentpage+1).$ref.'",'.Module::$current->data['id'].')\'>'.Portal::language('next').'</span>';
		}else{
			$st.= '<span alt="'.Portal::language('next_page').'" class="page-ajax-next-block">'.Portal::language('next').'';
		}
		$st.='</div>';
		return $st;
	}
	function page_no($page_name='page_no'){
		if(Url::get($page_name) and Url::get($page_name)>0){
			return intval(Url::get($page_name));	
		}else{
			return 1;
		}
		
	}
?>