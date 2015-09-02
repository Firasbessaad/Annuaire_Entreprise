<?php
$id_domaine = intval($_GET['id']);
include('./fonction/Function.php');
$filieres=afficher_filiere($id_domaine);
?>
<select id="branche" name="branche" class="form-control">
 <?php   
while($filiere = mysql_fetch_assoc($filieres)){
?>
<option value="<?php echo $filiere['id_filiere']; ?>"><?php echo $filiere['nom_filiere']; ?></option>
<?php
}

?>
</select>
