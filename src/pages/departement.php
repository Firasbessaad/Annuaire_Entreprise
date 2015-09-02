<?php
$id_region = intval($_GET['id']);
include('./fonction/Function.php');
$departements=afficher_departement($id_region);
?>
<select id="ville" name="ville" class="form-control">
 <?php   
while($departement = mysql_fetch_assoc($departements)){
?>
<option value="<?php echo $departement['num_departement']; ?>"><?php echo $departement['nom']; ?></option>
<?php
}

?>
</select>
