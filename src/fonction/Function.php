<?php 
$servername = "mysql51-70.pro";
$username = "sqliservedestk";
$pwd="sqli0002";
$dbname = "sqliservedestk";
include('Functions_Modifier_site.php');



function sincrire($firstname,$lastname,$useremail,$mobile_phone_responsable,$home_phone,$password,$adress,$fonction,$nomEntreprise,$fax,$numeroSiren,$website,$dateCreation,$logo,$filiere,$domaine){
global $servername;
global $username;
global $pwd;
global $dbname ;
$type="simple";

// connecxion à la bdd
$conn = new mysqli($servername, $username, $pwd, $dbname);
// vérifier connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//ajouter un nouveau compte

$sql = "INSERT INTO ann_entreprise(nom, date_creation, telephone, fax, adresse, site_web, num_SIREN, nom_responsable, fonction_responsable, tel_responsable, mail_responsable, logo) 
VALUES ('$nomEntreprise','$dateCreation','$home_phone','$fax','$adress','$website','$numeroSiren','$firstname','$fonction','$mobile_phone_responsable','$useremail','$logo')";
$result=$conn->query($sql);
$id = $conn->insert_id;ajouter_filiere($filiere,$id,$domaine);
//echo $id;
$sqll = "INSERT INTO ann_compte(id_entreprise,login, password, type_compte)
VALUES ('$id','$useremail','$password','$type')";
ajouter_Agence($id,$nomEntreprise,"../avatars/".$logo,$useremail,"Siege",$adress,$home_phone,$fax,"2.222","3.255");


if ($result === TRUE) {   
if ($conn->query($sqll) === TRUE) {  /// ajouter un nouveau user et lui associer son compte
   // die( "New user  successfully");
}else {
     die( "Error: " . $sqll . "<br>" . $conn->error);
}
} else {
     die( "Error: " . $sql . "<br>" . $conn->error);
}

$conn->close();

}

