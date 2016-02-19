<html>
<head>
<?php
	session_start();
	if(@$_SESSION['utilisateur']==='administrateur')
	{
		header("Location:index.php");
	}
	else
	{
		if(@$_SESSION['utilisateur'])
		{
			include("headerconnecter.php");
		}
		else
		{
			include("header.php");
		}
	}
?>
</head>
<body>
	<div class="text-center col-md-4 col-md-offset-4">
	<form method="post" action="produit.php?page=1">
		<input type="text" name="recherche" class="form-control" placeholder="Recherche"/><br>
		<select  name="categorie" class="form-control col-md-1">
			<option value="all">Toutes les catégories</option>
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
		<!--<br>Prix: <br>
		<input type="text" size="10" maxlength="10" class="form-control"/> à <input type="text" size="10" maxlength="10"class="form-control"/>-->
		
		<button type="submit" class="btn btn-default">Rechercher</button>
	</form>
	</div>
</body>
</html>

