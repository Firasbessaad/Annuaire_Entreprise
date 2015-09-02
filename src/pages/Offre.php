<!DOCTYPE html>
<?php
session_start();
include('fonction/Function.php');
if (!isset($_SESSION['infos_generale']['login'])) 
{
header('Location: index.php');
}
?>
<html lang="fr">
<head>
  <title>Appel d'offre  | <?php echo $_SESSION['infos']['nom']; ?></title>
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
        <li class="active"><a href="Offre.php"><span class="glyphicon glyphicon-transfer blue"></span> Appel d'offre</a></li>
        <li><a href="Annonce.php"><span class="glyphicon glyphicon-bullhorn blue"></span> Annonces</a></li>
        <li><a href="Emploi.php"><span class="glyphicon glyphicon-tags blue"></span> Offre d'emplois</a></li>
        <li><a href="Actualite.php"><span class="glyphicon glyphicon-bookmark blue"></span> Actualités</a></li>
        </ul>
</div>
<div class="col-md-8">

<legend><center><p>Vos Offres d'appel</p></center><a href="#"data-toggle="modal" data-target="#AjouterOffre" class="btn btn-success">Ajouter un offre d'emploi</a></legend>
<form class="form-horizontal" action="" method="post">
<?php
$appels=afficher_appel($_SESSION['infos_generale']['id_entreprise']);
if(mysql_num_rows($appels)>0){?>
 <table id="table" class="table table-hover table-bordered" cellspacing="0">                
         <thead> 
                 <tr> 
                 <th>Nom </th>
                 <th>Ref </th>
                 <th>Date</th>
                 <th>Description</th>
                 <th> <button type="submit" id="submit" name="CheckAll" class="btn btn-success "><span class="glyphicon glyphicon-check">Selectionner Tous</span></button><input type="submit" id="submit" name="unCheckAll" class="btn btn-warning " value="annuler"><button type="submit" id="submit" name="supprimerAppel" class="btn btn-danger"><span class="glyphicon glyphicon-trash">Supprimer</span></button>               
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

while($appel = mysql_fetch_assoc($appels)) {
echo "<tr id=\"".$appel['id']."\"><td>".$appel['nom']."</td><td>".$appel['ref']."</td><td>".$appel['Date']."</td><td>".$appel['description']."</td><td><span class=\"glyphicon glyphicon-trash btn btn-danger\" ><input type=\"checkbox\" name=\"check_list[]\" id=\"document-0\" value=".$appel['id']." ".$sel."></span> <span id=\"".$appel['id']."M\" onclick=\"modifier_appel(this.id);\" class=\"glyphicon glyphicon-pencil btn btn-success\" ></span></td></tr>";
}
?>            
    

        </tbody> 
</table>
<?php
}else{

echo"Pas d'appel d'offre pour l'instant.";

}
?>
</form>

<?php
 
if(isset($_POST['supprimerAppel'])){
if(!empty($_POST['check_list'])) {
foreach($_POST['check_list'] as $selected) {

//appel à la fonction de suppression
supprimer_Appel($_SESSION['infos_generale']['id_entreprise'],$selected);
}
}
echo "<script language=\"javascript\">waitingDialog.show();setTimeout(function () {waitingDialog.hide();}, 4000);</script>";
?><meta http-equiv="refresh" content="1" /><?php

}
?>      

       

</div>

<div class="modal fade" id="AjouterOffre" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><center>Offre d'appel</center></h4>
<?php
if(isset($_POST['ajouterappel'])){
$nomAppel=htmlspecialchars($_POST['nomAppel'],ENT_QUOTES);
$description=htmlspecialchars($_POST['description'],ENT_QUOTES);
$ref=$_POST['ref'];
$date=$_POST['date'];
ajouter_Appel($_SESSION['infos_generale']['id_entreprise'],$nomAppel,$description,$ref,$date);
echo "<script language=\"javascript\">waitingDialog.show();setTimeout(function () {waitingDialog.hide();}, 4000);</script>";
?><meta http-equiv="refresh" content="1" /><?php
}
?>
        </div>
        <div class="modal-body">
         <h4 style="color:rgb(68, 145, 152);font-size:26px;text-decoration: underline;">Ajouter un Appeld'offre</h4>

          <div class="generale" style="border-left-style: outset;
  border-left-width: initial;border-bottom-style: outset;
  border-bottom-width: initial;margin-top: 25px;margin-bottom: 25px;">   
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
<fieldset>


