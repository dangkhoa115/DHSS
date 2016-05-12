<?php 
class iGold{
	static function get_igold($account_id){
		return DB::fetch('select igold from account where id="'.$account_id.'"','igold');
	}
	static function buy_igold($account_id,$value,$description=''){
		DB::query('update account set igold=igold + '.$value.' where id="'.$account_id.'"');
		DB::insert('igold',array('account_id'=>$account_id,'value'=>$value,'time'=>time(),'description'=>$description,'type'=>1));
	}
	static function receive_igold($account_id,$value,$description=''){
		if($account_id){
			DB::query('update account set igold=igold + '.$value.' where id="'.$account_id.'"');
			DB::insert('igold',array('account_id'=>$account_id,'value'=>$value,'time'=>time(),'description'=>$description,'type'=>1));
		}
	}
	static function pay_igold($account_id,$value,$description=''){
		$igold = iGold::get_igold($account_id);
		if($value<=$igold){
			DB::query('update account set igold=igold - '.$value.' where id="'.$account_id.'"');
			DB::insert('igold',array('account_id'=>$account_id,'value'=>'-'.$value,'time'=>time(),'description'=>$description,'type'=>0));
			return true;
		}else{
			return false;
		}
	}
	static function check_igold($account_id,$quantity=1){
		if(DB::fetch('select igold from account where id="'.$account_id.'"','igold')>=$quantity){
			return true;
		}else{
			return false;
		}
	}
	static function buy_item($item_id,$quantity=1,$total_amount){
		$account_id = Session::get('user_id');
		if($item = DB::select('ssnh_items','id='.$item_id)){
			$name = $item['name'];
			$price = $item['price'];
			if($row=DB::fetch('select * from ssnh_items_store where (item_id='.$item_id.' and account_id="'.$account_id.'")')){
				/*if($row['quantity'] > $item['max_quantity']){
					echo 'false';// false vi vuot qua so luong toi da
				}elseif($row['quantity'] + $quantity > $item['max_quantity']){
					echo 'false';// false vi vuot qua so luong toi da
				}else{
					DB::query('update ssnh_items_store set quantity = quantity + '.$quantity.' where id = '.$row['id'].'');
					echo 'true';
				}*/
				DB::query('update ssnh_items_store set quantity = quantity + '.$quantity.' where id = '.$row['id'].'');
				iGold::pay_igold($account_id,$total_amount,'Mua item '.$name.'');
				echo 'true';
			}else{			
				DB::insert('ssnh_items_store',array('account_id'=>$account_id,'item_id'=>$item_id,'quantity'=>$quantity,'name'=>$name));
				iGold::pay_igold($account_id,$total_amount,'Mua item '.$name.'');
				echo 'true';// thanh cong
			}
		}
	}
	static function get_prize_item($item_id,$quantity=1){
		$account_id = Session::get('user_id');
		if($item = DB::select('ssnh_items','id='.$item_id)){
			$name = $item['name'];
			if($row=DB::fetch('select * from ssnh_items_store where (item_id='.$item_id.' and account_id="'.$account_id.'")')){
				DB::query('update ssnh_items_store set quantity = quantity + '.$quantity.' where id = '.$row['id'].'');
				echo 'true';
			}else{			
				DB::insert('ssnh_items_store',array('account_id'=>$account_id,'item_id'=>$item_id,'quantity'=>$quantity,'name'=>$name));
				echo 'true';// thanh cong
			}
		}
	}
	static function transfer_to_igold($t,$promote=false){
		$t = intval($t);
		if($promote and $t>=20000){
			$total = ($t/1000)*2;
		}else{
			if($t>=50000 and $t<100000){
				$total = $t/1000 + 10;
			}elseif($t>=100000 and $t<200000){
				$total = $t/1000 + 20;
			}elseif($t>=200000 and $t<500000){
				$total = $t/1000 + 30;
			}elseif($t>=500000 and $t<1000000){
				$total = $t/1000 + 110;
			}elseif($t>=1000000){
				$total = $t/1000 + 250;
			}else{
				$total = $t/1000;
			}
		}
		return $total;
	}
}
?>