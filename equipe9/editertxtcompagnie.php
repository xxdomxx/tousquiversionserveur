<HTML>
<HEAD>
<?php
	@session_start();
	if(@$_SESSION['utilisateur']==='administrateur')
	{
		include("headerconnecteradmin.php");
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
<script type="text/javascript" src="alertfadeout.js"></script>
</HEAD>
<BODY>
<div class="text-center col-md-8 col-md-offset-2">
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
	<form method="POST" action="traitementEnregistrer.php">
		<textarea name="ckeditor" id="ckeditor"><?php include ("presentationcompagnie.txt");?></textarea>
		<script>
			CKEDITOR.replace('ckeditor');	
		</script>
		<button class="btn btn-success" name="Enregistrer" type="submit">Enregistrer</button>
	</form>
</div>
</BODY>
</HTML>
