<?php
session_start();
$errors="";
if (isset($_SESSION['infos_generale']['login'])) 
{
header('Location: EspacEntreprise.php');
}
include ('fonction/Function.php');

if(isset($_POST['seconnecter'])){
$mail=$_POST['mail'];
$password=$_POST['password'];

if(connexion($mail,$password)==1) {
	session_start();
	//$_SESSION['mail']=$mail;
        //$_SESSION['password']=$password;
        $infos_generale=recuperer_info_generale($mail);
        $_SESSION['infos_generale']=$infos_generale;
        $infos=recuperer_info($_SESSION['infos_generale']['id_entreprise']);
        $_SESSION['infos']=$infos;
	header('Location: ./EspacEntreprise.php'); 
}else{
$errors="<div class='panel panel-red'>
                        <div class='panel-heading'>
                            Erreur
                        </div>
                        <div class='panel-body'><center><p style='color: red;'>mail/password incorrectes!</p></center></div></div>";	
}}
if(isset($_POST['sincrire'])){
//info compte
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$fonction=$_POST['fonction'];
$mail=$_POST['mail'];
$mobile_phone_responsable=$_POST['mobile_phone_responsable'];

$password=$_POST['password'];
//info entreprise
$nomEntreprise=$_POST['nomEntreprise'];
$adresse=$_POST['adresse'];
$home_phone=$_POST['mobile_phone'];
$fax=$_POST['fax'];
$numeroSiren=$_POST['numSiren'];
$filiere=$_POST['filiere'];
$domaine=$_POST['domaine'];
$logo=$_FILES['upload1']['name'];
$logo_tmp=$_FILES['upload1']['tmp_name'];
move_uploaded_file($logo_tmp,'avatars/'.$logo);
$website=$_POST['website'];
$dateCreation=$_POST['date_creation'];
sincrire($nom,$prenom,$mail,$mobile_phone_responsable,$home_phone,$password,$adresse,$fonction,$nomEntreprise,$fax,$numeroSiren,$website,$dateCreation,$logo,$filiere,$domaine);
header('Location: Espace_Entreprise.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">  
    <title>LUMD Annuaire</title>

    <link rel="stylesheet" type="text/css"  href="css/smart-forms.css">
    <link rel="stylesheet" type="text/css"  href="css/font-awesome.min.css">
    
    
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/additional-methods.min.js"></script>
 <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/queries.css">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	  <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
    
    <!--[if lte IE 9]>   
        <script type="text/javascript" src="js/jquery.placeholder.min.js"></script>
    <![endif]-->    
    
    <!--[if lte IE 8]>
        <link type="text/css" rel="stylesheet" href="css/smart-forms-ie8.css">
    <![endif]-->
    
    <script type="text/javascript">
	
		$(function() {
		
				/* @custom validation method (smartCaptcha) 
				------------------------------------------------------------------ */
					
				$.validator.methods.smartCaptcha = function(value, element, param) {
						return value == param;
				};
                                  var x= Math.floor(Math.random() * (100 - 1));var y=Math.floor(Math.random() * (100 - 1));var z=x+"+"+y+"=";
                                 document.getElementById("somme").innerHTML = z;
						
				$( "#smart-form" ).validate({
				
						/* @validation states + elements 
						------------------------------------------- */
						
						errorClass: "state-error",
						validClass: "state-success",
						errorElement: "em",
						
						/* @validation rules 
						------------------------------------------ */
						
						rules: {
								firstname: {
										required: true
								},
								lastname: {
										required: true
								},					
								useremail: {
										required: true,
										email: true
								},
								website: {
										required: true,
										url: true
								},								
								language: {
										required: true
								},								
								upload1:  {
										required: true,
										extension:"jpg|png|gif|jpeg|doc|docx|pdf|xls|rar|zip"
								},
								mobileos:  {
										required: true
								},
								comment:  {
										required: true,
										minlength: 30
								},
								mobile_phone: {
										require_from_group: [1, ".phone-group"]
								},
								home_phone: {
										require_from_group: [1, ".phone-group"]
								},											
								password:{
										required: true,
										minlength: 6,
										maxlength: 16						
								},
								repeatPassword:{
										required: true,
										minlength: 6,
										maxlength: 16,						
										equalTo: '#password'
								},
								gender:{
										required: true
								},
								languages:{
										required: true
								},			
								verification:{
										required:true,
										smartCaptcha: x+y
								},
								applicant_age: {
										required: true,
										min: 16
								},
								licence_no: {
										required: function(element) {
												return $("#applicant_age").val() > 19;
										}
								},
								child_name: {
										required: "#parents:checked"
								}																							
							
						},
						
						/* @validation error messages 
						---------------------------------------------- */
							
						messages:{
								firstname: {
										required: 'Enter first name'
								},
								lastname: {
										required: 'Enter last name'
								},					
								useremail: {
										required: 'Enter email address',
										email: 'Enter a VALID email address'
								},
								website: {
										required: 'Enter your website URL',
										url: 'URL should start with - http://www'
								},														
								language: {
										required: 'Choose a language'
								},						
								upload1:  {
										required: 'Please browse a file',
										extension: 'File format not supported'
								},
								mobileos:  {
										required: 'Please select a mobile platform'
								},								
								comment:  {
										required: 'Oops you forgot to comment',
										minlength: 'Enter at least 30 characters or more'
								},
								mobile_phone: {
										require_from_group: 'Fill at least a mobile contact'
								},
								home_phone: {
										require_from_group: 'Fill at least a home contact'
								},																				
								password:{
										required: 'Please enter a password'
								},
								repeatPassword:{
										required: 'Please repeat the above password',
										equalTo: 'Password mismatch detected'
								},
								gender:{
										required: 'Please choose specie'
								},
								languages:{
										required: 'Select laguages spoken'
								},																		
								verification:{
										required: 'Please enter verification code',
										smartCaptcha: 'Oops - enter a correct verification code'
								},
								applicant_age: {
										required: 'Enter applicant age',
										min: 'Must be 16 years and above'
								},
								licence_no: {
										required: 'Enter licence number'
								},
								child_name: {
										required: 'Please enter your childs name'
								}																			
						 
						},

						/* @validation highlighting + error placement  
						---------------------------------------------------- */	
						
						highlight: function(element, errorClass, validClass) {
								$(element).closest('.field').addClass(errorClass).removeClass(validClass);
						},
						unhighlight: function(element, errorClass, validClass) {
								$(element).closest('.field').removeClass(errorClass).addClass(validClass);
						},
						errorPlacement: function(error, element) {
						   if (element.is(":radio") || element.is(":checkbox")) {
									element.closest('.option-group').after(error);
						   } else {
									error.insertAfter(element.parent());
						   }
						}
								
				});		
		
		});				
    
$(function() {
		
				/* @custom validation method (smartCaptcha) 
				------------------------------------------------------------------ */
					
				$.validator.methods.smartCaptcha = function(value, element, param) {
						return value == param;
				};
                                  var x= Math.floor(Math.random() * (100 - 1));var y=Math.floor(Math.random() * (100 - 1));var z=x+"+"+y+"=";
                                 document.getElementById("somme").innerHTML = z;
						
				$( "#smart-form2" ).validate({
				
						/* @validation states + elements 
						------------------------------------------- */
						
						errorClass: "state-error",
						validClass: "state-success",
						errorElement: "em",
						
						/* @validation rules 

						------------------------------------------ */
						
						rules: {
								firstname: {
										required: true
								},
								lastname: {
										required: true
								},					
								newuseremail: {
										required: false,
										email: false
								},
								website: {
										required: true,
										url: true
								},								
								language: {
										required: true
								},								
								upload1:  {
										required: true,
										extension:"jpg|png|gif|jpeg|doc|docx|pdf|xls|rar|zip"
								},
								mobileos:  {
										required: true
								},
								comment:  {
										required: true,
										minlength: 30
								},
								mobile_phone: {
										require_from_group: [1, ".phone-group"]
								},
								home_phone: {
										require_from_group: [1, ".phone-group"]
								},											
								password:{
										required: true,
										minlength: 6,
										maxlength: 16						
								},
								repeatPassword:{
										required: true,
										minlength: 6,
										maxlength: 16,						
										equalTo: '#password2'
								},
								gender:{
										required: true
								},
								languages:{
										required: true
								},			
								verification:{
										required:true,
										smartCaptcha: x+y
								},
								applicant_age: {
										required: true,
										min: 16
								},
								licence_no: {
										required: function(element) {
												return $("#applicant_age").val() > 19;
										}
								},
								child_name: {
										required: "#parents:checked"
								}																							
							
						},
						
						/* @validation error messages 
						---------------------------------------------- */
							
						messages:{
								firstname: {
										required: 'Enter first name'
								},
								lastname: {
										required: 'Enter last name'
								},					
								newuseremail: {
										required: 'Enter email address',
										email: 'Enter a VALID email address'
								},
								website: {
										required: 'Enter your website URL',
										url: 'URL should start with - http://www'
								},														
								language: {
										required: 'Choose a language'
								},						
								upload1:  {
										required: 'Please browse a file',
										extension: 'File format not supported'
								},
								mobileos:  {
										required: 'Please select a mobile platform'
								},								
								comment:  {
										required: 'Oops you forgot to comment',
										minlength: 'Enter at least 30 characters or more'
								},
								mobile_phone: {
										require_from_group: 'Fill at least a mobile contact'
								},
								home_phone: {
										require_from_group: 'Fill at least a home contact'
								},																				
								password:{
										required: 'Please enter a password'
								},
								repeatPassword:{
										required: 'Please repeat the above password',
										equalTo: 'Password mismatch detected'
								},
								gender:{
										required: 'Please choose specie'
								},
								languages:{
										required: 'Select laguages spoken'
								},																		
								verification:{
										required: 'Please enter verification code',
										smartCaptcha: 'Oops - enter a correct verification code'
								},
								applicant_age: {
										required: 'Enter applicant age',
										min: 'Must be 16 years and above'
								},
								licence_no: {
										required: 'Enter licence number'
								},
								child_name: {
										required: 'Please enter your childs name'
								}																			
						 
						},

						/* @validation highlighting + error placement  

						---------------------------------------------------- */	
						
						highlight: function(element, errorClass, validClass) {
								$(element).closest('.field').addClass(errorClass).removeClass(validClass);
						},
						unhighlight: function(element, errorClass, validClass) {
								$(element).closest('.field').removeClass(errorClass).addClass(validClass);
						},
						errorPlacement: function(error, element) {
						   if (element.is(":radio") || element.is(":checkbox")) {
									element.closest('.option-group').after(error);
						   } else {
									error.insertAfter(element.parent());
						   }
						}
								
				});		
		
		});				
    </script>

<style>

.panel-red {
    border-color: #d9534f;
   
}

.panel-red .panel-heading {
    border-color: #d9534f;
    color: #fff;
    background-color: #d9534f;
    
}
.error{
font-family: sans-serif;
 font-weight: 500;
 font-size: 16px;
color: red;
border-radius: 5px;
-webkit-border-raius: 5px;
-moz-border-raius: 5px;
margin-top: 10px;
margin-left: 550px;

}
</style>
       
</head>

<body>
<header class="clearfix">
		    <div class="logo col-md-3"><h2 class="logo-text">LUMD Annuaire</h2></div>
		    <nav class="clearfix">
            <ul class="clearfix">
                <li><a href="./index.php" >Acceuil</a></li>
                <li><a href="./annuair.php">Annuaire</a></li>
                <li><a href="./Espace_Entreprise.php" class="active">Espace Entreprise</a></li>
                <li><a href="./Forum.php">Forum</a></li>
                <li><a href="./contact.php">contact</a></li>
                <li><a href="#" class="last">Apropos</a></li>
            </ul>
        </nav>
        <div class="pullcontainer">
        <a href="#" id="pull"><i class="fa fa-bars fa-2x"></i></a>
        </div>     
		</header><div class="container">
<!-- espace pub -->
<div class="col-md-3">

<br><br>
<!--  pub 1 -->
        

        </div>
<!--formulaire-->

<div class="col-md-6">
   <div class="box animated tile active">
	<div class="smart-wrap">
    	<div class="smart-forms smart-container wrap-2">
        
        	<div class="form-header header-primary">
            	<h4><i class="fa fa-pencil-square"></i>Bienvenu</h4>
            </div><!-- end .form-header section -->
            
            <form method="post" action="" id="smart-form" novalidate="novalidate">
            	<div class="form-body">
                
                    <div class="spacer-b30">
                    	<div class="tagline"><span> Se connecter </span></div><!-- .tagline -->
                    </div>
                    <?php echo $errors; ?>
                    <div class="frm-row">
                                
                       <div class="section">
                    	<label for="useremail" class="field prepend-icon">
                        	<input type="email" name="mail" id="useremail" class="gui-input" placeholder=" Votre adresse mail.. ">
                            <span class="field-icon"><i class="fa fa-envelope"></i></span>  
                        </label>
                    </div><!-- end section -->
                        
                       <div class="section">
                    	<label for="password" class="field prepend-icon">
                        	<input type="password" name="password" id="password" class="gui-input" placeholder="Tapez un mot de passe">
                            <span class="field-icon"><i class="fa fa-lock"></i></span>  
                        </label>
                    </div> 
<label class="option block">
                                    <input type="checkbox" name="session" value="active">
                                    <span class="checkbox"></span>Garder ma session active         
                                </label>
                    </div><!-- end .frm-row section -->                                    
                
                	
                <div class="form-footer">
                	<input type="submit" name="seconnecter" value="Se Connecter" class="button btn-primary">
                    <br><br><div class="tagline"><span><a class="box-switcher" data-switch="smart-form2" href="#">Pas encore inscrit?</a></span></div>
                </div><!-- end .form-footer section -->
            
            
        </div></form><!-- end .smart-forms section -->
    </div><!-- end .smart-wrap section -->
    
    </div></div>
<div class="box animated tile">
	<div class="smart-wrap">
    	<div class="smart-forms smart-container wrap-2">
        
        	<div class="form-header header-primary">

            	<h4><i class="fa fa-pencil-square"></i>S'inscrire</h4>

            </div><!-- end .form-header section -->
            
            <form method="post" action="" id="smart-form2" novalidate="novalidate"  enctype="multipart/form-data">
            	<div class="form-body">
                
                    <div class="spacer-b30">
                    	<div class="tagline"><span> Remplir ce formulaire </span></div><!-- .tagline -->
                    </div>
                    
                    <div class="frm-row">
                        <div class="section colm colm6">
                            <label for="firstname" class="field prepend-icon">
                                <input type="text" name="nom" id="firstname" class="gui-input" placeholder="Votre Nom...">
                                <span class="field-icon"><i class="fa fa-user"></i></span>  
                            </label>
                        </div><!-- end section -->
                        
                        <div class="section colm colm6">
                            <label for="lastname" class="field prepend-icon">
                                <input type="text" name="prenom" id="lastname" class="gui-input" placeholder="Votre prenom...">
                                <span class="field-icon"><i class="fa fa-user"></i></span>  
                            </label>
                        </div><!-- end section -->
                            <div class="section colm colm6">
                            <label for="fonction" class="field prepend-icon">
                                <input type="text" name="fonction" id="fonction" class="gui-input" placeholder="Votre fonction...">
                                <span class="field-icon"><i class="fa fa-user"></i></span>  
                            </label>
                        </div><!-- end section -->
                    </div><!-- end .frm-row section -->                                    
                
                	<div class="section">
                    	<label for="newuseremail" class="field prepend-icon">
                        	<input type="email" name="mail" id="newuseremail" class="gui-input" placeholder=" Votre adresse mail.. ">
                            <span class="field-icon"><i class="fa fa-envelope"></i></span>  
                        </label>
                    </div><!-- end section -->
                    <div class="section colm colm6">
                            <label for="mobile_phone_responsable" class="field prepend-icon">
                                <input type="tel" name="mobile_phone_responsable" id="mobile_phone_responsable" class="gui-input phone-group" placeholder="Numero de votre mobile">
                                <span class="field-icon"><i class="fa fa-mobile-phone"></i></span>  
                            </label>
                        </div>

                	<!-- end section --> 
                    
                    <div class="spacer-t40 spacer-b40">
                    	<div class="tagline"><span> Informations de votre Entreprise  </span></div><!-- .tagline -->
                    </div>                                         
                      <div class="section colm colm6">
                            <label for="Nom_entreprise" class="field prepend-icon">
                                <input type="text" name="nomEntreprise" id="NomEntreprise" class="gui-input" placeholder="Le nom de votre entreprise...">
                                <span class="field-icon"><i class="fa fa-user"></i></span>  
                            </label>
                        </div>
                        <div class="section colm colm6">
                            <label for="numSiren" class="field prepend-icon">
                                <input type="text" name="numSiren" id="numSiren" class="gui-input" placeholder="Le numero de SIREN...">
                                <span class="field-icon"><i class="fa fa-barcode"></i></span>  
                            </label>
                        </div>
                        <div class="section">
                            <label for="home_phone" class="field prepend-icon">
                                <input type="date" name="date_creation" id="date_creation" class="gui-input phone-group">
                                <span class="field-icon"><i class="fa fa-calendar"></i></span> 
                           <span class="input-hint"> 
                            	<strong>date de creation:</strong>
                            </span>  
                            </label>
                        </div>
                    <div class="section">
                    	<label for="comment" class="field prepend-icon">
                        	<textarea class="gui-textarea" id="comment" autocomplete="on" name="adresse" placeholder="Adresse ...."></textarea>
                            <span class="field-icon"><i class="fa fa-map-marker"></i></span>
                            <span class="input-hint"> 
                            	<strong>Adresse de l'entreprise:</strong>
                                
                            </span>
                        </label>
                    </div>
                    <div class="section">
                    	<label for="website" class="field prepend-icon">
                        	<input type="url" name="website" id="website" class="gui-input" placeholder="Le site web de l'entreprise...">
                            <span class="field-icon"><i class="fa fa-globe"></i></span>
                            <span class="input-hint"> 
                            	<strong>NB: il doit commencer par http://www</strong>
                            </span>  
                        </label>
                    </div>
                    <div class="frm-row">
                    
                        <div class="section colm colm6">
                            <label for="mobile_phone" class="field prepend-icon">
                                <input type="tel" name="mobile_phone" id="mobile_phone" class="gui-input phone-group" placeholder="Numero de votre Fix">
                                <span class="field-icon"><i class="fa fa-phone"></i></span>  
                            </label>
                        </div><!-- end section -->
                        
                        <div class="section colm colm6">
                            <label for="home_phone" class="field prepend-icon">
                                <input type="tel" name="fax" id="home_phone" class="gui-input phone-group" placeholder="Numero de votre fax">
                                <span class="field-icon"><i class="fa fa-fax"></i></span>  
                            </label>
                        </div><!-- end section -->
                     
                    </div>
                    <div class="section">
                        <label for="file1" class="field file">
                            <span class="button btn-primary"> Le logo de l'entreprise </span>
                            <input type="file" class="gui-file" name="upload1" id="file1" onchange="document.getElementById('uploader1').value = this.value;">
                            <input type="text" class="gui-input" id="uploader1" placeholder="aucun fichier selectionné " readonly="">
                              
                        </label>
                    </div>
                    <!-- end .frm-row section -->
                                        <div class="section">
                        <label class="field gui-input">
                            <select id="domaine" name="domaine" aria-required="true" aria-invalid="false">
                                <option value="0">Select Domaine...</option>
                                <option value="1">Agriculture Agroalimentaire</option>
                                <option value="2">BTP Bâtiment</option>
                                <option value="3">Cuir, chaussure et textile</option>
                                <option value="4">Chimie, Plastique, Santé</option>
                                 <option value="5">Fournitures Industrielles</option>
                                 <option value="6">Fournitures de bureaux et mobilier</option>
                                 <option value="7">Produits chimiques</option>
                                 <option value="8">Services et Télécommunication</option>
                                
                            </select>
                            <i class="arrow double"></i>                    
                        </label>  
                    </div>
<div class="section">
                        <label class="field prepend-icon">
                         <input type="text" name="filiere" id="filiere" class="gui-input" placeholder="Tapez votre filiere">
                            
                            
                            <i class="arrow double"></i>                    
                        </label>  
                    </div>
                    <div class="spacer-t20 spacer-b40">
                    	<div class="tagline"><span> Mot de passe </span></div><!-- .tagline -->
                    </div>                   
                    
                	<div class="section">
                    	<label for="password" class="field prepend-icon">
                        	<input type="password" name="password" id="password2" class="gui-input" placeholder="Tapez un mot de passe">
                            <span class="field-icon"><i class="fa fa-lock"></i></span>  
                        </label>
                    </div><!-- end section -->
                    
                	<div class="section">
                    	<label for="repeatPassword" class="field prepend-icon">
                        	<input type="password" name="repeatPassword" id="repeatPassword" class="gui-input" placeholder="Confirmer votre mot de passe">
                            <span class="field-icon"><i class="fa fa-unlock-alt"></i></span>  
                        </label>
                    </div><!-- end section -->
                    
                    
                    
                    <div class="spacer-t20 spacer-b30">
                    	<div class="tagline"><span> Je ne suis pas une machine </span></div><!-- .tagline -->
                    </div>
                    
                    <div class="section">
                        <div class="smart-widget sm-left sml-120">
                            <label for="verification" class="field prepend-icon">
                                <input type="text" name="verification" id="verification" class="gui-input" placeholder="Vous n'êtes pas une machine..">
                                <span class="field-icon"><i class="fa fa-shield"></i></span>  
                            </label>
                            <label for="verification" class="button" id="somme">3+75=</label>
                        </div><!-- end .smart-widget section --> 
                    </div><!-- end section -->
                    
                    
                <div class="form-footer">
                	<input type="submit" name="sincrire" value="S'inscrire" class="button btn-primary">
                    <button type="reset" class="button"> Cancel </button>
                    <div class="tagline"><a class="box-switcher" data-switch="smart-form" href="#">J'ai un compte</a></div>
                </div><!-- end .form-footer section -->
            
            
        </div></form><!-- end .smart-forms section -->
    </div><!-- end .smart-wrap section -->
    
    </div><!-- end section -->
        
     </div></div>



<div class="col-md-3">
<br><br>
<!--  pub 1 -->
        <div class="ca-hover">
             <div class="carousel-img">
             <img src="img/c02.jpg" alt="Carousel Img">
             </div>

             <div class="carousel-avatar av2">
             </div>
             <div class="carousel-content">
             <h3>Lorem ipsum dolor sit amet consectetur</h3>
             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis suscipit est, ut imperdiet tortor. Proin sed molestie   massa.</p>
             </div>
             <div class="overlay"></div>
       </div>
<!--  pub 2 -->
<div class="ca-hover">
             <div class="carousel-img">
             <img src="img/c02.jpg" alt="Carousel Img">
             </div>

             <div class="carousel-avatar av2">
             </div>
             <div class="carousel-content">
             <h3>Lorem ipsum dolor sit amet consectetur</h3>
             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis suscipit est, ut imperdiet tortor. Proin sed molestie   massa.</p>
             </div>
             <div class="overlay"></div>
       </div>
<!--  pub 3 -->
<div class="ca-hover">
             <div class="carousel-img">
             <img src="img/c02.jpg" alt="Carousel Img">
             </div>

             <div class="carousel-avatar av2">
             </div>
             <div class="carousel-content">
             <h3>Lorem ipsum dolor sit amet consectetur</h3>
             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis suscipit est, ut imperdiet tortor. Proin sed molestie   massa.</p>
             </div>
             <div class="overlay"></div>
       </div>


        </div>
</div>
<br><br>
<!--footer-->
<footer style="
    margin-top: 420px;
">
      <div class="container">
        <div class="row">
          <div class="col-md-2">
            <h2>LUMD Annuaire</h2>
          </div>
          <div class="col-md-5">
            <p>Nam mi enim, auctor non ultricies a, fringilla eu risus. Praesent vitae lorem et elit tincidunt accumsan suscipit eu libero. Maecenas diam est, venenatis vitae dui in, vestibulum mollis arcu. Donec eu nibh tincidunt, dapibus sem eu, aliquam dolor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum consectetur commodo eros, vitae laoreet lectus aliq</p>
          </div>
          <div class="col-md-3">
            <p>aliquam dolor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum consectetur commodo eros, vitae laoreet lectus aliq</p>
          </div>
          <div class="col-md-2">
            <ul class="footer-links">
              <li><a href="#">List One</a></li>
              <li><a href="#">Page Two</a></li>
              <li><a href="#">Design</a></li>
              <li><a href="#">Work</a></li>
              <li><a href="#">Contact Me</a></li>
            </ul>
          </div>
        </div>
      </div>  
    </footer>
<script type="text/javascript">

var map;
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 8
  });

}

    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLWHd7Y9OUZKF-yAt3p4La5f5Jwo62gaw&callback=initMap">
    </script>
    
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/unslider.min.js"></script>
 <script src="js/functions.js"></script>
</body>

<!-- Mirrored from doptiq.com/smart-forms/demos/samples/flat/validation.html by HTTrack Website Copier/3.x [XR&CO'2013], Tue, 09 Jun 2015 09:37:41 GMT -->
</html>
