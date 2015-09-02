<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">  
    <title>LUMD Annuaire | Annuaire</title><link rel="shortcut icon" href="img/logo.png">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/annuaire.css">
    <link rel="stylesheet" href="css/queries.css">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	  <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <script>
function filiere(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","filiere.php?id="+str,true);
  xmlhttp.send();
}

function departemens(str) {
  if (str=="") {
    document.getElementById("departement").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("departement").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","departement.php?id="+str,true);
  xmlhttp.send();
}

</script>
<style>
body{
/*background:url(./img/01.jpg) no-repeat;
 background-size: cover;
  background-attachment: fixed;
}*/
input[type="text"],.input-group-addon
{
    background-color: rgba(239, 230, 230, 0.32);
   
}
input[type="text"]:focus
{
    background-color: rgba(239, 230, 230, 1);
   
}</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
     <script src="js/auto-complete.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>

  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script>
function initialize() {
  var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
  var mapOptions = {
    zoom: 4,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Hello World!'
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script> 

  </head>
  <body>
		<header class="clearfix">
		    <div class="logo col-md-3"><h2 class="logo-text">LUMD Annuaire</h2></div>
		    <nav class="clearfix">
            <ul class="clearfix">
                <li><a href="./index.php" >Acceuil</a></li>
                <li><a href="./annuair.php" class="active">Annuaire</a></li>
                <li><a href="./Espace_Entreprise.php">Espace Entreprise</a></li>
                <li><a href="./Forum.php">Forum</a></li>
                <li><a href="./contact.php">contact</a></li>
                <li><a href="#" class="last">Apropos</a></li>
            </ul>
        </nav>
        <div class="pullcontainer">
        <a href="#" id="pull"><i class="fa fa-bars fa-2x"></i></a>
        </div>     
		</header>
  
<div class="container">
<br>
<form  role="search" class="form-horizontal" method="get" action="">
<fieldset>
<legend style="font-size: 17px!important;"><h2>Commencer votre recherche</h2></legend>
<div class="form-group">
  <label class="col-md-4 control-label" for="appendedtext">Chercher une entreprise</label>
  <div class="col-md-6">
   <div class="input-group">
      <input  name="serch" class="form-control" placeholder="chercher..." type="text"  id="company" list="datalist">
 <span class="input-group-addon">
    <button type="submit" name="submitserch"><span class="glyphicon glyphicon-search"></span></button></span></div><div id="results">
  	</div>
     
    </div></div>
<div class="form-group">
  <label class="col-md-4 control-label" for="secteur">Secteur </label>
  <div class="col-md-6">
    <select id="secteur" name="secteur" class="form-control" onchange="filiere(this.value)">
      <option value="0">saisir le secteur</option>
      <?php 
include('./fonction/Function.php');
$domaines=afficher_domaine();

while($domaine = mysql_fetch_assoc($domaines)){
?>
<option value="<?php echo $domaine['id_domaine']; ?>"><?php echo $domaine['nom_domaine']; ?></option>
<?php
}
?>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="branche">Branches d'activités</label>
  <div class="col-md-6" id="txtHint">
    <select id="branche" name="branche" class="form-control">
      <option value="0"></option>
      
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
<label class="col-md-4 control-label" for="Gouvernorat">Région/Ville</label>
  <div class="col-md-3">
    <select id="Gouvernorat" name="Gouvernorat" class="form-control" onchange="departemens(this.value)" >
       <?php 
$regions=afficher_regions();

while($region = mysql_fetch_assoc($regions)){
?>
<option value="<?php echo $region['num_region']; ?>"><?php echo $region['nom']; ?></option>
<?php
}
?>
    </select>
  </div>
  
  <div class="col-md-3" id="departement">
    <select id="ville" name="ville" class="form-control">
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="commenter"></label>
  <div class="col-md-3">
    <button id="chercher" name="chercher" class="btn btn-invert btn-block">Chercher</button>
  </div>
</div>
</fieldset>
</form>
 <?php

$nom="";
$branche=""; 
$adresse="";
if(isset($_GET['chercher'])){

if(!empty($_GET['serch'])){
$nom=$_GET['serch'];
}
if($_GET['ville']!=0){
$adresse=$_GET['ville'];
}
if($_GET['branche']!=0){
$branche=$_GET['branche'];
}
$entreprises=resultatRecherche($nom, $branche, $adresse);
$nb=mysql_num_rows($entreprises);
if($nb>0){
echo "<p style=\"color:rgba(10, 115, 12, 0.8); font-size:20px;font-weight : bold;\">Resultat obtenu : ".$nb." entreprises.</p>";
?>
<table class="table table-hover">
    <thead>
      <tr><th></th>
        <th>Nom de l'entreprise</th>
        
        <th>adresse</th>
        
      </tr>
    </thead>
    <tbody>
<?php
while($entreprise = mysql_fetch_assoc($entreprises)) {
$filiere=recuperer_filiere($entreprise['id']);
$domaine=recuperer_domaine($filiere['id_domaine']);
?>
      <tr onclick="document.location='./entreprise/index.php?entreprise=<?php echo $entreprise['id'];?>'">
        <td><img src="avatars/<?php echo $entreprise['logo'];?>" widht="25" height="20"></td>
        <td><?php echo $entreprise['nom'];?></td>
        <!--<td><span style="color:rgba(164, 255, 49, 0.86);">Site Web :</span> <a href=""><?php echo $entreprise['site_web'];?></a><br>
<span style="color:rgba(164, 255, 49, 0.86);">Mail :</span> <?php echo $entreprise['mail_responsable'];?></td>
        --><td><?php echo $entreprise['adresse'];?><br><p style="color:rgba(10, 115, 12, 0.8); font-size:12px;font-weight : bold;cursor:pointer;">Plus de details...</p></td>
       <!-- <td><?php echo $domaine['nom_domaine'];?></td>
        <td><?php echo $filiere['nom_filiere'];?></td>-->
      </tr>
<?php
}
?>
</tbody>
  </table>
<?php
}
}
?>
 
        
       </div> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/unslider.min.js"></script>

</body></html>
