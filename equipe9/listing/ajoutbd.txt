<html>
<head>
<?php
	session_start();
	if(@$_SESSION['utilisateur']==='administrateur')
	{
		include("headerconnecteradmin.php");
	}
	else
	{
		header("Location:index.php");	
	}
?>
<script type="text/javascript" src="alertfadeout.js"></script>
</head>
<body>
	<div class="text-center col-md-4 col-md-offset-4">
	<?php
		$geterreur= @$_GET['msg'];
		
		switch($geterreur)
		{
			case "reussi": echo "<div class='alert alert-success' role='alert'>L'ajout a réussi</div>";
			break;
			case "erreur": echo "<div class='alert alert-danger' role='alert'>Une erreur est survenue</div>";
			break;
		}
	?>
	<form method="post" action="traitementajout.php" id="formajout" enctype="multipart/form-data">
		<h2>Ajouter un produit</h2>
		<h4>Nom du produit:</h4>
		<input type="text" size="25" name="nomproduit" class="form-control" maxlength="50" required/><br>
		<h4>Catégorie:</h4>
		<select  name="categorie" class="form-control col-md-1">
			<option value="voitures">Voiture</option>
			<option value="nourritures">Nourriture</option>
			<option value="sports">Sport</option>
			<option value="mobiliers">Mobilier</option>
			<option value="animaux">Animaux</option>
			<option value="electromenagers">Électroménagers</option>			
			<option value="vetements">Vêtements</option>
			<option value="electroniques">Électroniques</option>
			<option value="jardinages">Jardinages</option>
			<option value="immobiliers">Immobiliers</option>
		</select><br>
		<h4>Quantité:</h4>
		<input type="number" min="0" max="999999" value="0" name="quantite" class="form-control" maxlength="6" required/><br>
		<h4>Prix unitaire:</h4>
		<input type="text" size="25" name="prixunitaire" class="form-control" maxlength="11" required/><br><!--A valider avec JS-->
		<h4>Image:</h4>
		<input type="file" size="25" name="image"  class="form-control" maxlength="150" required/><br>
		<h4>Description:</h4>
		<textarea form ="formajout" name="description"  cols="35" rows="10" class="form-control" maxlength="500" required></textarea><br>
		<button type="submit" name="submit" class="btn btn-success">Enregistrer</button>
	</form>
	</div>

</body>
</html>
