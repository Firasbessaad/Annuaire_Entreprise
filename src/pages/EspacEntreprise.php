<!DOCTYPE html>
<?php
session_start();

include('./fonction/Function.php');
if (!isset($_SESSION['infos_generale']['login'])) 
{
header('Location: index.php');
}

if(isset($_POST['ajouterAgence'])){
$nomAgence=htmlentities(trim($_POST['nomAgence']));
$mail=htmlentities(trim($_POST['mail']));
$description=htmlentities(trim($_POST['description']));
$adresse=htmlentities(trim($_POST['adresse']));
$tel=htmlentities(trim($_POST['tel']));
$fax=htmlentities(trim($_POST['fax']));
$couverture=$_POST['couverture'];
$Latitude=htmlentities(trim($_POST['Latitude']));
$Longitude=htmlentities(trim($_POST['Longitude']));
ajouter_Agence($_SESSION['infos_generale']['id_entreprise'],$nomAgence,$couverture,$mail,$description,$adresse,$tel,$fax,$Latitude,$Longitude);
header('Location: EspacEntreprise.php');
}

?>
<html lang="en">
<head>
  <title><?php echo $_SESSION['infos']['nom']; ?></title>
  <link rel="shortcut icon" href="../avatars/<?php echo $_SESSION['infos']['logo']; ?>">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/bootstrap_3.min.css">

 <link rel="stylesheet" type="text/css"  href="css/smart-forms.css">
    <link rel="stylesheet" href="css/queries.css">
 <meta name="description" content="">
    <meta name="author" content="firas" >

    
    <!-- Bootstrap Core CSS -->
    

    <!-- Custom CSS -->
    <link href="css/asidsimple-sidebar.css" rel="stylesheet">
    <link href="css/plugins-2.1.css" rel="stylesheet">
    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
 
<style>
      #map-canvas {
        width: 100%;
        height: 100%;
        opacity: 0.8;
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
      }/*/http://www.psdgraphics.com/file/black-and-white-abstract*/
