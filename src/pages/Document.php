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
  <title>Document | <?php echo $_SESSION['infos']['nom']; ?></title>
  <link rel="shortcut icon" href="../avatars/<?php echo $_SESSION['infos']['logo']; ?>">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/bootstrap_3.min.css">

 <link rel="stylesheet" type="text/css"  href="css/smart-forms.css">
    <link rel="stylesheet" href="css/queries.css">
 <meta name="description" content="">
    <meta name="author" content="firas" >

    
    <!-- Bootstrap Core CSS -->
    

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
        <li class="active"><a href="Document.php"><span class="glyphicon glyphicon-file blue"></span> Documents</a></li>
        <li><a href="Produit.php"><span class="glyphicon glyphicon-shopping-cart blue"></span> Produits</a></li>
        <li><a href="Service.php"><span class="glyphicon glyphicon-wrench blue"></span> Services</a></li>
        <li><a href="Offre.php"><span class="glyphicon glyphicon-transfer blue"></span> Appel d'offre</a></li>
        <li><a href="Annonce.php"><span class="glyphicon glyphicon-bullhorn blue"></span> Annonces</a></li>
        <li><a href="Emploi.php"><span class="glyphicon glyphicon-tags blue"></span> Offre d'emplois</a></li>
        <li><a href="Actualite.php"><span class="glyphicon glyphicon-bookmark blue"></span> Actualités</a></li>
        </ul>
</div>
<div class="col-md-8">

<legend><center><p>Vos Documents</p></center><a href="#"data-toggle="modal" data-target="#AjouterDocument" class="btn btn-success">Ajouter un nouveau document</a></legend>
<!--<table class="table table-striped"> -->
<form class="form-horizontal" action="" method="post">
<?php
$documents=afficher_document($_SESSION['infos_generale']['id_entreprise']);
if(mysql_num_rows($documents)>0){?>
 <table id="table" class="table table-hover table-bordered" cellspacing="0">                
         <thead> 
                 <tr> 
                 <th>Titre </th>
                 <th> date de creation</th>
                 <th> couverture</th>
                 <th> <button type="submit" id="submit" name="CheckAll" class="btn btn-success "><span class="glyphicon glyphicon-check"> Selectionner Tous</span></button> 
                      <input type="submit" id="submit" name="unCheckAll" class="btn btn-warning " value="annuler">
                      <button type="submit" id="submit" name="supprimerDocument" class="btn btn-danger"><span class="glyphicon glyphicon-trash"> Supprimer</span></button>               
 </th> 
                 </tr> 
         </thead> 
         <tbody> 
<?php
$sel="";
if(isset($_POST['CheckAll'])){
$sel="checked";
}
if(isset($_POST['unCheckAll'])){
$sel="";
}

while($document = mysql_fetch_assoc($documents)) {
echo "<tr><td>".$document['titre']."</td><td>".$document['date_creation']."</td><td><img src=\"./Document/".$document['couverture']."\" width=\"75\" height=\"50\"></td><td> <input type=\"checkbox\" name=\"check_list[]\" id=\"document-0\" value=".$document['id_document']." ".$sel."></td></tr>";
}
?>            
    

        </tbody> 
</table>
<?php
}else{

echo"Pas de document pour l'instant.";

}
?>
</form>

<?php
 
if(isset($_POST['supprimerDocument'])){
if(!empty($_POST['check_list'])) {
foreach($_POST['check_list'] as $selected) {

//appel à la fonction de suppression
supprimer_Document($_SESSION['infos_generale']['id_entreprise'],$selected);
}
}
echo "<script language=\"javascript\">waitingDialog.show();setTimeout(function () {waitingDialog.hide();}, 4000);</script>";
?><meta http-equiv="refresh" content="1" /><?php

}
?>      

</div>

<!--<?php include('formulaire3.html');?>-->

<!--Modal Ajouter Document-->
<div class="modal fade" id="AjouterDocument" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><center>Document</center></h4>
<?php

if(isset($_POST['ajouterDocument'])){

if(!empty($_POST['titre'])){
$titre=$_POST['titre'];
}
if(!empty($_POST['date'])){
$date=$_POST['date'];
}
if(!empty($_POST['description'])){
$urlftp=htmlentities(trim($_POST['urlftp']));
}
//if (!empty(htmlentities($_FILES['couverture']))){
$couverture=$_FILES['couverture']['name'];
$couverture_tmp=$_FILES['couverture']['tmp_name'];
move_uploaded_file($couverture_tmp,'Document/'.$couverture);
//}
ajouter_Document($titre,$date,$urlftp,$couverture,$_SESSION['infos_generale']['id_entreprise']);
echo "<script language=\"javascript\">waitingDialog.show();setTimeout(function () {waitingDialog.hide();}, 4000);</script>";
?><meta http-equiv="refresh" content="1" /><?php
}
?>
        </div>
        <div class="modal-body">
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
<fieldset>
<h4 style="color:rgb(68, 145, 152);font-size:26px;text-decoration: underline;">Ajouter un Document</h4>
          <div class="generale" style="border-left-style: outset;
  border-left-width: initial;border-bottom-style: outset;
  border-bottom-width: initial;margin-top: 25px;margin-bottom: 25px;">
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Titre">Titre du document</label>  
  <div class="col-md-5">
  <input id="Titre" name="titre" type="text" placeholder="Titre du document..." class="form-control input-md" autofocus required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Date">Date de creation</label>  
  <div class="col-md-4">
  <input id="Date" name="date" type="Date" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="Description">Url Ftp</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="Description" name="description" placeholder="saisir l'url ftp..." required=""></textarea>
  </div>
</div>
<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="couverture">Couverture</label>
  <div class="col-md-4">
<input type="file" id="couverture" name="couverture" class="myButton" required="">
<img src="./img/image.png" width="75" height="75" class="img-responsive push">
 <br>
   
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-8">
    <input type="submit" id="submit" name="ajouterDocument" class="btn btn-success " value="Valider">
    <button id="annuler" name="annuler" class="btn btn-danger" data-dismiss="modal">Annuler</button>
  </div>
</div>
</div>
</div>
<!-- Button (Double) -->


</fieldset>
</form>


        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<?php include('Modal.html');?>

<script src="js/functions.js"></script>
<script src="js/scripts.js"></script>
    <script src="js/unslider.min.js"></script>
</body>
</html>

