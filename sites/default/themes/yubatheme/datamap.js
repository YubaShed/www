
function initialize() {
	var mapOptions = {
		center: new google.maps.LatLng(39.299701,-121.038437),
		zoom: 10,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById("maptab"), mapOptions);
}

function loadScript() {
  var script = document.createElement("script");
  script.type = "text/javascript";
  script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyBEsRU9fWQRM8Y4bhvn4uWsoGWVUkVZxkA&sensor=false&callback=initialize";
  document.body.appendChild(script);
}

//window.onload = loadScript;