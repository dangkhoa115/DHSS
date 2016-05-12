function Booking(lat,long,zoom,icon_width,icon_height)
{
	this.map = null;
	this.icon_width_ = icon_width;
	this.icon_height_ = icon_height;
	this.lat_ = lat;
	this.long_ = long;
	this.zoom_ = zoom;
	this.manage_map = null;
}
Booking.prototype.initialize = function(node)
{
	if (GBrowserIsCompatible()) 
	{
		this.map = new GMap2(document.getElementById(node));
		this.map.setCenter(new GLatLng(this.lat_,this.long_),this.zoom_);
		this.map.setUIToDefault();
		this.manage_map = new GMarkerManager(this.map);
	}
}
Booking.prototype.setIcon = function(width,height)
{
	this.icon_width_ = width;
	this.icon_height_ = height;
}
Booking.prototype.getIcon = function(src)
{
	var icon = new GIcon();
	icon.image = src;
	icon.iconAnchor = new GPoint(parseInt(this.icon_width_/2),this.icon_height_);
	icon.iconSize = new GSize(this.icon_width_,this.icon_height_);
	return icon;
}
Booking.prototype.getMarker = function(latlng,image,url,html) 
{
	var marker =new GMarker(latlng,{
		icon:this.getIcon(image),
		clickable: true,
		bouncy :true
	}); 		
	this.tooltip = new Tooltip(marker,html,4); 
	marker.tooltip = this.tooltip;		
	GEvent.addListener(marker, "mouseover", function(latlng) 
	{
		this.tooltip.show(); 
	});
	GEvent.addListener(marker,'mouseout',function()
	{
		this.tooltip.hide(); 
	});
	GEvent.addListener(marker, "click", function(latlng) 
	{
		if(window.opener){
			window.opener.window.location = url;
			window.close();			
		}else{
			window.location = url;
		}
	});
	return marker;
}    
Booking.prototype.setupMarker = function(latlng,image,url,html) 
{	
	this.manage_map.addMarker(this.getMarker(latlng,image,url,html),3);
	this.map.addOverlay(this.tooltip); 
}
Booking.prototype.reloadMap = function()
{	
	this.manage_map.refresh();
}