input:invalid + label::after { background: #FEEFE9;
  border-color: #E46B66;}
input:valid + label::after { content: ' ✓'; }
body{
background:url("./img/tr.png")no-repeat; 
  background-size: cover;
 background-attachment: fixed;

}
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places">
</script><script src="js/loding.js"></script>    
</head>
<body>
<nav class="navbar navbar-inverse" style="z-index: 2;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="./index.php">LUMD Annuaire</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#"><span class="glyphicon glyphicon-home blue"></span></a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Nouveautés<span class="caret"></span></a>
          <ul class="dropdown-menu">
                <li><a href="Actualite.php"><span class="glyphicon glyphicon-bookmark blue"></span> Actualités</a></li>
            <li><a href="Annonce.php"><span class="glyphicon glyphicon-bullhorn blue"></span> Annonces</a></li>
            <li><a href="Offre.php"><span class="glyphicon glyphicon-transfer blue"></span> Appel d'offre</a></li>
            <li><a href="Emploi.php"><span class="glyphicon glyphicon-tags blue"></span> Offre d'emplois</a></li>
         
          </ul>
        </li>
       
        <li><a href="Produit.php">Produits</a></li>
        <li><a href="Service.php">Services</a></li>
      </ul>
<div class="col-sm-3 col-md-3 ">
        <form class="navbar-form" role="search">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term" autocomplete="on">
            <div class="input-group-btn">
                <button class="btn btn-default" id="srch-term-btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
        </form>
        </div>
      <ul class="nav navbar-nav navbar-right">
        
        <li><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['infos_generale']['login']?><span class="caret"></span></a>
            <ul class="dropdown-menu">
            <li><a  href="#parametre" role="button" data-toggle="modal"><span class="glyphicon glyphicon-cog"></span> Paramètre</a></li>
<li><a href="./deconnexion.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          </ul></li>
      </ul>
    </div>
  </div>
</nav>
<div class="col-md-3" style="z-index: 1;">
<ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#"><img src="./avatars/<?php echo $_SESSION['infos']['logo'];?>" width="25" height="25"> Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <span class="glyphicon glyphicon-th blue"></span> Agences <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#" data-toggle="modal" data-target="#Mesagence"><span class="glyphicon glyphicon-pushpin blue"></span> Modifier agences</a></li>
            <li><a href="#" data-toggle="modal" data-target="#rediredct"><span class="glyphicon glyphicon-icon-user-add blue">+</span> Ajouter une agence</a></li>                        
          </ul>
        </li>
        <li class="dropdown">
        <a href="./Galerie.php" ><span class="glyphicon glyphicon-picture blue"></span> Galerie</a>
        </li>
        <li><a href="Document.php"><span class="glyphicon glyphicon-file blue"></span> Documents</a></li>
        <li><a href="Produit.php"><span class="glyphicon glyphicon-shopping-cart blue"></span> Produits</a></li>
        <li><a href="Service.php"><span class="glyphicon glyphicon-wrench blue"></span> Services</a></li>
        <li><a href="Offre.php"><span class="glyphicon glyphicon-transfer blue"></span> Appel d'offre</a></li>
        <li><a href="Annonce.php"><span class="glyphicon glyphicon-bullhorn blue"></span> Annonces</a></li>
        <li><a href="Emploi.php"><span class="glyphicon glyphicon-tags blue"></span> Offre d'emplois</a></li>
        <li><a href="Actualite.php"><span class="glyphicon glyphicon-bookmark blue"></span> Actualités</a></li>
        </ul>
</div>


<a href="#" data-toggle="modal" data-target="#AjouterAgence"></a><div id="map-canvas"></div>

<table id="table_agence" class="table table-hover table-bordered" cellspacing="0" style="display: none;">                
         <thead> 
                 <tr> 
                 <th>Nom </th>
                 <th> mail</th>
                 <th> tel</th> 
                 <th> fax</th>
                 <th> adresse</th>  
                 <th> Latitude</th> 
                 <th> Longitude</th>
                  </tr> 
         </thead> 
         <tbody> 

<?php $agences=afficher_agence($_SESSION['infos_generale']['id_entreprise']);
$i=1;
$j=1;
while($agence = mysql_fetch_assoc($agences)) {
echo "<tr><td>".$agence['nom_agence']."</td><td>".$agence['mail_agence']."</td><td>".$agence['tel_agence']."</td><td>".$agence['fax_agence']."</td><td>".$agence['adresse']."</td><td id=\"".$i."\" >".$agence['latitude']."</td><td id=\"".$i."\">".$agence['longitude']."</td></tr>";
 ; $i++;
$j++;}?>

        </tbody> 
</table>
<?php 
include('modalAgence.html');
include('Modal.html');
?>
<script>
var test=false;
var tableauMarqueurs = [
			
				{ lat:36.80673346696643,lng: 10.073615312576294 ,titre:'SQLi_Service' }
			];
var x="";
var y="";
//alert(x);
//var mark= document.getElementById("1").innerHMTL;
var I = <?php echo $i ;?>;
if(I!=0){
for( var i = 1; i < I; i++ ) {
 nomAgence= document.getElementsByTagName('table')[0].getElementsByTagName('tr')[i].cells[0].innerHTML;
 mail= document.getElementsByTagName('table')[0].getElementsByTagName('tr')[i].cells[1].innerHTML;
 tel= document.getElementsByTagName('table')[0].getElementsByTagName('tr')[i].cells[2].innerHTML;
 fax= document.getElementsByTagName('table')[0].getElementsByTagName('tr')[i].cells[3].innerHTML;
 adress = document.getElementsByTagName('table')[0].getElementsByTagName('tr')[i].cells[4].innerHTML;
 x= document.getElementsByTagName('table')[0].getElementsByTagName('tr')[i].cells[5].innerHTML;
 y= document.getElementsByTagName('table')[0].getElementsByTagName('tr')[i].cells[6].innerHTML;
 if((x!=0)&&(y!=0)){
var marked={ lat:x,lng: y ,titre:nomAgence };
tableauMarqueurs.push(marked);
}
}}
//alert(x);
//document.getElementById("tesst").innerHTML = x;

//var x= { lat:47.332327,lng: 1.235060 },{ lat:47.342527,lng: 1.245060 };
//tableauMarqueurs.push();
			var maCarte;
			var zoneMarqueurs = new google.maps.LatLngBounds();
                        var geocoder;
			function initialisation() {
                                geocoder = new google.maps.Geocoder();
				var optionsCarte = {
					zoom: 5,
					center: new google.maps.LatLng( 47.389982, 0.688877 ),
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				maCarte = new google.maps.Map( document.getElementById("map-canvas"), optionsCarte );

				for( var i = 0, I = tableauMarqueurs.length; i < I; i++ ) {
					ajouteMarqueur( tableauMarqueurs[i] );
				}
                                
				maCarte.fitBounds( zoneMarqueurs );
            google.maps.event.addListener(maCarte, 'click', function(event) {
            placeMarker(event.latLng);});
      function codeAddress() {
  var address = document.getElementsByTagName('table')[0].getElementsByTagName('tr')[1].cells[4].innerHTML;
 var nomAgencee= document.getElementsByTagName('table')[0].getElementsByTagName('tr')[1].cells[0].innerHTML;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      maCarte.setCenter(results[0].geometry.location);
   //alert('Geocode : ' + results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: maCarte,
          position: results[0].geometry.location,
          title: nomAgencee
      });
zoneMarqueurs.extend( marker.getPosition() );
 var infowindow = new google.maps.InfoWindow({
    content: 'Agence: ' + nomAgencee // + '<br> Mail: '+ mail '<br> Tel: '+ tel + '<br> fax: '+ fax +'<br> adress: '+ adress
  });
  infowindow.open(maCarte,marker);

    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}      
    codeAddress();                          
                                
 var input = /** @type {HTMLInputElement} */(
      document.getElementById('srch-term'));
var srch_term_btn = document.getElementById("srch-term-btn");
srch_term_btn.disabled = true;
  var types = document.getElementById('type-selector');
// maCarte.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  maCarte.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

  var autocomplete = new google.maps.places.Autocomplete(input);
  //autocomplete.bindTo('bounds', maCarte);

  var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: maCarte,
    anchorPoint: new google.maps.Point(0, -29)
  });

  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
     
      maCarte.fitBounds(place.geometry.viewport);
    } else {
      maCarte.setCenter(place.geometry.location);
      maCarte.setZoom(17);  // Why 17? Because it looks good.
    }

    marker.setIcon(/** @type {google.maps.Icon} */({
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(35, 35)
    }));
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }

    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    infowindow.open(map, marker);
  });

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  
                                
                                
                                
                                
                                
                                
                                
                                
			}

			function ajouteMarqueur( latlng ) {
				var latitude = latlng.lat;
				var longitude = latlng.lng;
                                var titre = latlng.titre;
                                /*var mail= latlng.mail;
                                var tel= latlng.tel; 
                                var fax= latlng.fax; 
                                var adress= latlng.adress;*/
				var optionsMarqueur = {
					map: maCarte,
					position: new google.maps.LatLng( latitude, longitude ),
                                        title: titre
				};
				var marqueur = new google.maps.Marker( optionsMarqueur );
				zoneMarqueurs.extend( marqueur.getPosition() );
 var infowindow = new google.maps.InfoWindow({
    content: 'Agence: ' + titre // + '<br> Mail: '+ mail '<br> Tel: '+ tel + '<br> fax: '+ fax +'<br> adress: '+ adress
  });
  infowindow.open(maCarte,marqueur);
			}

