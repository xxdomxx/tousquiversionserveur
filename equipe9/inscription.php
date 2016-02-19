<html>
<head>
<?php
	session_start();
	if(@$_SESSION['utilisateur'])
	{
		header("Location:index.php");
	}
	else
	{
		include("header.php");
	}
?>
<script type="text/javascript" src="alertfadeout.js"></script>
</head>
<body>
	<?php
		$geterreur= @$_GET['erreur'];
		
		switch($geterreur)
		{
			case 1:$champserreur="Courriel";
			break;
			case 2:$champserreur="Mot de passe";
			break;
			case 3:$champserreur="Mot de passe et Courriel";
			break;
			case 4:$champserreur="Nom d'utilisateur";
			break;
			default: $champserreur="t'es un petit comique!!!";
		}
		if(@$geterreur)
		{
			echo "<div class='alert alert-danger' role='alert'>Une erreur est survenueLe ou les champs <b>$champserreur</b> sont invalides.</div>";	
		}
	?>
	<div class="text-center col-md-4 col-md-offset-4">
	<form method="post" action="validerinscription.php">
		<h2>Inscription</h2>
		<h4>Nom d'utilisateur:</h4>
		<input type="text" size="25" name="nomutil" class="form-control" required/><br>
		<h4>Mot de passe:</h4>
		<input type="password" size="25" name="mdp" class="form-control" required/><br>
		<h4>Vérification mot de passe:</h4>
		<input type="password" size="25" name="mdpverif" class="form-control" required/><br>
		<h4>Prénom:</h4>
		<input type="text" size="25" name="prenom" class="form-control" required/><br>
		<h4>Nom:</h4>
		<input type="text" size="25" name="nom" class="form-control" required/><br>
		<h4>Courriel:</h4>
		<input type="text" size="40" name="courriel" class="form-control" placeholder="exemple@exemple.com" required/><br>
		<h4>Adresse:</h4>
		<input type="text" size="40" name="adresse" class="form-control" required/><br>
		<h4>Code postal:</h4>
		<input type="text" size="7" name="codepostal" class="form-control" placeholder="A0A 0A0" maxlength="7" required/><br>
		<h4>Ville:</h4>
		<input type="text" size="40" name="ville" class="form-control" required/><br>
		<button type="submit" name="submit" class="btn btn-default">S'inscrire</button>
	</form>
	
	</div>

</body>
</html>
