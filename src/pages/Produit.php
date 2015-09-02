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
  <title>Produit | <?php echo $_SESSION['infos']['nom']; ?></title>
  <link rel="shortcut icon" href="../avatars/<?php echo $_SESSION['infos']['logo']; ?>">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/bootstrap_3.min.css">
<link rel="stylesheet" href="css/produit.css">
    
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
       
        <li class="active"><a href="Produit.php">Produits</a></li>
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
        <li class="active"><a href="Produit.php"><span class="glyphicon glyphicon-shopping-cart blue"></span> Produits</a></li>
        <li><a href="Service.php"><span class="glyphicon glyphicon-wrench blue"></span> Services</a></li>
        <li><a href="Offre.php"><span class="glyphicon glyphicon-transfer blue"></span> Appel d'offre</a></li>
        <li><a href="Annonce.php"><span class="glyphicon glyphicon-bullhorn blue"></span> Annonces</a></li>
        <li><a href="Emploi.php"><span class="glyphicon glyphicon-tags blue"></span> Offre d'emplois</a></li>
        <li><a href="Actualite.php"><span class="glyphicon glyphicon-bookmark blue"></span> Actualités</a></li>
        </ul>
</div>
<div class="col-md-8">
<legend><center><p>Vos Produits</p></center>
<a href="#"data-toggle="modal" data-target="#AjouterProduit" class="btn btn-success">Ajouter un nouveau Produit</a>
<a href="#"data-toggle="modal" data-target="#AjouterTypeProduit" class="btn btn-success">Ajouter un nouveau Type de Produit</a>
<a href="#"data-toggle="modal" data-target="#SupprimerProduit"  class="btn btn-danger"><span class="glyphicon glyphicon-trash"> </span> Supprimer Produit</a>
</legend>
<?php 
$produits=afficher_produit($_SESSION['infos_generale']['id_entreprise']);
if(mysql_num_rows($produits)>0){
while($produit = mysql_fetch_assoc($produits)) {
echo "<div class=\"col-md-4\">
        <div class=\"ca-hover\">
          <div class=\"carousel-img\">
            <img src=\"Produit/".$produit['image']."\" alt=\"Carousel Img\" >
          </div>
          
          <div class=\"carousel-content\">
            <h3>".$produit['nom_produit']."</h3>
            <p>".$produit['description']."</p>
          </div>
        <div class=\"overlay\"></div>
        </div>
        </div>";}
}else{

echo"Pas de produit pour l'instant, veuillez ajouter des produits.";
}
?>

       

</div>

<!--<?php include('formulaire3.html');?>-->
<?php include('Modal.html');?>

<script src="js/functions.js"></script>
<script src="js/scripts.js"></script>
    <script src="js/unslider.min.js"></script>
</body>
</html>

