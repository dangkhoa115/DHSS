<?php 
class QuanLyKetQuaThiDau extends Module
{
	function QuanLyKetQuaThiDau($row)
	{
		Module::Module($row);
		if(User::can_view(false,ANY_CATEGORY))
		{
			if(Url::get('mua_giai_id')){
				Session::set('mua_giai_id',Url::get('mua_giai_id'));
			}
			if(!Session::is_set('mua_giai_id')){
				Session::set('mua_giai_id',2);
			}
			if(Url::get('do')=='get_clb' and Url::iget('clb_id')){
				$this->get_clb(Url::iget('clb_id'));
				exit();
			}
			require_once 'packages/backend/includes/php/ssnh.php';
			require_once 'forms/edit.php';
			$this->add_form(new EditQuanLyKetQuaThiDauForm());
		}
		else
		{
			URL::access_denied();
		}
	}
	function get_clb($clb_id){
		require_once 'packages/backend/includes/php/ssnh.php';
		require_once 'packages/core/includes/utils/paging.php';
		$cond = '
			ssnh_cau_thu_clb.clb_id = '.$clb_id.'
		';
		$order = 'vtts.so_thu_tu';
		$cau_thus = get_cauthus($cond,50,page_no(),$order);
		$str = '<ul>';
		foreach($cau_thus as $value){
			$str .= '<li><span class="player" ondragstart="dragStart(event,\''.$value['ten'].'\')" ondrag="dragging(event)" draggable="true" id="dragtarget">'.$value['ten'].'</span></li>';
		}
		$str .= '</ul>';
		echo $str;
	}
}
?>