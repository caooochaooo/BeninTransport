debutlat=7.160;
debutlng=2.020;
finlng=2.588;
finlat=7.519;
var map;
function initMap(){
	const myLatLng={ lat: debutlat, lng: debutlng };
	var mapOptions={
		center:myLatLng,
		zoom:8,
		scrollwheel: true,
	};
	//create Map
	var map=new google.maps.Map(document.getElementById("googleMap"),mapOptions);
	const uluru={ lat: debutlat, lng: debutlng };
	var marker = new google.maps.Marker({
		position: uluru,
		map: map,
		draggable: true,
	});

	google.maps.event.addListener(marker,'position_changed',
		function(){
			// var lat = marker.position.lat()
			// var lng = marker.position.lng()
			// $('#fromlat').val(lat)
			// $('#fromlng').val(lng)
			document.getElementById("fromlat").value=marker.position.lat();
			document.getElementById("fromlng").value=marker.position.lng();
			
	});
	google.maps.event.addListener(map,'click',
	function (event){
		pos=event.latLng
		marker.setPosition(pos)
	})
	const ulur={ lat: finlat, lng: finlng };
	var markert = new google.maps.Marker({
		position: ulur,
		map: map,
		draggable: true,
	});

	google.maps.event.addListener(markert,'position_changed',
		function(){
			// var lat = marker.position.lat()
			// var lng = marker.position.lng()
			// $('#fromlat').val(lat)
			// $('#fromlng').val(lng)
			document.getElementById("tolat").value=markert.position.lat();
			document.getElementById("tolng").value=markert.position.lng();
			
	});
	google.maps.event.addListener(map,'click',
	function (event){
		posi=event.latLng
		markert.setPosition(posi)
	})

}
// create a directions service object to use the route method and get result
// var directionsService=new google.maps.DirectionsService();

// Creqte a directions renderer object which we will use to display the route 
// var directionsDisplay= new google.maps.DirectionsRenderer();

// bind the directionsrenderer to the map
// directionsDisplay.setMap(map);

// function
// function calcRoute(){
	// create request
	// var request={
		// origin: document.getElementById("from").value,
		// destination: document.getElementById("to").value,
		// travelMode: google.maps.TravelMode.DRIVING,
		// unitSystem: google.maps.UnitSystem.IMPERIAL
	// }
	// Pass the reques to the route method
	// directionsService.route(request,(result,status)=>{
		// if(status==google.maps.DirectionsStatus.OK)
		// {
			// const output=document.querySelector("#output");
			// output.innerHTML="<div>From: "+document.getElementById("from").value+".<br />To: "+document.getElementById("to").value +".<br /> Driving distance"+result.routes[0].legs[0].distance.text+".<br />Duration: "+result.routes[0].legs[0].duration.text+".</div>"
			// display route
			// diectionsDisplay.setDirections(result);
		// }else{
			// delete route from map
			// directionsDisplay.setDirections({route:[]});
			// center map in SOgbo aliho
			// map.setCenter(myLatLng)
			// show error message
			// output.innerHTML="<div>Could not retrieve driving distance. </div>";
		// }
	// })
// } 
// Create autocomplete objects for all input
// optionvalue= document.getElementById("map_selected");
// val=optionvalue.options[optionvalue.selectedIndex].value;
// var options={
	// types:[val]
// }
// var input1=document.getElementById("from");
// var autocomplete2=new google.maps.places.Autocomplete(input1,options)

// var input2=document.getElementById("to");
// var autocomplete1=new google.maps.places.Autocomplete(input2,options)