function connexion($email, $password) {
try
{
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM ann_compte where login='$email' and password='$password'", $link);
$rows = mysql_num_rows($result);   
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
return $rows;
}
//function connexion($email, $password) {/*

//ajouter une agence
function ajouter_Agence($id_entreprise,$nomAgence,$couverture,$mail,$description,$adresse,$tel,$fax,$Latitude,$Longitude){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$query = mysql_query("INSERT INTO ann_agence(id_entreprise, nom_agence, couverture, tel_agence, fax_agence, mail_agence, adresse, type, latitude, longitude) VALUES ('$id_entreprise','$nomAgence','$couverture','$tel','$fax','$mail','$adresse','$description','$Latitude','$Longitude')", $link);
}



function recuperer_info($id){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
$infos=array();
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM ann_entreprise where id='$id'", $link);

$infos=mysql_fetch_assoc($result);
return $infos;
}

function recuperer_info_generale($email){

global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
$infos=array();
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM ann_compte where login='$email'", $link);
$infos=mysql_fetch_assoc($result);
return $infos;
}
function changer_infos_generale($mail,$password,$newpassword,$type,$id_enreprise){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$query = mysql_query("UPDATE ann_compte SET login='$mail',password='$newpassword',type_compte='$type' WHERE login='$mail' and password='$password'", $link);
$query = mysql_query("UPDATE ann_entreprise SET mail_responsable='$mail' WHERE id='$id_enreprise'", $link);
}
/*
 while($user=mysql_fetch_assoc($result))
{
$infos[]=$user;
} 
$tab[1]=$rows; 
$tab[]=array_merge($tab,$infos);   
}
*/
function changer_infos($siren,$mail,$nomEntreprise,$tel,$fax,$adresse,$site,$logo)
{
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$query = mysql_query("UPDATE ann_entreprise SET nom='$nomEntreprise',telephone='$tel',fax='$fax',adresse='$adresse',site_web='$site',mail_responsable='$mail',logo='$logo' WHERE num_SIREN='$siren'", $link);
die('C est bon '.$siren);
}

//ajouter document
function ajouter_Document($titre,$date,$urlftp,$couverture,$id_entreprise){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$query = mysql_query("INSERT INTO ann_document(id_entreprise, url_ftp, date_creation, titre, couverture) VALUES ('$id_entreprise','$urlftp','$date','$titre','$couverture')", $link);

}
//recuperer documents
function afficher_document($id_entreprise){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM ann_document where id_entreprise='$id_entreprise'", $link);
return $result;
}

//recuperer type de produit
function type_produit($id_entreprise){

global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM ann_type_produit where id_entreprise='$id_entreprise'", $link);
return $result;
}
// produit de type donné
function produit_du_type($id_entreprise,$type){

global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM ann_produit where id_entreprise='$id_entreprise' and type='$type'", $link);
return $result;
}

function ajouter_Produit($id_entreprise,$nomproduit,$description,$type_saisie,$image){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$query = mysql_query("INSERT INTO ann_produit(id_entreprise, nom_produit, description, image, type) VALUES ('$id_entreprise','$nomproduit','$description','$image','$type_saisie')", $link);
}






function ajouter_Type_Produit($id_entreprise,$nomtype,$description){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$query = mysql_query("INSERT INTO ann_type_produit(id_entreprise, nom_type, descritption) VALUES ('$id_entreprise','$nomtype','$description')", $link);
}

//recuperer Produit
function afficher_produit($id_entreprise){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$query="SELECT * FROM ann_produit where id_entreprise='$id_entreprise' ORDER BY type ";
$result = mysql_query($query, $link);
return $result;
}
//service

function ajouter_Service($id_entreprise,$nomservice,$description,$type_saisie,$image){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$query = mysql_query("INSERT INTO ann_service(id_entreprise, nom_service, description, image, type) VALUES ('$id_entreprise','$nomservice','$description','$image','$type_saisie')", $link);
}


function afficher_service($id){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$q="SELECT * FROM `ann_service` WHERE `id_entreprise`='$id'";
$result = mysql_query($q, $link);
return $result;
}


function modifier_Service($id,$nomservice,$description,$type_saisie,$image){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
if(!empty($image)){
$q="UPDATE `ann_service` SET `nom_service`='$nomservice',`description`='$description',`image`='$image',`type`='$type_saisie' WHERE `id_service`='$id'";}else{
$q="UPDATE `ann_service` SET `nom_service`='$nomservice',`description`='$description',`type`='$type_saisie' WHERE `id_service`='$id'";
}
$result = mysql_query($q, $link);
}


function supprimer_service($selected){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$q="DELETE FROM `ann_service` WHERE `id_service`='$selected'";
$result = mysql_query($q, $link);

}


//recupere les infos d'agences
function afficher_agence($id_entreprise){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM ann_agence where id_entreprise='$id_entreprise'", $link);
return $result;
}
//recup info agence;
function recup_info_agence($id_entreprise,$idagence){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM ann_agence where id_entreprise='$id_entreprise' and id_agence='$idagence'", $link);
return $result;
}

//supprimer produit
function supprimer_produit($id_entreprise,$idproduit){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
$result = mysql_query("DELETE FROM ann_produit WHERE id_entreprise='$id_entreprise' and id_produit='$idproduit'", $link);
return $result;
}
//supprimer Document

function supprimer_Document($id_entreprise,$iddocument){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
$result = mysql_query("DELETE FROM ann_document WHERE id_entreprise='$id_entreprise' and id_document='$iddocument'", $link);
return $result;
}

//ajouter_photo
function ajouter_photo($id,$titre,$description,$url){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$query = mysql_query("INSERT INTO ann_galerie(id_entreprise, titre, description, url) VALUES ('$id','$titre','$description','$url')", $link);
}

// affichage galerie

function afficher_galerie($id_entreprise){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM ann_galerie where id_entreprise='$id_entreprise'", $link);
return $result;
}



//actualité



function ajouter_actualite($id_entreprise,$titre,$details,$image,$date,$type){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$q="INSERT INTO `ann_actualite`(`id_entreprise`, `titre`, `details`, `image`, `date_actualite`, `type`) VALUES ('$id_entreprise','$titre','$details','$image','$date','$type')";
$query = mysql_query($q, $link);
}

function recup_actualite($id_entreprise){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM ann_actualite where id_entreprise='$id_entreprise'", $link);
return $result;
}

function modifier_actualite($id_entreprise,$titre,$details,$image,$date,$type,$idact){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$query="UPDATE `ann_actualite` SET `titre`='$titre' ,`details`='$details',`image`='$image' ,`date_actualite`='$date' ,`type`='$type' WHERE id_entreprise='$id_entreprise' and id_actualite='$idact'";
$result=mysql_query($query, $link);
}

function supp_actualite($id_entreprise,$idact){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
$query="DELETE FROM `ann_actualite` WHERE id_entreprise='$id_entreprise' and `id_actualite`='$idact'";
$result=mysql_query($query, $link);

}

//ajouter appel

function ajouter_Appel($id,$nomAppel,$description,$ref,$date){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$Q="INSERT INTO ann_appel_d_offre( id_entreprise, description, nom, Date, ref) VALUES ('$id','$description','$nomAppel','$date','$ref')";
$query = mysql_query($Q, $link);
}
//Modifier_Appel
function Modifier_Appel($id,$nomAppel,$description,$ref,$date){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$Q="UPDATE  ann_appel_d_offre SET `description`='$description',`nom`='$nomAppel',`Date`='$date',`ref`='$ref' WHERE `id`='$id'";
$query = mysql_query($Q, $link);
}
///afficher offre 
function afficher_appel($id_entreprise){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM ann_appel_d_offre where id_entreprise='$id_entreprise'", $link);
return $result;
}

//supp appel
function supprimer_Appel($id_entreprise,$idappel){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
$result = mysql_query("DELETE FROM ann_appel_d_offre WHERE id_entreprise='$id_entreprise' and id='$idappel'", $link);
return $result;
}

//supp photo
function supprimer_Photo($id_entreprise,$idPhoto){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
$result = mysql_query("DELETE FROM ann_galerie WHERE id_entreprise='$id_entreprise' and id='$idPhoto'", $link);
return $result;
}

function Modifier_infos_agence($idagence,$nomagenceModif,$couvertureModif,$mailAgenceModif,$telModif,$faxModif,$descriptionModif,$adresseModif){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$q=
"UPDATE `ann_agence` SET `nom_agence`='$nomagenceModif',`couverture`='$couvertureModif',`tel_agence`='$telModif',`fax_agence`='$faxModif',`mail_agence`='$mailAgenceModif',`adresse`='$adresseModif',`type`='$descriptionModif'
WHERE id_agence='$idagence'";

$query = mysql_query($q, $link);
}
function supprimer_agence($id_agence){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
$result = mysql_query("DELETE FROM ann_agence WHERE id_agence='$id_agence'", $link);
}

function resultatRecherche($nom, $branche, $adresse){

global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$query="SELECT * FROM ann_entreprise ";
$q1="1";

if(!empty($nom)||!empty($adresse)){
if(!empty($nom)){
$q1=" nom LIKE '%$nom%'";
}
if(!empty($adresse)){
$q1.=" and adresse LIKE '%$adresse%'";
}
}
$query.="where ";
if(!empty($q1)){
$query.=$q1;
}
$result = mysql_query($query, $link);
return $result;
}
function recuperer_filiere($id_entreprise){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM ann_filiere WHERE id_entreprise='$id_entreprise'", $link);
$row = mysql_fetch_assoc($result);
return $row;
}

function recuperer_domaine($id_domaine){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM ann_Domaine WHERE id_domaine='$id_domaine'", $link);
$row = mysql_fetch_assoc($result);
return $row;
}
function afficher_domaine(){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM ann_Domaine ", $link);
return $result;
}
function afficher_filiere($id_domaine){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM `ann_filiere` WHERE `id_domaine`='$id_domaine'", $link);
return $result;
}
function ajouter_filiere($nom_filiere,$identreprise,$id_domaine){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$q="INSERT INTO `ann_filiere` (`nom_filiere`, `id_domaine`, `id_entreprise`) VALUES('$nom_filiere','$id_domaine','$identreprise')";
$result = mysql_query($q, $link);
}
function afficher_regions(){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM ann_regions ", $link);
return $result;
}

function afficher_departement($id_region){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM `ann_departements` WHERE `num_region`='$id_region' ", $link);
return $result;
}
//annonce



function ajouter_annonce($id_entreprise,$titre,$description,$type){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$q="INSERT INTO `ann_annonce`(`id_entreprise`, `titre`, `description`, `type`) VALUES 
('$id_entreprise','$titre','$description','$type')";
$query = mysql_query($q, $link);
}

function afficher_annonce($id_entreprise){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM ann_annonce where id_entreprise='$id_entreprise'", $link);
return $result;
}

function modifier_annonce($id,$titre,$description,$type){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$query="UPDATE `ann_annonce` SET `titre`='$titre' ,`description`='$description' ,`type`='$type' WHERE id='$id'";
$result=mysql_query($query, $link);
}

function supprimer_annonce($id){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
$query="DELETE FROM `ann_annonce` WHERE id='$id'";
$result=mysql_query($query, $link);

}

//emploi



function ajouter_emploi($id_entreprise,$titre,$description,$type){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$q="INSERT INTO `ann_emploi`(`id_entreprise`, `titre`, `description`, `type`) VALUES 
('$id_entreprise','$titre','$description','$type')";
$query = mysql_query($q, $link);
}

function afficher_emploi($id_entreprise){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$result = mysql_query("SELECT * FROM ann_emploi where id_entreprise='$id_entreprise'", $link);
return $result;
}

function modifier_emploi($id,$titre,$description,$type){
global $servername;
global $username;
global $pwd;
global $dbname ;
   
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$query="UPDATE `ann_emploi` SET `titre`='$titre' ,`description`='$description' ,`type`='$type' WHERE id='$id'";
$result=mysql_query($query, $link);
}

function supprimer_emploi($id){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
$query="DELETE FROM `ann_emploi` WHERE id='$id'";
$result=mysql_query($query, $link);

}

function recup_posts($id){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$query="SELECT * FROM `ann-post`";
if(!empty($id)){
$query.=" WHERE `id`='$id'";
}

$result=mysql_query($query, $link);
return $result;
}
function recup_comments($id){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$query="SELECT * FROM `ann_comments` WHERE `id_post`='$id'";
$result=mysql_query($query, $link);
return $result;
}

function commenter($id,$user,$comment){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$q="INSERT INTO `ann_comments` (`id_post`, `user`, `contenu`) VALUES ('$id','$user','$comment')";
$result=mysql_query($q, $link);
}

function tagspopulaires(){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$query="SELECT tags,id FROM `ann-post`";
$result=mysql_query($query, $link);
$row = mysql_fetch_assoc($result);
return $row;
}
function postspopulaires(){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$query="SELECT * FROM `ann-post`";
$result=mysql_query($query, $link);
$row = mysql_fetch_assoc($result);
return $row;

}
function poster($pseudo,$nomsujet,$sujet,$tags){
global $servername;
global $username;
global $pwd;
global $dbname ;
$link = mysql_connect($servername, $username , $pwd);
mysql_select_db($dbname, $link);
mysql_query("SET NAMES UTF8") ;
$query="INSERT INTO `ann-post`(`nom`, `tags`, `contenu`, `user`) VALUES ('$nomsujet','$tags','$sujet','$pseudo')";
$result=mysql_query($query, $link);
}




?>
