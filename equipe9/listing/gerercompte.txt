<html>
<head>
<?php
	session_start();
	if(@$_SESSION['utilisateur']=='administrateur')
	{
		include("headerconnecteradmin.php");
	}
	else
	{
		if(@$_SESSION['utilisateur'])
		{
			include("headerconnecter.php");
			$nomutil=$_SESSION['utilisateur'];
		}
		else
		{
			header("Location:index.php");
		}
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
		case "reussi": echo "<div class='alert alert-success' role='alert'>La modification a réussi</div>";
		break;
		case "erreur": echo "<div class='alert alert-danger' role='alert'>Une erreur est survenue</div>";
		break;
	}
?>
	<h2>Gérer le compte</h2>
	<form method="post" action="traitementgerercompte.php">
		<h3>Changer le mot de passe</h3>
		<h4>Mot de passe:</h4>
		<input type="password" size="25" name="mdp" class="form-control" required/><br>
		<h4>Nouveau mot de passe:</h4>
		<input type="password" size="25" name="newmdp" class="form-control" required/><br>
		<h4>Confirmation nouveau mot de passe:</h4>
		<input type="password" size="25" name="newmdpverif" class="form-control" required/><br>
		<input type="hidden" name="actionafaire" value="modifmdp"/>
		<button type="submit" name="submit" class="btn btn-success">Appliquer</button>
	</form>
	<hr>
	<form method="post" action="traitementgerercompte.php">
		<h3>Changer vos préférences</h3>
		<label for="cercle">
			<input type="radio" name="formedunom" id="cercle" value="circle"checked/>
			Cercle
		</label>
		<br>
		<label for="carre">
			<input type="radio" name="formedunom" id="carre" value="square">
			Carré
		</label>
		<br>
		<br>
		<input type="hidden" name="actionafaire" value="changerpref"/>
		<button type="submit" name="submit" class="btn btn-success">Appliquer</button>
	</form>
	</div>
</body>
</html>
