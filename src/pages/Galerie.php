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
  <title>Galerie | <?php echo $_SESSION['infos']['nom']; ?></title>
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
<style>
.galerie  li{
     position:relative;float:left;
     width:100px;height:100px;padding:10px;list-style:none;
}
/*permet de créer deux lignes*/
.galerie  li:nth-child(4n){clear:right;} 
          
.galerie  li a{
     display:block;overflow:hidden;
     width:100px;height:100px;
     margin-top:0px;margin-left:0px;
     border:0px solid rgba(0,0,0,0.7);
     transition-property:width,height,margin,z-index,border;
     transition-duration:0.4s;
}

.galerie  li a:hover,#imageGalerie{
     position:absolute;
     width:200px;height:200px;
    
     z-index:100;
     border:6px solid rgba(0,0,0,0.7);
}
.galerie  li a:hover{
     position:absolute;
     width:200px;height:200px;
     margin-top:-56px;margin-left:-56px;
     z-index:100;
     border:6px solid rgba(0,0,0,0.7);
}
          
.galerie  li a img{
     position:absolute;
     width:100px;height:100px;z-index:20;
     transition-property:width,height,z-index;
     transition-duration:0.4s;
}
          
.galerie  li a:hover img{
     width:200px;height:200px;
     z-index:100;
}
#imageGalerie{
    width:15px !important;
    height:15px !important;  
    margin-left:0px!important;
    right:1px!important;
}

.article{
     width: 100%;
     height: 1000px;
     border-style: double !important;
     border-color: #000000;
}
.cadre p{
 font-size: 2em;
color: #906868;}
.cadre{
     width: 100%;
     height: 1000px;
     border-style: double !important;
     border-color: #000000;
     background-color: rgba(255, 255, 255, 0.43);
}
.cadre1{
     width: 50%;
     height: 50%;
     border-style: double !important;
     border-color: #000000;
     background-color: rgba(255, 255, 255, 0.43);
}
    </style>
    

    
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
        
        <li><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php print_r($_SESSION['infos']['mail_responsable']);?><span class="caret"></span></a>
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
        <li class="dropdown active">
        <a href="Galerie.php"><span class="glyphicon glyphicon-picture blue"></span> Galerie</a>
      

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
<div class="col-md-8">

<legend><center><p>Votre galerie</p></center><form class="form-horizontal" action="" method="post">
<a href="#"data-toggle="modal" data-target="#AjouterGalerie" class="btn btn-success">Ajouter une photo</a><?php
$photos=afficher_galerie($_SESSION['infos_generale']['id_entreprise']);
$nb=mysql_num_rows($photos);
if($nb>0){
?>

<button type="submit" id="submit" name="CheckAll" class="btn btn-success "><span class="glyphicon glyphicon-check"> Selectionner Tous</span></button>
<input type="submit" id="submit" name="unCheckAll" class="btn btn-warning " value="annuler">
<?php
}
?>
</form>

</legend>
<?php

if($nb>0){
?>
<form class="form-horizontal" action="" method="post">
<button type="submit" id="submit" name="supprimerPhoto" class="btn btn-danger "><span class="glyphicon glyphicon-trash"> Supprimer</span></button>

        <ul class="galerie">
<?php
}else{
echo "Pas d'images pour l'instant.";}
$sel="";
if(isset($_POST['CheckAll'])){
$sel="checked";
}
if(isset($_POST['unCheckAll'])){
$sel="";
}
while($photo = mysql_fetch_assoc($photos)){
echo" <li>
          <a href=\"#\">
<img src=\"avatars/".$photo['url']."\"  />
          <strong>".$photo['titre']."</strong><input type=\"checkbox\" name=\"check_list[]\" id=\"imageGalerie\" value=".$photo['id']." ".$sel.">
          </a>
     </li>



";
}
?>
<?php
if(isset($_POST['supprimerPhoto'])){
if(!empty($_POST['check_list'])) {
foreach($_POST['check_list'] as $selected) {

//appel à la fonction de suppression
supprimer_Photo($_SESSION['infos_generale']['id_entreprise'],$selected);
}
}
echo "<script language=\"javascript\">waitingDialog.show();setTimeout(function () {waitingDialog.hide();}, 4000);</script>";
?><meta http-equiv="refresh" content="1" /><?php

}
?>  
</ul>
</form>
   


</div>




<?php include('Modal.html');?>

<script src="js/functions.js"></script>
<script src="js/scripts.js"></script>
    <script src="js/unslider.min.js"></script>
</body>
</html>

