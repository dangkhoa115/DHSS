function simple_tooltip(target_items, name){	
	jQuery(target_items).each(function(i){
		jQuery("body").append('<div class="'+name+'" id="'+name+i+'"><p>'+jQuery(this).attr('title')+'</p></div>');
		var my_tooltip = jQuery("#"+name+i);
		if(jQuery(this).attr("title") != "" && jQuery(this).attr("title") != "undefined" )
		{		
			jQuery(this).removeAttr("title").mouseover(function(){
					my_tooltip.css({opacity:0.9, display:"none"}).fadeIn(400);
			}).mousemove(function(kmouse){
				var border_top = jQuery(window).scrollTop();
				var border_right = jQuery(window).width();
				var left_pos;
				var top_pos;
				var offset = 20;
				if(border_right - (offset *2) >= my_tooltip.width() + kmouse.pageX){
					left_pos = kmouse.pageX+offset;
				} else{
					left_pos = border_right-my_tooltip.width()-offset;
				}
				if(border_top + (offset *2)>= kmouse.pageY - my_tooltip.height()){
					top_pos = border_top +offset;
				} else{
					top_pos = kmouse.pageY-my_tooltip.height()-offset;
				}
				my_tooltip.css({left:left_pos, top:top_pos});
			}).mouseout(function(){
				my_tooltip.css({left:"-9999px"});
			});
		}// ìf
	});//each
}//function
/*
this.vtip = function() {    
    this.xOffset = -10; // x distance from mouse
    this.yOffset = 10; // y distance from mouse       
    
    jQuery(".vtip").unbind().hover(    
        function(e) {
            this.t = this.title;
            this.title = ''; 
            this.top = (e.pageY + yOffset); this.left = (e.pageX + xOffset);
            
            jQuery('body').append( '<p id="vtip"><img id="vtipArrow" />' + this.t + '</p>' );
                        
            jQuery('p#vtip #vtipArrow').attr("src", 'images/vtip_arrow.png');
            jQuery('p#vtip').css("top", this.top+"px").css("left", this.left+"px").fadeIn("slow");
            
        },
        function() {
            this.title = this.t;
            jQuery("p#vtip").fadeOut("slow").remove();
        }
    ).mousemove(
        function(e) {
            this.top = (e.pageY + yOffset);
            this.left = (e.pageX + xOffset);
                         
            jQuery("p#vtip").css("top", this.top+"px").css("left", this.left+"px");
        }
    );            
    
};
jQuery(document).ready(function(jQuery){vtip();})*/