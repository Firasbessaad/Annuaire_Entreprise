<!DOCTYPE html>
<!-- saved from url=(0036)http://localhost/LUMD Annuaire/Forum.php# -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">  
    <title>LUMD Annuaire | Forum  </title><link rel="shortcut icon" href="img/logo.png">
    <!-- Bootstrap -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/queries.css">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	  <!-- Fonts -->
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
.post{
border-style: outset;
color: rgb(99, 198, 174);
width: inherit;
cursor:pointer;
}
</style>
  </head>
  <body data-twttr-rendered="true">
		<header class="clearfix">
		    <div class="logo col-md-3"><h2 class="logo-text">LUMD Annuaire</h2></div>
		    <nav class="clearfix">
            <ul class="clearfix">
                <li><a href="./index.php" >Acceuil</a></li>
                <li><a href="./annuair.php">Annuaire</a></li>
                <li><a href="./Espace_Entreprise.php">Espace Entreprise</a></li>
                <li><a href="./Forum.php" class="active">Forum</a></li>
                <li><a href="./contact.php">contact</a></li>
                <li><a href="#" class="last">Apropos</a></li>
            </ul>
        </nav>
        <div class="pullcontainer">
        <a href="./Forum.php" id="pull"><i class="fa fa-bars fa-2x"></i></a>
        </div>     
		</header>
  
<div class="container">

        <div class="row">
            <div class="col-lg-8">
<div>
                    <form action="" method="post">
                    <h4><i class="fa fa-search"></i> Chercher un post...</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>

                    </div></form>
                    <!-- /input-group -->
                </div>
<form class="form-horizontal" style="padding-top: 15px;" method="post" action="">
<fieldset>
<?php
include('./fonction/Function.php');
if(isset($_POST['submitSujet'])){
$pseudo=$_POST['pseudo'];
$sujet=$_POST['Sujet'];
$nomsujet=$_POST['nomsujet'];
$tags=$_POST['newtags'];
poster($pseudo,$nomsujet,$sujet,$tags);
}
?>
<!-- Form Name -->
<legend style="font-size: 17px!important;"><h2>Poser votre question</h2></legend>

<!-- Prepended text-->
<div class="form-group">
  <label class="col-md-4 control-label" for="pseudo">Votre pseudo</label>
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon glyphicon glyphicon-user"></span>
      <input id="pseudo" name="pseudo" class="form-control" placeholder="saisir votre pseudo" type="text" required="">
    </div>
    <p class="help-block"></p>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="nomsujet">Nom sujet</label>
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon glyphicon glyphicon-flag"></span>
      <input id="nomsujet" name="nomsujet" class="form-control" placeholder="saisir le nom du sujet" type="text" required="">
    </div>
    <p class="help-block"></p>
  </div>
</div>


<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Sujet">Sujet</label>
  <div class="col-md-7">                     
    <textarea class="form-control" id="Sujet" name="Sujet" rows="8" cols="100" required=""></textarea>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="newtags"></label>
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon glyphicon glyphicon-tags"></span>
      <input id="newtags" name="newtags" class="form-control" placeholder="ajouter des tags" type="text" required="">
    </div>
    <p class="help-block"></p>
  </div>
</div>
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submitSujet"></label>
  <div class="col-md-4">
    <button id="submitSujet" name="submitSujet" class="btn btn-primary">Submit</button>
  </div>
</div>

