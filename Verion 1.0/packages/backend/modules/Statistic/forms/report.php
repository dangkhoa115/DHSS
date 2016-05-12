<?php
class ReportForm extends Form
{
	function ReportForm()
	{
		Form::Form('ReportForm');
		$this->link_css('skins/default/css/cms.css');
	}	
	function draw()
	{		
		$this->map = array();
		//////////////////////////////////////////////////
		if(!Url::get('month')){
			$_REQUEST['month'] = date('m');
		}
		$dates = array();
		$month = Url::get('month')?Url::get('month'):date('m');
		$year = Url::get('year')?Url::get('year'):date('Y');
		$start_time = strtotime($year.'-'.$month.'-01');
		$end_time = strtotime($year.'-'.$month.'-'.cal_days_in_month(CAL_GREGORIAN,$month,$year));
		$users = array(
			'label'=>'Tài khoản',
			'total'=>'Tổng',
			'minhphuong'=>'minhphuong',
			'yennh'=>'yennh',
			'ductm'=>'ductm'
		);
		$reports = array();
		foreach($users as $key=>$value){
			$reports[$key]['id'] = $key;
			$reports[$key]['name'] = $value;
		}
		$dates = array();
		for($i=$start_time;$i<=$end_time;$i=$i+24*3600){
			$dates[intval(date('d',$i))]['id'] = intval(date('d',$i));
		}
		$this->map['dates'] = $dates;
		///////////////////////////////////////////
		foreach($users as $key=>$value){
			for($i=$start_time;$i<=$end_time;$i=$i+24*3600){
				if($key=='label'){
					$reports[$key][intval(date('d',$i))] = '<span style="color:'.((date('w',$i)==0 or date('w',$i)==6)?'#F00':'#3160f0').';">'.date('d',$i).'</span>';
				}else{
					$reports[$key][intval(date('d',$i))] = 0;
					$cond = 'news.type="NEWS" and news.status <> "HIDE"';
					$sql = '
						SELECT
							count(*) as total
						FROM
							news
							inner join category ON category.id = news.category_id
						WHERE
							'.$cond.' AND (news.time >= '.$i.' and news.time < '.($i+24*3600).')
							AND news.user_id = "'.$key.'"
						';
					if($total = DB::fetch($sql,'total')){
						$reports[$key][intval(date('d',$i))] = $total;
					}
				}
			}
		}
		//System::debug($reports);
		$this->map['reports'] = $reports;
		$this->map['dates'] = $dates;
		$months = array();
		for($i=1;$i<=12;$i++){
			$months[$i] = $i;
		}
		$this->map['month_list'] = $months;
		$this->map['year_list'] = array(2015=>2015,2016=>2016);
		$this->parse_layout('report',$this->map);
	}
}
?>