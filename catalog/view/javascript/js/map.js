google.maps.event.addDomListener(window, 'load', init);
	function init() {
		var mapOptions = {
			zoom: 14,
           	center: new google.maps.LatLng(55.761459, 37.564051),};
		var mapElement = document.getElementById('map');
		var map = new google.maps.Map(mapElement, mapOptions);
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(55.761459, 37.564051),
			map: map,
			icon: "images/marker.png",
			title: 'Большой Трехгорный пер. 11, стр.2'
		});
}