<div class="form-group">
  <label class="col-md-4 control-label" for="nomAppel">Nom Appel</label>  
  <div class="col-md-5">
  <input id="nomAppel" name="nomAppel" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="description">Description</label>
  <div class="col-md-6">                     
    <textarea class="form-control" id="description" name="description" required=""></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="date">Date</label>  
  <div class="col-md-5">
  <input id="date" name="date" type="date" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="ref">Ref</label>  
  <div class="col-md-5">
  <input id="ref" name="ref" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="button1id"></label>
  <div class="col-md-8">
    <button id="ajouterappel" name="ajouterappel" class="btn btn-success">Ajouter</button>
    <button id="button2id" name="button2id" class="btn btn-danger" data-dismiss="modal">Annuler</button>
  </div>
</div>
</fieldset>
</form>
</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>





<div class="modal fade" id="ModifierOffre" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><center>Offre d'appel</center></h4>
<?php
if(isset($_POST['modifierappel'])){
$MnomAppel=htmlspecialchars($_POST['MnomAppel'],ENT_QUOTES);
$Mdescription=htmlspecialchars($_POST['Mdescription'],ENT_QUOTES);
$Mref=$_POST['Mref'];
$Mdate=$_POST['Mdate'];
Modifier_Appel($_POST['idoffre'],$MnomAppel,$Mdescription,$Mref,$Mdate);
echo "<script language=\"javascript\">waitingDialog.show();setTimeout(function () {waitingDialog.hide();}, 4000);</script>";
?><meta http-equiv="refresh" content="1" /><?php
}
?>
        </div>
        <div class="modal-body">
         <h4 style="color:rgb(68, 145, 152);font-size:26px;text-decoration: underline;">Modifier un Appeld'offre</h4>

          <div class="generale" style="border-left-style: outset;
  border-left-width: initial;border-bottom-style: outset;
  border-bottom-width: initial;margin-top: 25px;margin-bottom: 25px;">   
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
<fieldset>


<div class="form-group">
  <label class="col-md-4 control-label" for="MnomAppel">Nom Appel</label>  
  <div class="col-md-5">
  <input id="MnomAppel" name="MnomAppel" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Mdescription">Description</label>
  <div class="col-md-6">                     
    <textarea class="form-control" id="Mdescription" name="Mdescription" required=""></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="Mdate">Date</label>  
  <div class="col-md-5">
  <input id="Mdate" name="Mdate" type="date" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Mref">Ref</label>  
  <div class="col-md-5">
  <input id="Mref" name="Mref" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="button1id"></label>
  <div class="col-md-8">

    <input type="hidden" id="idoffre" name="idoffre">
    <button id="modifierappel" name="modifierappel" class="btn btn-success">Sauvgarder</button>
    <button id="button2id" name="button2id" class="btn btn-danger" data-dismiss="modal">Annuler</button>
  </div>
</div>
</fieldset>
</form>
</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>





<?php include('Modal.html');?>
<script>
function modifier_appel(idM){
var n = idM.indexOf("M");
var id = idM.substring(0,n);
var titre = document.getElementById(id).cells[0].innerHTML;
var ref = document.getElementById(id).cells[1].innerHTML;
var date = document.getElementById(id).cells[2].innerHTML;
var desc = document.getElementById(id).cells[3].innerHTML;
document.getElementById("MnomAppel").value= titre;
document.getElementById("Mdescription").value= desc;
document.getElementById("Mdate").value= date;
document.getElementById("Mref").value= ref;
document.getElementById("idoffre").value= id;
$("#ModifierOffre").modal();
};
</script>
<script src="js/functions.js"></script>
<script src="js/scripts.js"></script>
    <script src="js/unslider.min.js"></script>
</body>
</html>

