<!DOCTYPE html>
<html lang="fr">
<?php 
	include('../fonction/Function.php');
	$id=$_GET['entreprise'];
	$entreprise=recuperer_info($id);
	?>
<head>
	
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $entreprise['nom']; ?></title>
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
</style>
</head><!--/head-->

<body id="home" class="homepage">
<?php
$services= afficher_service($id);
$nbservices=mysql_num_rows($services);
$produits=afficher_produit($id);
$total=mysql_num_rows($produits);
$emplois=afficher_emploi($id);
$nbemplois=mysql_num_rows($emplois);
$actualites=recup_actualite($id);
$nbactualites=mysql_num_rows($actualites);
$agences=afficher_agence($id);
$nbagences=mysql_num_rows($agences);
?>
    <header id="header">
        <nav id="main-menu" class="navbar navbar-default navbar-fixed-top" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php??entreprise=<?php echo $id; ?>"><img src="../avatars/<?php echo $entreprise['logo']; ?>" alt="logo" width="150" height="57"></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="scroll active"><a href="#home">Acceuil</a></li>
                       <!--<li class="scroll"><a href="#features">Caractéristiques</a></li>-->
                        <?php if($nbservices>0){?><li class="scroll"><a href="#services">Services</a></li><?php } ?>
                        <?php if($total>0){?><li class="scroll"><a href="#portfolio">Nos Produits</a></li><?php } ?>
                        <?php if(!empty($entreprise['apropos'])){?><li class="scroll"><a href="#about">A propos de Nous</a></li><?php } ?>
                        <?php if($nbagences>0){?><li class="scroll"><a href="#meet-team">Nos Agences</a></li><?php } ?>
                        <?php if($nbemplois>0){?><li class="scroll"><a href="#pricing">Nos Offres d'emploi</a></li><?php } ?>
                        <?php if($nbactualites>0){?><li class="scroll"><a href="#blog">Actualités</a></li><?php } ?> 
                        <li class="scroll"><a href="#get-in-touch">Contact</a></li>                        
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
    </header><!--/header-->
<?php
$test1=(!empty($entreprise['slide1'])&&!empty($entreprise['slide2'])&&!empty($entreprise['slide3']));
$test2=(empty($entreprise['slide1'])&&!empty($entreprise['slide2'])&&!empty($entreprise['slide3']));
$test3=(!empty($entreprise['slide1'])&&empty($entreprise['slide2'])&&!empty($entreprise['slide3']));
$test4=(!empty($entreprise['slide1'])&&!empty($entreprise['slide2'])&&empty($entreprise['slide3']));
$test=$test1||$test2||$test3||$test4;
if($test){
?>
    <section id="main-slider">
        <div class="owl-carousel">
<?php if(!empty($entreprise['slide1'])){
?>
            <div class="item" style="background-image: url(<?php echo $entreprise['slide1']; ?>);">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h2><span>Multi</span></h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et  dolore magna incididunt ut labore aliqua. </p>
                                    <a class="btn btn-primary btn-lg" href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.item-->
<?php
}
if(!empty($entreprise['slide2'])){
?>
             <div class="item" style="background-image: url(<?php echo $entreprise['slide2'];?>);">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h2>Beautifully designed <span>free</span> one page template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et  dolore magna incididunt ut labore aliqua. </p>
                                    <a class="btn btn-primary btn-lg" href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
}if(!empty($entreprise['slide2'])){
?>
<div class="item" style="background-image: url(<?php echo $entreprise['slide3'];?>);">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h2>Beautifully designed <span>free</span> one page template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et  dolore magna incididunt ut labore aliqua. </p>
                                    <a class="btn btn-primary btn-lg" href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
}
?><!--/.item-->
        </div><!--/.owl-carousel-->
    </section><!--/#main-slider-->
<?php
}
?>
    <!--Caractéristiques impressionnantes

    <section id="features">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Caractéristiques impressionnantes</h2>
                <p class="text-center wow fadeInDown">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>
            <div class="row">
                <div class="col-sm-6 wow fadeInLeft">
                    <img class="img-responsive" src="images/main-feature.png" alt="">
                </div>
                <div class="col-sm-6">
                    <div class="media service-box wow fadeInRight">
                        <div class="pull-left">
                            <i class="fa fa-line-chart"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">UX design</h4>
                            <p>Backed by some of the biggest names in the industry, Firefox OS is an open platform that fosters greater</p>
                        </div>
                    </div>

                    <div class="media service-box wow fadeInRight">
                        <div class="pull-left">
                            <i class="fa fa-cubes"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">UI design</h4>
                            <p>Backed by some of the biggest names in the industry, Firefox OS is an open platform that fosters greater</p>
                        </div>
                    </div>

                    <div class="media service-box wow fadeInRight">
                        <div class="pull-left">
                            <i class="fa fa-pie-chart"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">SEO Services</h4>
                            <p>Backed by some of the biggest names in the industry, Firefox OS is an open platform that fosters greater</p>
                        </div>
                    </div>

                    <div class="media service-box wow fadeInRight">
                        <div class="pull-left">
                            <i class="fa fa-pie-chart"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">SEO Services</h4>
                            <p>Backed by some of the biggest names in the industry, Firefox OS is an open platform that fosters greater</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->

<?php
          
           
           if($nbservices>0){
?>
    <section id="services" >
        <div class="container">

            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Nos Services</h2>
                <p class="text-center wow fadeInDown"></p>
            </div>

            <div class="row">
                <div class="features">

<?php 

while($service = mysql_fetch_assoc($services)) {
echo"<div class=\"col-md-4 col-sm-6 wow fadeInUp\" data-wow-duration=\"300ms\" data-wow-delay=\"0ms\">
                        <div class=\"media service-box\">
                            <div class=\"pull-left\">
                                <img width=\"50\" height=\"50\" src=\"../Service/".$service['image']."\">
                            </div>
                            <div class=\"media-body\">
                                <h4 class=\"media-heading\">".$service['nom_service']."</h4>
                                <p>".$service['description']."</p>
                            </div>
                        </div>
                    </div>
                    ";
}

?>
<!--/.col-md-4-->
                </div>
            </div><!--/.row-->    
        </div><!--/.container-->
    </section><!--/#services-->
<?php

}
if($total>0){
?>
    <section id="portfolio">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">NOS Produits</h2>
                <p class="text-center wow fadeInDown">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>

            <div class="text-center">
                <ul class="portfolio-filter">
                 <li><a class="active" href="#" data-filter=".derniers">les Derniers produit</a></li>   
          <?php
           $types=type_produit($id);
           
           if(mysql_num_rows($types)>0){
while($type = mysql_fetch_assoc($types)) {
 echo "<li><a href=\"#\" data-filter=\".".$type['id']."\">".$type['nom_type']."</a></li>"   ;    }    ?>
 <?php }else{?>                   
                    <li><a href="#" data-filter=".creative">Creative</a></li>
                    <li><a href="#" data-filter=".corporate">Corporate</a></li>
                    <li><a href="#" data-filter=".portfolio">Portfolio</a></li>
                    <!--les type de produits-->
                </ul><!--/#portfolio-filter-->
<?php }?>
            </div>

<div class="portfolio-items">

<?php 
if($total>0){
while($produit = mysql_fetch_assoc($produits)) {
echo "

                <div class=\"portfolio-item ".$produit['type']."\" >
                    <div class=\"portfolio-item-inner\" >
                        <img width=\"100%\" height=\"200px\" src=\"../Produit/".$produit['image']."\" alt=\"\">
                        <div class=\"portfolio-info\">
                            <h3>".$produit['nom_produit']."</h3>
                            
                            <a class=\"preview\" href=\"../Produit/".$produit['image']."\" rel=\"prettyPhoto\"><i class=\"fa fa-eye\"></i></a>
                        </div>
                    </div>
                </div> 



" ;}}?>
  
</div>
                         
            
        </div>
<!--/.container-->
    </section><!--/#portfolio-->
<?php if(!empty($entreprise['apropos'])){?>
    <section id="about">
        <div class="container">

            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">A Propos De Nous</h2>
                <p class="text-center wow fadeInDown"></p>
            </div>

            <div class="row">
               <!-- <div class="col-sm-6 wow fadeInLeft">
                    <h3 class="column-title">Video Intro</h3>
                    
                    <div class="embed-responsive embed-responsive-16by9">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/FJWW0BSw6gA" frameborder="0"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                        
                    </div>
                </div>-->

                <div class="col-sm-6 wow fadeInRight">
                    <h3 class="column-title">Qui sommes-nous ?</h3>
                    <p><?php echo $entreprise['apropos'];?></p>

                    

                    

                    <a class="btn btn-primary" href="<?php echo $entreprise['site_web'];?>" >Plus de dédails..</a><!--site ici-->

                </div>
            </div>
        </div>
    </section>
<?php
}}
?><!--/#about-->

 <!--processus   <section id="work-process">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">NOTRE PROCESSUS</h2>
                <p class="text-center wow fadeInDown">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>

            <div class="row text-center">
                <div class="col-md-2 col-md-4 col-xs-6">
                    <div class="wow fadeInUp" data-wow-duration="400ms" data-wow-delay="0ms">
                        <div class="icon-circle">
                            <span>1</span>
                            <i class="fa fa-coffee fa-2x"></i>
                        </div>
                        <h3>MEET</h3>
                    </div>
                </div>
                <div class="col-md-2 col-md-4 col-xs-6">
                    <div class="wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
                        <div class="icon-circle">
                            <span>2</span>
                            <i class="fa fa-bullhorn fa-2x"></i>
                        </div>
                        <h3>PLAN</h3>
                    </div>
                </div>
                <div class="col-md-2 col-md-4 col-xs-6">
                    <div class="wow fadeInUp" data-wow-duration="400ms" data-wow-delay="200ms">
                        <div class="icon-circle">
                            <span>3</span>
                            <i class="fa fa-image fa-2x"></i>
                        </div>
                        <h3>DESIGN</h3>
                    </div>
                </div>
                <div class="col-md-2 col-md-4 col-xs-6">
                    <div class="wow fadeInUp" data-wow-duration="400ms" data-wow-delay="300ms">
                        <div class="icon-circle">
                            <span>4</span>
                            <i class="fa fa-heart fa-2x"></i>
                        </div>
                        <h3>DEVELOP</h3>
                    </div>
                </div>
                <div class="col-md-2 col-md-4 col-xs-6">
                    <div class="wow fadeInUp" data-wow-duration="400ms" data-wow-delay="400ms">
                        <div class="icon-circle">
                            <span>5</span>
                            <i class="fa fa-shopping-cart fa-2x"></i>
                        </div>
                        <h3>TESTING</h3>
                    </div>
                </div>
                <div class="col-md-2 col-md-4 col-xs-6">
                    <div class="wow fadeInUp" data-wow-duration="400ms" data-wow-delay="500ms">
                        <div class="icon-circle">
                            <span>6</span>
                            <i class="fa fa-space-shuttle fa-2x"></i>
                        </div>
                        <h3>LAUNCH</h3>
                    </div>
                </div>
            </div>
        </div>
    </section> /process-->
<?php if($nbagences>0){?>
    <section id="meet-team">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Nos Agences </h2>
                <p class="text-center wow fadeInDown">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>

            <div class="row" style="overflow-y:scroll!important;height:485px;">
<?php
$agences=afficher_agence($id);
if(mysql_num_rows($agences)>0){
while($agence = mysql_fetch_assoc($agences)) {
$filiere=recuperer_filiere($agence['id_entreprise']);
$domaine=recuperer_domaine($filiere['id_domaine']);
if($agence['type']=="Siege"){
$siege=$agence;
}
echo"<a href='http://annuaire.sqli-services.com/entreprise/agence.php?entreprise=".$id."&agence=".$agence['id_agence']."'>
<div class=\"col-sm-6 col-md-3\" onclick=\"myFunction()\">
                    <div class=\"team-member wow fadeInUp\" data-wow-duration=\"400ms\" data-wow-delay=\"0ms\">
                        <div class=\"team-img\">
                            <img class=\"img-responsive\" src=\"".$agence['couverture']."\" alt=\"\">
                        </div>
                        <div class=\"team-info\">
                            <h3>".$agence['nom_agence']."</h3>
                            <span>".$filiere['nom_filiere']."</span><br><span> (".$domaine['nom_domaine'].")</span>
                        </div>
                        <div style=\"font-size:12px;\"><p>Mail : ".$agence['mail_agence']."</p><p>Tel : ".$agence['tel_agence']."</p><p>Fax : ".$agence['fax_agence']."</p></div>
                        
                    </div>
                </div></a>
";
}}
?>
                
            </div>
<?php } ?>
            <div class="divider"></div>

            
        </div>
    </section>

<!--/#meet-team-->
<!--
    <section id="animated-number">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">FAITS AMUSANTS</h2>
                <p class="text-center wow fadeInDown">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>

            <div class="row text-center">
                <div class="col-sm-3 col-xs-6">
                    <div class="wow fadeInUp" data-wow-duration="400ms" data-wow-delay="0ms">
                        <div class="animated-number" data-digit="2305" data-duration="1000"></div>
                        <strong>CUPS OF COFFEE CONSUMED</strong>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
                        <div class="animated-number" data-digit="1231" data-duration="1000"></div>
                        <strong>CLIENT WORKED WITH</strong>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="wow fadeInUp" data-wow-duration="400ms" data-wow-delay="200ms">
                        <div class="animated-number" data-digit="3025" data-duration="1000"></div>
                        <strong>PROJECT COMPLETED</strong>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="wow fadeInUp" data-wow-duration="400ms" data-wow-delay="300ms">
                        <div class="animated-number" data-digit="1199" data-duration="1000"></div>
                        <strong>QUESTIONS ANSWERED</strong>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#animated-number-->
<?php if($nbemplois>0){ ?>
    <section id="pricing"  >
        <div class="container" style="overflow-y:scroll!important;height:485px;">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Offres d'emploi</h2>
                <p class="text-center wow fadeInDown">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>

                        <div class="row">
<?php 

$class="class=\"blog-post blog-large wow fadeInLeft\"";
while($emploi = mysql_fetch_assoc($emplois)){
$text=substr($emploi['description'], 0, 200);

echo "<div class=\"col-sm-6\">
                    <div ".$class." data-wow-duration=\"300ms\" data-wow-delay=\"0ms\">
                        <article>
                            <header class=\"entry-header\">
                                <div class=\"entry-thumbnail\">
                                    <img  src=\"./images/".$emploi['type'].".jpg\" alt=\"\" width=\"25%\" height=\"25%\">
                                </div>
                                <div class=\"entry-date\">".$emploi['type']."</div>
                                <h2 class=\"entry-title\"><a href=\"#\">".$emploi['titre']."</a></h2>
                            </header>

                            <div class=\"entry-content\">
                                <P>".$text."...</P>
                                <button class=\"btn btn-primary\" id=\"btn".$emploi['id']."\" data-toggle=\"collapse\" data-target=\"#".$emploi['id']."\">Lire la suite</button><P id=\"".$emploi['id']."\" class=\"collapse\">".$emploi['description']."</P>
                            </div>

                            <footer class=\"entry-meta\">
                               
                            </footer>
                        </article>
                    </div>
                </div>";
//$class="class=\"blog-post blog-media wow fadeInRight\"";
}
?>
               
            </div>
                    
        </div>
    </section>
<?php } ?>
<!--/#pricing-->

    <!--<section id="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">

                    <div id="carousel-testimonial" class="carousel slide text-center" data-ride="carousel">
                        
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <p><img class="img-circle img-thumbnail" src="images/testimonial/01.jpg" alt=""></p>
                                <h4>Louise S. Morgan</h4>
                                <small>Treatment, storage, and disposal (TSD) worker</small>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut et dolore magna aliqua. Ut enim ad minim veniam</p>
                            </div>
                            <div class="item">
                                <p><img class="img-circle img-thumbnail" src="images/testimonial/01.jpg" alt=""></p>
                                <h4>Louise S. Morgan</h4>
                                <small>Treatment, storage, and disposal (TSD) worker</small>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut et dolore magna aliqua. Ut enim ad minim veniam</p>
                            </div>
                        </div>

                        
                        <div class="btns">
                            <a class="btn btn-primary btn-sm" href="#carousel-testimonial" role="button" data-slide="prev">
                                <span class="fa fa-angle-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="btn btn-primary btn-sm" href="#carousel-testimonial" role="button" data-slide="next">
                                <span class="fa fa-angle-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#testimonial-->
<?php if($nbactualites>0){ ?>
    <section id="blog">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Les derniers actualités</h2>
                <p class="text-center wow fadeInDown"></p>
            </div><div class="row">
<?php 
$actualites=recup_actualite($id);
$class="class=\"blog-post blog-large wow fadeInLeft\"";
while($actualite = mysql_fetch_assoc($actualites)){
$text=substr($actualite['details'], 0, 200);

echo "<div class=\"col-sm-6\">
                    <div ".$class." data-wow-duration=\"300ms\" data-wow-delay=\"0ms\">
                        <article>
                            <header class=\"entry-header\">
                                <div class=\"entry-thumbnail\">
                                    <img  src=\"".$actualite['image']."\" alt=\"\" width=100% height=\"100%\">
                                    <span class=\"post-format post-format-video\"><i class=\"fa fa-film\"></i></span>
                                </div>
                                <div class=\"entry-date\">".$actualite['date_actualite']."</div>
                                <h2 class=\"entry-title\"><a href=\"#\">".$actualite['titre']."</a></h2>
                            </header>

                            <div class=\"entry-content\">
                               <div id=\"btn".$actualite['id_actualite']."d\" data-toggle=\"collapse\" data-target=\"#".$actualite['id_actualite']."\"> <P>".$text."...</P>
                                <button class=\"btn btn-primary\" id=\"btn".$actualite['id_actualite']."\" onclick=\"cache(this.id);\" >Lire la suite</button></div><P id=\"".$actualite['id_actualite']."\" class=\"collapse\">".$actualite['details']."</P>
                            </div>

                            <footer class=\"entry-meta\">
                               
                            </footer>
                        </article>
                    </div>
                </div>";
//$class="class=\"blog-post blog-media wow fadeInRight\"";
}
?>
<script>
var div;
function cache(id){
div = document.getElementById(id+'d');
div.style.visibility="hidden";
div.style.height="0px";
}
function visualiser(){
div.style.visibility="visible";
div.style.height="inherit";
}
</script>               
            </div>

        </div>
    </section>
<?php } ?>
    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">entrer en contact</h2>
                <div class="container-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 ">
                        <div class="contact-form">
                            <h3>Contact Info</h3>

                            <address>
                              <strong>Adress, Inc.</strong><br>
                              <?php echo $entreprise['adresse'];?><br>
                             
                              <abbr title="Phone">P:</abbr> <?php echo $entreprise['telephone'];?>
                            </address>

                            <a href="mailto:direction@sqli-services.com" style="color:white;"><i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s" style="visibility: visible; -webkit-animation-delay: 0.1s;"></i><p>direction@sqli-services.com</p></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
    </section><!--/#get-in-touch-->


    <section id="contact">
   <div id="map" style="z-index: 0;width: 100%;
        height: 650px;"></div>
    <script>

function initMap() {
var lat=<?php echo $siege['latitude'];?>;
var lng=<?php echo $siege['longitude'];?>;
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: lat, lng: lng},
    zoom: 3
  });
var marker = new google.maps.Marker({
    position: {lat: lat, lng: lng},
    map: map,
    title: 'Entreprise'
  });
var infoWindows= new google.maps.InfoWindow({map: map});
infoWindows.setPosition({lat: lat, lng: lng});
      infoWindows.setContent('Nous Somme ici.');

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
    </section><!--/#bottom-->

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    2015 Sqli-Service.
                </div>
                <div class="col-sm-6">
                    <ul class="social-icons">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        <li><a href="#"><i class="fa fa-flickr"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-github"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
<!--/#footer--><!--les agences-->







   

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/mousescroll.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/jquery.inview.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
