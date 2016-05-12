var iGOLD_BC = 3;
var MAX_BC = 3;
var pass = true;
var DA_BC = 0;
var DANG_BC = 0;
function updateTotal(){	
	var paid_igold = 0;
	var unchecked_paid_igold = 0;
	var TOTAL_IGOLD = to_numeric(jQuery('#igold').html());
	var total = 0;
	var selected_total = 0;
	jQuery('.selected-clb').each(function(index, element){
		if(jQuery(this).attr('old') == 1){
			paid_igold += iGOLD_BC;
			selected_total += iGOLD_BC;
		}
		if(jQuery(this).attr('old') == 1 && jQuery(this).is(':checked')==false){
			unchecked_paid_igold += iGOLD_BC;
		}
		if(jQuery(this).is(':checked') && jQuery(this).attr('old') == 0){
			selected_total += iGOLD_BC;
			clb = jQuery(this).attr('value');
			var amount = to_numeric(clb)?iGOLD_BC:0;
			if(total<= TOTAL_IGOLD){
				total += amount;
			}else{
				pass = false;
				alert("Bạn không đủ iGold để bình chọn số đội bạn chọn. \nVui lòng nạp thêm iGold!");
			}
		}
	});
	if(total - unchecked_paid_igold < 0){
		total = 0;
	}else{
		total = total - unchecked_paid_igold;
	}
	return total;
}
function checkClb(obj){
	var $i = 0;
	jQuery('delete_ids').val('');
	delete_ids = '';
	var c = 0;
	jQuery('.selected-clb').each(function(index, element){
		if(jQuery(this).is(':checked')){
			if($i>=3){
				obj.checked = false;
				alert('Bạn chỉ được chọn tối đa 3 đội');
			}
			$i++;
		}
		////////////////////////////////////
		if(jQuery(this).attr('old') == 1){
			if(jQuery(this).is(':checked') ==false){
				delete_ids += ((c>0)?',':'')+jQuery(this).val();
				c++;
			}
		}
		////////////////////////////////////		
	});
	DANG_BC = $i;
	jQuery('#delete_ids').val(delete_ids);
  var total = updateTotal();
	jQuery('#total_amount').val(total);	
	jQuery('#total').html(numberFormat(total));
}