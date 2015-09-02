<!DOCTYPE html>
<html lang="fr">
<?php 
	include('../fonction/Function.php');
	$id=$_GET['entreprise'];
        $idagence=$_GET['agence'];
        $entreprise=recuperer_info($id);
        $agence=mysql_fetch_assoc(recup_info_agence($id,$idagence));
        //die($agence['nom_agence']);
	?>
<head>
	
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $agence['nom_agence']; ?></title>
	<!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.transitions.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
          
    <link rel="shortcut icon" href="../avatars/<?php echo $entreprise['logo']; ?>">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
<style>
::-webkit-scrollbar {
    width: 12px;
}
 
/* Track */
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    -webkit-border-radius: 10px;
    border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
    -webkit-border-radius: 10px;
    border-radius: 10px;
    background: rgba(69, 174, 214, 0.85); 
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}
::-webkit-scrollbar-thumb:window-inactive {
	background: rgba(69, 174, 214, 0.85); 
}
      #map {
        width: 100%;
        height: 100%;
        opacity: 0.42;
        
        /*margin-left: auto;
        margin-right: auto;
        margin-top: 10px;
 height: 100%; 
  width: 100%; */
  position:absolute; 
  top: 0; 
  left: 0; 
  z-index: 0; 
       
        
-moz-border-radius:7px;
-webkit-border-radius:7px;
border-radius:7px;
      }
    </style>
</head><!--/head-->

<body>
 <div id="map"></div>
    <script>

function initMap() {
var lat=<?php echo $agence['latitude'];?>;
var lng=<?php echo $agence['longitude'];?>;
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: lat, lng: lng},
    zoom: 3
  });
var marker = new google.maps.Marker({
    position: {lat: lat, lng: lng},
    map: map,
    title: 'Nous Somme ici'
  });
var infoWindows = new google.maps.InfoWindow({map: map});
infoWindows.setPosition({lat: lat, lng: lng});
      infoWindows.setContent('Nous Somme ici');

  var infoWindow = new google.maps.InfoWindow({map: map});

  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      infoWindow.setPosition(pos);
      infoWindow.setContent('Vous etes ici.');
     var markerMe = new google.maps.Marker({
    position: {lat: position.coords.latitude, lng: position.coords.longitude},
    map: map,
    icon:'../img/icon.png',
    title: 'Vous etes ici.'
  });

      map.setCenter(pos);
    }, function() {
      handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?signed_in=true&callback=initMap"
        async defer>
    </script>
    


</body>
</html>