</fieldset>
</form>
<?php 
$idpostserach=$_GET['post'];
if(isset($idpostserach)){
if($idpostserach<mysql_num_rows(recup_posts(""))+1){
$posts=recup_posts($idpostserach);
}else{
die("<p>Post n'existe pas</p><a href='./Forum.php'>Retourner</a>");
}
}else{
$posts=recup_posts("");
}
$in="in";
while($post = mysql_fetch_assoc($posts)){
$tags=explode(":", $post['tags']);
$tag="<p><i class=\"fa fa-tags\"></i> Tags:";
for($i=0;$i<count($tags);$i++){
$tag.="<a href=\"\"><span class=\"badge badge-info\">".$tags[$i]."</span></a> ";
}
$text=substr($post['contenu'], 0, 200);
$comments=recup_comments($post['id']);
$affich_comments="";
while($comment = mysql_fetch_assoc($comments)){
$affich_comments.=" <h3><i class=\"fa fa-comment\"></i> ".$comment['user']." says:
                    <small> ".$comment['date']."</small>
                </h3>
                <p>".$comment['contenu']."</p>";
}

echo "<h1 class=\"post\" data-toggle=\"collapse\" data-target=\"#".$post['id']."\"> ".$post['nom']."</h1>
                <div id=\"".$post['id']."\" class=\"collapse ".$in."\">
                <p class=\"lead\"><i class=\"fa fa-user\"></i> by <a href=\"\">".$post['user']."</a>
                </p>	
                <hr>
                <p class=\"lead\">".$text.".</p>           
                <br><p><i class=\"fa fa-calendar\"></i> Posted on ".$post['date']."</p>
				
<hr>".$tag."
<hr>
".$affich_comments."
  <!-- leave comments -->

                    <h4><i class=\"fa fa-paper-plane-o\"></i> Leave a Comment:</h4>
                    <form role=\"form\" method=\"post\">
<div class=\"form-group\">
  
  <div class=\"col-md-4\">
    <div class=\"input-group\">
      <span class=\"input-group-addon glyphicon glyphicon-user\"></span>
      <input  name=\"u".$post['id']."\" class=\"form-control\" placeholder=\"saisir votre pseudo\" type=\"text\" required=\"\">
    </div>
    <p class=\"help-block\"></p>
  </div>
</div>
                        <div class=\"form-group\">
                            <textarea class=\"form-control\" rows=\"3\" name=\"c".$post['id']."\"></textarea>
                        </div>
                        <button type=\"submit\" name=\"".$post['id']."\"class=\"btn btn-primary\"><i class=\"fa fa-reply\"></i> Submit</button>
                    </form>
</div>";
$in="";
}
for($j=0;$j<100;$j++){
if(isset($_POST[$j])){
$newcomment=$_POST['c'.$j];
$usercomment=$_POST['u'.$j];
commenter($j,$usercomment,$newcomment);
?><meta http-equiv="refresh" content="1" /><?php
}
}
?>                
				
               
          
                
            </div>

            <div class="col-lg-4">

                
                <!-- /well -->
                <div class="well">
                    <h4><i class="fa fa-tags"></i>Tags populaires:</h4>
<?php
$tagsbdd=tagspopulaires();
$tagspop=explode(":", $tagsbdd['tags']);
$tagpop="";
for($i=0;$i<count($tags);$i++){
$tagpop.="<li><a href=\"\"><span class=\"badge badge-info\">".$tagspop[$i]."</span></a></li> ";
}


?>



                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <?php echo $tagpop; ?>
                            </ul>
                        </div>
                        
                    </div>
                </div>
				<!-- /well -->
				<div class="well">
                    <h4><i class="fa fa-thumbs-o-up"></i> Nous rejoindre!</h4>
					<ul>
                    <p><a title="Facebook" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x"></i></span></a> <a title="Twitter" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x"></i></span></a> <a title="Google+" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-google-plus fa-stack-1x"></i></span></a> <a title="Linkedin" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-linkedin fa-stack-1x"></i></span></a> <a title="GitHub" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-github fa-stack-1x"></i></span></a> <a title="Bitbucket" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-bitbucket fa-stack-1x"></i></span></a></p>
					</ul>
                </div>
				<!-- /well -->
                <!-- /well -->
                <div class="well">
                    <h4><i class="fa fa-fire"></i> Le Post le plus populaire:</h4>
					<ul><?php $psotpop= postspopulaires(); ?>
                    <li><a href="./Forum.php?post=<?php echo $psotpop['id'] ;?>"><?php  echo $psotpop['nom'];?></a></li>
					
					</ul>
                </div>
               
                
                <!-- /well -->
				
				
            </div>
        </div>


        <hr>

  

    </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/unslider.min.js"></script> 
    
  

</body></html>
