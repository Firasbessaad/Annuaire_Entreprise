<?php
//modifier le site
//modifier background
function modifier_slide($id_enreprise,$slide,$slidepath){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
$req="UPDATE ann_entreprise SET ";
if($slide==1){
$req.="slide1 ='$slidepath'  WHERE id='$id_enreprise'";
}
if($slide==2){
$req.="slide2 ='$slidepath'  WHERE id='$id_enreprise'";
}
if($slide==3){
$req.="slide3 ='$slidepath'  WHERE id='$id_enreprise'";
}
$query = mysql_query($req, $link);

}
//select slide
function empty_slide($id_enreprise){
global $servername;
global $username;
global $pwd;
global $dbname ;
  
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
$result = mysql_query("SELECT * FROM ann_entreprise where id='$id_enreprise'", $link);
if(!empty($result['slide1'])||!empty($result['slide2'])||!empty($result['slide3'])){
$empty= false;
die ($result['slide1']);
}else{
$empty=true;
}
return $result;
}
//modifier caracteristiques
function modifier_caracteristiques(){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
$query = mysql_query("UPDATE ann_entreprise SET", $link);
}
//modifier apropos
function modifier_apropos($id_enreprise,$apropos){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
$query = mysql_query("UPDATE ann_entreprise SET apropos='$apropos'  WHERE id='$id_enreprise'", $link);
}


?>