function remplireControle(element,tableau,tableauV,message){
$('#'+element).on('input',function(e){
//var tableau=["nomAgence", "mail", "tel", "fax", "Description","adresse"];
var indice=tableau.indexOf(element);
for (i = 0; i < indice+1; i++){
//alert(document.getElementById(tableau[i]).value);
   if(document.getElementById(tableau[i]).value==""){
document.getElementById(tableau[i]).style.background="#FEEFE9";
document.getElementById(tableau[i]).style.borderColor="#E46B66";
document.getElementById(tableauV[i]).innerHTML = message[i];

}else{
switch(tableau[i]) {
    case "mail":
       if(isEmail(document.getElementById(tableau[i]).value)){
document.getElementById(tableau[i]).style.background="#EAFCD8";
document.getElementById(tableau[i]).style.borderColor="#2ecc71";
document.getElementById(tableauV[i]).innerHTML = "";

}else{
document.getElementById(tableau[i]).style.background="#FEEFE9";
document.getElementById(tableau[i]).style.borderColor="#E46B66";
document.getElementById(tableauV[i]).innerHTML = message[i];

}
        break;
case "tel":
        if(isTel_Fax(document.getElementById(tableau[i]).value)){
document.getElementById(tableau[i]).style.background="#EAFCD8";
document.getElementById(tableau[i]).style.borderColor="#2ecc71";
document.getElementById(tableauV[i]).innerHTML = "";
}else{
document.getElementById(tableau[i]).style.background="#FEEFE9";
document.getElementById(tableau[i]).style.borderColor="#E46B66";
document.getElementById(tableauV[i]).innerHTML = message[i];

}
        break;
    case "fax":
        if(isTel_Fax(document.getElementById(tableau[i]).value)){
document.getElementById(tableau[i]).style.background="#EAFCD8";
document.getElementById(tableau[i]).style.borderColor="#2ecc71";
document.getElementById(tableauV[i]).innerHTML = "";
}else{
document.getElementById(tableau[i]).style.background="#FEEFE9";
document.getElementById(tableau[i]).style.borderColor="#E46B66";
document.getElementById(tableauV[i]).innerHTML = message[i];

}
        break;    
    default:
        document.getElementById(tableau[i]).style.background="#EAFCD8";
document.getElementById(tableau[i]).style.borderColor="#2ecc71";
document.getElementById(tableauV[i]).innerHTML = "";

}
}  
}
    });



}

 function isEmail(myVar){
     // La 1ère étape consiste à définir l'expression régulière d'une adresse email
     var regEmail = new RegExp('^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$','i');

     return regEmail.test(myVar);
   }
