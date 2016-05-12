jQuery(document).ready(function(){

	jQuery('.help').each(function(){

		var target = jQuery('#'+jQuery(this).attr('target'));

		target.css('display','none');

		if(target.length>0)

		{

			var help = jQuery('<span><img src="skins/modern/images/info.png" /></span>');

			help.tooltip({

				bodyHandler: function() { 

					return target.html(); 

				}, 

				showURL: false 

			});

			jQuery(this).append(help);

		}

	});

		

})

