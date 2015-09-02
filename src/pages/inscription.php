<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">  
    <title>Infusion WP Theme</title>
 <link rel="stylesheet" type="text/css"  href="./css/smart-forms.css">
    <link rel="stylesheet" type="text/css"  href="./css/font-awesome.min.css">
    
    
	<script type="text/javascript" src="./js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="./js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="./js/additional-methods.min.js"></script>
    
    <!--[if lte IE 9]>   
        <script type="text/javascript" src="js/jquery.placeholder.min.js"></script>
    <![endif]-->    
    
    <!--[if lte IE 8]>
        <link type="text/css" rel="stylesheet" href="css/smart-forms-ie8.css">
    <![endif]-->
    	
    
    
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
<script type="text/javascript">
	
		$(function() {
		
				/* @custom validation method (smartCaptcha) 
				------------------------------------------------------------------ */
					
				$.validator.methods.smartCaptcha = function(value, element, param) {
						return value == param;
				};
						
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
										smartCaptcha:19	
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
    
    </script>
  </head>
  <body>
		<header class="clearfix">
		    <div class="logo col-md-3"><h2 class="logo-text">INFUSION</h2></div>
		    <nav class="clearfix">
            <ul class="clearfix">
                <li><a href="#" class="active">Acceuil</a></li>
                <li><a href="#">Annuaire</a></li>
                <li><a href="#">Espace Entreprise</a></li>
                <li><a href="#">Apropos</a></li>
                <li><a href="#" class="last">contact</a></li>
            </ul>
        </nav>
        <div class="pullcontainer">
        <a href="#" id="pull"><i class="fa fa-bars fa-2x"></i></a>
        </div>     
		</header>





<div class="smart-wrap">
    	<div class="smart-forms smart-container wrap-2">
        
        	<div class="form-header header-primary">
            	<h4><i class="fa fa-pencil-square"></i>Form validation</h4>
            </div><!-- end .form-header section -->
            
            <form method="post" action="http://doptiq.com/" id="smart-form">
            	<div class="form-body">
                
                    <div class="spacer-b30">
                    	<div class="tagline"><span> Normal validation rules </span></div><!-- .tagline -->
                    </div>
                    
                    <div class="frm-row">
                        <div class="section colm colm6">
                            <label for="firstname" class="field prepend-icon">
                                <input type="text" name="firstname" id="firstname" class="gui-input" placeholder="First name...">
                                <span class="field-icon"><i class="fa fa-user"></i></span>  
                            </label>
                        </div><!-- end section -->
                        
                        <div class="section colm colm6">
                            <label for="lastname" class="field prepend-icon">
                                <input type="text" name="lastname" id="lastname" class="gui-input" placeholder="Last name...">
                                <span class="field-icon"><i class="fa fa-user"></i></span>  
                            </label>
                        </div><!-- end section -->
                    </div><!-- end .frm-row section -->                                    
                
                	<div class="section">
                    	<label for="useremail" class="field prepend-icon">
                        	<input type="email" name="useremail" id="useremail" class="gui-input" placeholder="Email address">
                            <span class="field-icon"><i class="fa fa-envelope"></i></span>  
                        </label>
                    </div><!-- end section -->
                    
                	<div class="section">
                    	<label for="website" class="field prepend-icon">
                        	<input type="url" name="website" id="website" class="gui-input" placeholder="Current website url">
                            <span class="field-icon"><i class="fa fa-globe"></i></span>  
                        </label>
                    </div><!-- end section -->                    
                    
                    <div class="section">
                        <label class="field select">
                            <select id="language" name="language">
                                <option value="">Select language...</option>
                                <option value="EN">English</option>
                                <option value="FR">French</option>
                                <option value="SP">Spanish</option>
                                <option value="CH">Chinese</option>
                                <option value="JP">Japanese</option>
                            </select>
                            <i class="arrow double"></i>                    
                        </label>  
                    </div><!-- end section -->                     
                    
                    <div class="section">
                        <label for="file1" class="field file">
                            <span class="button btn-primary"> Choose File </span>
                            <input type="file" class="gui-file" name="upload1" id="file1" onChange="document.getElementById('uploader1').value = this.value;">
                            <input type="text" class="gui-input" id="uploader1" placeholder="no file selected" readonly>
                        </label>
                    </div><!-- end  section -->
                    
                    <div class="section">
                        <label class="field select-multiple">
                          <select name="mobileos" id="mobileos" multiple>
                              <option value="0">Apple iOS </option>
                              <option value="1">Windows Mobile </option>
                              <option value="2">Google Android</option>
                              <option value="3">Tizen mobile OS</option>
                              <option value="5">Firefox OS</option>
                              <option value="6">Blackberry OS</option>
                              <option value="6">Symbian</option>
                          </select>       
                        </label>        
                    </div><!-- end  section -->                     
                    
                	<div class="section">
                    	<label for="comment" class="field prepend-icon">
                        	<textarea class="gui-textarea" id="comment" name="comment" placeholder="Your comment"></textarea>
                            <span class="field-icon"><i class="fa fa-comments"></i></span>
                            <span class="input-hint"> 
                            	<strong>DO NOT:</strong> Be negative or off topic, we expect a great comment... 
                            </span>   
                        </label>
                    </div><!-- end section --> 
                    
                    <div class="spacer-t40 spacer-b40">
                    	<div class="tagline"><span> Fill at least one  </span></div><!-- .tagline -->
                    </div>                                         

                    
                    <div class="frm-row">
                    
                        <div class="section colm colm6">
                            <label for="mobile_phone" class="field prepend-icon">
                                <input type="tel" name="mobile_phone" id="mobile_phone" class="gui-input phone-group" placeholder="Mobile number">
                                <span class="field-icon"><i class="fa fa-mobile-phone"></i></span>  
                            </label>
                        </div><!-- end section -->
                        
                        <div class="section colm colm6">
                            <label for="home_phone" class="field prepend-icon">
                                <input type="tel" name="home_phone" id="home_phone" class="gui-input phone-group" placeholder="Home number">
                                <span class="field-icon"><i class="fa fa-phone"></i></span>  
                            </label>
                        </div><!-- end section -->
                     
                    </div><!-- end .frm-row section -->
                                        
                    <div class="spacer-t20 spacer-b40">
                    	<div class="tagline"><span> Equal -  Matching elements </span></div><!-- .tagline -->
                    </div>                   
                    
                	<div class="section">
                    	<label for="password" class="field prepend-icon">
                        	<input type="password" name="password" id="password" class="gui-input" placeholder="Create a password">
                            <span class="field-icon"><i class="fa fa-lock"></i></span>  
                        </label>
                    </div><!-- end section -->
                    
                	<div class="section">
                    	<label for="repeatPassword" class="field prepend-icon">
                        	<input type="password" name="repeatPassword" id="repeatPassword" class="gui-input" placeholder="Repeat password">
                            <span class="field-icon"><i class="fa fa-unlock-alt"></i></span>  
                        </label>
                    </div><!-- end section -->
                    
                    <div class="spacer-t40 spacer-b40">
                    	<div class="tagline"><span>  Checkboxes + Radios Group </span></div><!-- .tagline -->
                    </div> 
                    
                    <div class="frm-row">
                    
                        <div class="section colm colm6 pad-r40 bdr">
                            <div class="option-group field">
                                <label for="female" class="option block">
                                    <input type="radio" name="gender" id="female" value="female">
                                    <span class="radio"></span> Female specie
                                </label>
                                
                                <label for="male" class="option block spacer-t10">
                                    <input type="radio" name="gender" id="male" value="male">
                                    <span class="radio"></span> Male specie                  
                                </label>                            
                                
                                <label for="other" class="option block spacer-t10">
                                    <input type="radio" name="gender" id="other" value="other">
                                    <span class="radio"></span> Other specie                 
                                </label>
                                
                            </div>
                                                
                        </div><!-- end .section section -->                                
    
                        
                        <div class="section colm colm6 pad-l40">
                            <div class="option-group field">
                            
                                <label class="option block">
                                    <input type="checkbox" name="languages" value="FR">
                                    <span class="checkbox"></span> Fluent french            
                                </label>
                          
                                <label class="option block spacer-t10">
                                    <input type="checkbox" name="languages" value="EN">
                                    <span class="checkbox"></span> Fluent english              
                                </label>
                                
                                <label class="option block spacer-t10">
                                    <input type="checkbox" name="languages" value="CH">
                                    <span class="checkbox"></span> Fluent chinese            
                                </label>                                
                                
                            </div>                        
                        </div><!-- end section -->
                        
                    </div> <!-- end .frm-row section -->
                    
                    <div class="spacer-t20 spacer-b30">
                    	<div class="tagline"><span> Custom Methods </span></div><!-- .tagline -->
                    </div>
                    
                    <div class="section">
                        <div class="smart-widget sm-left sml-120">
                            <label for="verification" class="field prepend-icon">
                                <input type="text" name="verification" id="verification" class="gui-input" placeholder="Solve verification">
                                <span class="field-icon"><i class="fa fa-shield"></i></span>  
                            </label>
                            <label for="verification" class="button">15 + 4 = </label>
                        </div><!-- end .smart-widget section --> 
                    </div><!-- end section -->
                    
                    <div class="spacer-t40 spacer-b30">
                    	<div class="tagline"><span> Conditional validation </span></div><!-- .tagline -->
                    </div>
                    
                    <div class="section">
                    	<p class="small-text fine-grey"> 1 - The applicant age must be 16 years and above </p>
                        <p class="small-text fine-grey"> 2 - For applicants above 19 years, a licence number will be required </p>
                    </div><!-- end section -->                    
                    
                    <div class="frm-row">
                    
                        <div class="section colm colm6">
                            <label for="applicant_age" class="field prepend-icon">
                                <input type="text" name="applicant_age" id="applicant_age" class="gui-input" placeholder="Applicant age">
                                <span class="field-icon"><i class="fa fa-male"></i></span>  
                            </label>
                        </div><!-- end section -->
                        
                        <div class="section colm colm6">
                            <label for="licence_no" class="field prepend-icon">
                                <input type="text" name="licence_no" id="licence_no" class="gui-input" placeholder="Licence number">
                                <span class="field-icon"><i class="fa fa-credit-card"></i></span>  
                            </label>
                        </div><!-- end section -->
                     
                    </div><!-- end .frm-row section -->
                    
                    <div class="spacer spacer-t10 spacer-b20"> </div>
                    
                    <div class="section">
                    	<p class="small-text fine-grey"> Child name will be required when you agree / tick / check that you are a parent </p>
                    </div><!-- end section -->                    
                    
                    
                 	<div class="section">
                    	<div class="option-group field">
                        
                            <label class="option block">
                                <input type="checkbox" name="parents" id="parents" value="parents">
                                <span class="checkbox"></span> Yes i am a parent        
                            </label>
                            
                    	</div><!-- end .option-group section -->             
                    </div><!-- end section --> 
                                        
                 	<div class="section">
                    	<label for="child_name" class="field prepend-icon">
                        	<input type="text" name="child_name" id="child_name" class="gui-input" placeholder="Enter childs name">
                            <span class="field-icon"><i class="fa fa-female"></i></span>  
                        </label>
                    </div><!-- end section -->                   
                    
                </div><!-- end .form-body section -->
                <div class="form-footer">
                	<button type="submit" class="button btn-primary"> Validate Form </button>
                    <button type="reset" class="button"> Cancel </button>
                </div><!-- end .form-footer section -->
            </form>
            
        </div><!-- end .smart-forms section -->
    </div><!-- end .smart-wrap section -->
    
    <div></div><!-- end section -->






<?php 
/*
if(isset($_POST['submit'])){
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$useremail=$_POST['useremail'];
$mobile_phone=$_POST['mobile_phone'];
$home_phone=$_POST['home_phone'];
$password=$_POST['password'];
$website=$_POST['website'];
$adress=$_POST['adresse'];
$fonction=$_POST['fonction'];
include ('./flat/Function.php');
sincrire($firstname,$lastname,$useremail,$mobile_phone,$home_phone,$password,$website,$adress,$fonction);

include("./flat/connexion.html"); 
}else{
include("./flat/formulaire.html"); 
}*/
//include("./flat/formulaire2.html"); 
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/unslider.min.js"></script>
</body>

</html>