function isTel_Fax(myVar){
     // La 1ère étape consiste à définir l'expression régulière d'une adresse email
     var regTel_Fax = new RegExp('^[0-9a][0-9][0-9][0-9][0-9][0-9][0-9][0-9]');

     return regTel_Fax.test(myVar);
   }

function placeMarker(location) {
$("#AjouterAgence").modal("show");
var adresse="";
var latlng = new google.maps.LatLng(location.lat(), location.lng());
var geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[1]) {
                           
adresse=results[1].formatted_address;
document.getElementById("adresse").value=adresse;

                        }
                    }
                });
if (true) {
document.getElementById("Latitude").value=location.lat();
document.getElementById("Longitude").value=location.lng();
document.getElementById("adresse").style.background="#EAFCD8";
document.getElementById("adresse").style.borderColor="#2ecc71";
document.getElementById("Latitude").style.background="#EAFCD8";
document.getElementById("Latitude").style.borderColor="#2ecc71";
document.getElementById("Longitude").style.background="#EAFCD8";
document.getElementById("Longitude").style.borderColor="#2ecc71";
var tableau=["nomAgence", "mail", "tel", "fax", "Description", "adresse"];
var tableauV=["nomAgenceV", "mailV", "telV", "faxV", "DescriptionV", "adresseV"];
var message=["Saisir le nom de l'agence.", "Saisir un email valide. ", "Saisir un numero de téléphone valide.", "Saisir un numero de fax valide.", "Dire quelque chose.", "Saisir une adresse valide."];


for(i=0;i<tableau.length;i++){
remplireControle(tableau[i],tableau,tableauV,message);
}



  var marker = new google.maps.Marker({
    position: location,
    map: maCarte,
    icon:'./img/icon.png'
  });

  var infowindow = new google.maps.InfoWindow({
    content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
  });
  infowindow.open(maCarte,marker);






$('#cancelAgence').click(function() {
              annulee=true;
marker.setMap(null);
          });
$('#cancelAgenceX').click(function() {
              annulee=true;
marker.setMap(null);
          });
$('#annuler').click(function() {
              annulee=true;
marker.setMap(null);
          });
}
}


			
			 google.maps.event.addDomListener( window, 'load', initialisation );




    </script>
<script src="js/functions.js"></script>
<script src="js/scripts.js"></script>
    <script src="js/unslider.min.js"></script>
</body>
</html>

