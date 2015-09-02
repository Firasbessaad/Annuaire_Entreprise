<!DOCTYPE html>
<?php
session_start();
include('fonction/Function.php');
if (!isset($_SESSION['infos_generale']['login'])) 
{
header('Location: index.php');
}

?>
<html lang="en">
<head>
  <title>Actualité | <?php echo $_SESSION['infos']['nom']; ?></title>
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
    <script src="js/loding.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
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
            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
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
<div class="col-md-3">
<ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#"><img src="./avatars/<?php echo $_SESSION['infos']['logo'];?>" width="25" height="25"> Home</a></li>
        <li class="dropdown">
          <a href="EspacEntreprise.php"> <span class="glyphicon glyphicon-th blue"></span> Agences</a>
         
        </li>
        <li>
        <a href="Galerie.php"><span class="glyphicon glyphicon-picture blue"></span> Galerie</a>
      

        </li>
        <li><a href="Document.php"><span class="glyphicon glyphicon-file blue"></span> Documents</a></li>
        <li><a href="Produit.php"><span class="glyphicon glyphicon-shopping-cart blue"></span> Produits</a></li>
        <li><a href="Service.php"><span class="glyphicon glyphicon-wrench blue"></span> Services</a></li>
        <li><a href="Offre.php"><span class="glyphicon glyphicon-transfer blue"></span> Appel d'offre</a></li>
        <li><a href="Annonce.php"><span class="glyphicon glyphicon-bullhorn blue"></span> Annonces</a></li>
        <li><a href="Emploi.php"><span class="glyphicon glyphicon-tags blue"></span> Offre d'emplois</a></li>
        <li class="active"><a href="Actualite.php"><span class="glyphicon glyphicon-bookmark blue"></span> Actualités</a></li>
        </ul>
</div>
<div class="col-md-8">

<legend><center><p>Vos Actualités</p></center><a href="#"data-toggle="modal" data-target="#AjouterActualite" class="btn btn-success">Ajouter une actualité</a></legend>
<?php
if(isset($_POST['sauvgarder'])){
$titre=htmlspecialchars($_POST['titre'],ENT_QUOTES);
$details=htmlspecialchars($_POST['details'],ENT_QUOTES);
$image=$_POST['image'];
$date=$_POST['date'];
$type=$_POST['type'];
ajouter_actualite($_SESSION['infos_generale']['id_entreprise'],$titre,$details,$image,$date,$type);
echo "<script language=\"javascript\">waitingDialog.show();setTimeout(function () {waitingDialog.hide();}, 4000);</script>";
?><meta http-equiv="refresh" content="1" /><?php
}

$actualites=recup_actualite($_SESSION['infos_generale']['id_entreprise']);
$nb=mysql_num_rows($actualites);
if($nb>0){?>
<form action='' method='post'>
 <table id="table" class="table table-hover table-bordered" cellspacing="0" >                
         <thead> 
                 <tr> 
                 <th style="width:100px;">Titre </th>
                 <th> Details</th>
                 <th> couverture</th>
                 <th> date</th>
                 <th> type</th> 
                 <th> </th> 
                 </tr> 
         </thead> 
         <tbody> 

<?php
$compteur=0;
while($actualite = mysql_fetch_assoc($actualites)) { 
echo "<tr id=\"".$actualite['id_actualite']."\" >
<td><input id=\"".$actualite['id_actualite']."t".$compteur."\" onclick=\"modifier_actualite(this.id,'t');\" type=\"text\" name=\"Mtitre".$actualite['id_actualite']."\" value=\"".$actualite['titre']."\"></td>
<td> <textarea id=\"".$actualite['id_actualite']."d".$compteur."\" onclick=\"modifier_actualite(this.id,'d');\"  name=\"Mdetails".$actualite['id_actualite']."\" rows=\"8\" >".$actualite['details']."</textarea></td>
<td><input id=\"".$actualite['id_actualite']."i".$compteur."\" onclick=\"modifier_actualite(this.id,'i');\" type=\"text\" name=\"Mimage".$actualite['id_actualite']."\" value=\"".$actualite['image']."\"></td>
<td><input id=\"".$actualite['id_actualite']."j".$compteur."\" onclick=\"modifier_actualite(this.id,'j');\"  type=\"date\" name=\"Mdate".$actualite['id_actualite']."\" value=\"".$actualite['date_actualite']."\"></td>
<td><input id=\"".$actualite['id_actualite']."y".$compteur."\" onclick=\"modifier_actualite(this.id,'y');\" type=\"text\" name=\"Mtype".$actualite['id_actualite']."\" value=\"".$actualite['type']."\"></td>
</tr>";
$last=$actualite['id_actualite'];
$compteur++;
}
?>

        </tbody> 
</table>
<?php
}else{

echo"Pas d'actualité pour l'instant.";

}
for($i=0;$i<100+1;$i++){

if(isset($_POST[$i.'m'])){
$titre=htmlspecialchars($_POST['Mtitre'.$i],ENT_QUOTES);
$details=htmlspecialchars($_POST['Mdetails'.$i],ENT_QUOTES);
$image=$_POST['Mimage'.$i];
$date=$_POST['Mdate'.$i];
$type=$_POST['Mtype'.$i];
Modifier_actualite($_SESSION['infos_generale']['id_entreprise'],$titre,$details,$image,$date,$type,$i);
echo "<script language=\"javascript\">waitingDialog.show();setTimeout(function () {waitingDialog.hide();}, 4000);</script>";
?><meta http-equiv="refresh" content="1" /><?php
}
if(isset($_POST[$i.'s'])){
supp_actualite($_SESSION['infos_generale']['id_entreprise'],$i);
echo "<script language=\"javascript\">waitingDialog.show();setTimeout(function () {waitingDialog.hide();}, 4000);</script>";
?><meta http-equiv="refresh" content="1" /><?php
}
}
?>
       
</form>
</div>

<!--<?php include('formulaire3.html');?>-->
<?php include('Modal.html');?>
<script>
function modifier_actualite(id,str){
var n = id.indexOf(str);
var idligne= id.substring(n+1,n+2);
var rowid = id.substring(0,n);
var longueur = document.getElementById("table").rows[idligne].cells.length;

var row = document.getElementById(rowid);
    var x = row.insertCell(5);
    x.innerHTML = "<button  class='btn btn-success' name='"+rowid+"m'><span class=\"glyphicon glyphicon-pencil\"></span></button><br><br><button id='"+rowid+"a' name='annuler' class='btn btn-warning' onclick='annuler(this.id);'>X</button><br><br><button id='"+rowid+"s' name='"+rowid+"s' class='btn btn-danger'><span class=\"glyphicon glyphicon-trash\"></span></button>";
};

function annuler(id){
var n = id.indexOf("a");
var rowid = id.substring(0,n);
var row = document.getElementById(rowid);
row.deleteCell(5);
};

</script>
<script src="js/functions.js"></script>
<script src="js/scripts.js"></script>
    <script src="js/unslider.min.js"></script>
</body>
</html>

