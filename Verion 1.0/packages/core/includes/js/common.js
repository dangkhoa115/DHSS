function echo(st){
	document.write(st);
}
function $(id){
	if(typeof(id)=='object'){
		return id;
	}
	return document.getElementById(id);
}
function getId(id){//alternative for $ function
	if(typeof(id)=='object'){
		return id;
	}
	return document.getElementById(id);
}

function toggle(id, status){
	if($(id)){
		if(typeof(status)!='undefined'){
			$(id).style.display = status;
		} else if($(id).style.display == 'none'){
			$(id).style.display ='block';
		} else{
			$(id).style.display = 'none';
		}
	}
}
function findPos(obj) {
	var curleft = curtop = 0;
	if (obj.offsetParent) {
		do {
			curleft += obj.offsetLeft;
			curtop += obj.offsetTop;
		} while (obj = obj.offsetParent);
	}
	return [curleft,curtop];
}

function select_all_checkbox(form,name,status, select_color, unselect_color){

	for (var i = 0; i < form.elements.length; i++) {
		if (form.elements[i].name == 'selected_ids[]') {
			if(status==-1){
				form.elements[i].checked = !form.elements[i].checked;
			} else{
				form.elements[i].checked = status;
			}
		}
	}
}
function select_checkbox(form, name, checkbox, select_color, unselect_color){
	tr_color = checkbox.checked?select_color:unselect_color;
	if(typeof(event)=='undefined' || !event.shiftKey){
		getId(name+'_all_checkbox').lastSelected = checkbox;
		update_all_checkbox_status(form, name);
		return;
	}
	//select_all_checkbox(form, name, false, select_color, unselect_color);
	
	var active = typeof($(name+'_all_checkbox').lastSelected)=='undefined'?true:false;
	
	for (var i = 0; i < form.elements.length; i++) {
		if (!active && form.elements[i]==$(name+'_all_checkbox').lastSelected){
			active = 1;
		}
		if (!active && form.elements[i]==checkbox){
			active = 2;
		}
		if (active && form.elements[i].id == name+'_checkbox') {
			form.elements[i].checked = checkbox.checked;
			$(name+'_tr_'+form.elements[i].value).style.backgroundColor=
				checkbox.checked?select_color:unselect_color;
		}
		if(active && (form.elements[i]==checkbox && active==1) || (form.elements[i]==$(name+'_all_checkbox').lastSelected && active==2)){
			break;
		}
	}
	update_all_checkbox_status(form, name);
}
function update_all_checkbox_status(form, name){
	var status = true;
	for (var i = 0; i < form.elements.length; i++) {
		if (form.elements[i].name == 'selected_ids[]' && !form.elements[i].checked) {
			status = false;
			break;
		}
	}
	$(name+'_all_checkbox').checked = status;
}
function make_date_input(input_name, input_value){
	echo('<div id="'+input_name+'_div"></div>');
	new Ext.form.DateField({
		name:input_name,
		id:input_name,
		value:input_value,
		renderTo:input_name+'_div',
		format:'d/m/Y'
	});
}
var ns = (navigator.appName.indexOf("Netscape") != -1);
var d = document;
var px = document.layers ? "" : "px";
function JSFX_FloatDiv(id, sx, sy){
	var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
	window[id + "_obj"] = el;
	if(d.layers)el.style=el;
	el.cx = el.sx = sx;el.cy = el.sy = sy;
	el.sP=function(x,y){this.style.left=x+px;this.style.top=y+px;};
	el.flt=function(){
		var pX, pY;
		pX = (this.sx >= 0) ? 0 : ns ? innerWidth : 
		document.documentElement && document.documentElement.clientWidth ? 
		document.documentElement.clientWidth : document.body.clientWidth;
		pY = ns ? pageYOffset : document.documentElement && document.documentElement.scrollTop ? 
		document.documentElement.scrollTop : document.body.scrollTop;
		if(this.sy<0) 
		pY += ns ? innerHeight : document.documentElement && document.documentElement.clientHeight ? 
		document.documentElement.clientHeight : document.body.clientHeight;
		this.cx += (pX + this.sx - this.cx)/8;this.cy += (pY + this.sy - this.cy)/8;
		this.sP(this.cx, this.cy);
		setTimeout(this.id + "_obj.flt()", 40);
	}
	return el;
}
function numberFormat(nStr){
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}
function to_numeric(st){
	if(st){
		st = st+'';
		if(st){
			return (typeof(st)=='number' || (typeof(st.match)!='undefined' && !st.match(/[^0-9.,-]/)))?parseFloat(st.replace(/\,/g,'')):st;
		} else{
			return st;
		}
	}else{
		return 0;
	}
}
/*-------------------------------------------------------------------------*/
function is_numeric(sText){
	var ValidChars = "0123456789.";
	var isNumeric=true;
	var Char;
	
	
	for (i = 0; i < sText.length && isNumeric == true; i++) { 
	  Char = sText.charAt(i); 
	  if (ValidChars.indexOf(Char) == -1) {
		 isNumeric = false;
		 }
	  }
	return isNumeric;
}
function stringToNumber(st){
		st = st+'';
		if(st){
			return (typeof(st)=='number' || (typeof(st.match)!='undefined' && !st.match(/[^0-9.,-]/)))?parseFloat(st.replace(/\,/g,'')):st;
		} else{
			return st;
		}
}
function roundNumber(num, dec) {
	var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
	return result;
}
function strPad(str, pad, width){
	var str = str.toString();
	desStr = str;
	if(str.length < width){
		for(i = 0; i < (width - str.length);i++){
			desStr = pad + desStr;
		}
	}
    return desStr;
}
function LastDayOfMonth(year, month){
	month = stringToNumber(month);
	var day;
	switch(month){
		case 1 :
		case 3 :
		case 5 :
		case 7 :
		case 8 :
		case 10:
		case 12:
			day = 31;
			break;
		case 4 :
		case 6 :
		case 9 :
		case 11:
			day = 30;
			break;
		case 2 :
			if( ( (year % 4 == 0) && ( year % 100 != 0) ) 
						   || (year % 400 == 0) )
				day = 29;
			else
				day = 28;
			break;

	}
	return day;
}
function compareDate(fromDate, toDate){
	var larger = 1;
	var smaller = -1;
	var equal = 0;
	
	var fromYear = stringToNumber(fromDate.substring(0,4));
	var fromMonth = stringToNumber(fromDate.substring(5,7));
	var fromDay = stringToNumber(fromDate.substring(8,10));
	
	var toYear = stringToNumber(toDate.substring(0,4));
	var toMonth = stringToNumber(toDate.substring(5,7));
	var toDay = stringToNumber(toDate.substring(8,10));
	
	if(fromYear < toYear){
		return smaller;
	} else if(toYear == fromYear){
		if(fromMonth < toMonth){
			return smaller;
		}else if(fromMonth == toMonth){
			if(fromDay < toDay){
				return smaller;
			} else if(fromDay == toDay){
				return equal;
			} else {
				return larger;
			}
		} else {
			return larger;
		}
	} else {
		return larger;
	}
}
function start_clock(){
	var thetime=new Date();
	var nhours=thetime.getHours();
	var nmins=thetime.getMinutes();
	var nsecn=thetime.getSeconds();
	var nday=thetime.getDay();
	var nmonth=thetime.getMonth();
	var ntoday=thetime.getDate();
	var nyear=thetime.getYear();
	var AorP=" ";
	if (nhours>=12)
		AorP="P.M.";
	else
		AorP="A.M.";
	if (nhours>=13)
		nhours-=12;
	if (nhours==0)
	   nhours=12;
	if (nsecn<10)
	 nsecn="0"+nsecn;
	if (nmins<10)
	 nmins="0"+nmins;
	$('clockspot').innerHTML=nhours+": "+nmins+": "+nsecn+" "+AorP;
	setTimeout('start_clock()',1000);
}
function max_height(obj){
	var arr = Array();
	var max_height = 0;
	var i=0;
	obj.each(function(){
		arr[i]=parseInt(obj.eq(i).height());
		if(arr[i]>max_height) max_height = arr[i];
		i++;
	});
	return max_height;
}
function printWebPart(tagid){
    if (tagid && document.getElementById(tagid)) {
		//build html for print page
		if(jQuery("#"+tagid).attr('type')=='land'){
			var content = '<div style="page:land;">';
			content += jQuery("#"+tagid).html();
			content += '</div>';
		}else{
        	var content = jQuery("#"+tagid).html();
		}
		var html = "<HTML>\n<HEAD>\n"+
            jQuery("head").html()+
            "\n</HEAD>\n<BODY>\n"+
            content+
            "\n</BODY>\n</HTML>";
        //open new window
        html = html.replace(/<TITLE>((.|[\r\n])*?)<\\?\/TITLE>/ig, "");
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
function TextCounter(obj,maxCounter,remainCounterObj){
	text = obj.value;
	textLen = text.length;
	remain = maxCounter - textLen;
	remainCounterObj.innerHTML = remain;
	if(remain < 0){
		obj.value = text.substr(0,maxCounter);
		$('remainCounterId').value = 0;
		alert('You reach the max');
	}
}
function updateItemLike(obj,itemId,phpSession,blockId){
	jQuery.ajax({
		method: "POST",
		url: 'form.php?block_id='+blockId,
		data : {
			cmd:'update_like',
			item_id:itemId,
			php_session:phpSession
		},
		beforeSend: function(){
			//obj.disabled = true;
		},
		success: function(content){
			if(content){
				$('counter_'+itemId).innerHTML = '{'+content+'}';
				obj.style.color = '#AAAAAA';
			}
		}
	});
}
function custom_alert(output_msg, title_msg)
{
    if (!title_msg)
        title_msg = 'Thông báo';

    if (!output_msg)
        output_msg = 'No Message to Display.';

    jQuery("<div></div>").html(output_msg).dialog({
        title: title_msg,
        resizable: false,
        modal: true,
        buttons: {
            "Ok": function() 
            {
                jQuery( this ).dialog( "close" );
            }
        }
    });
}