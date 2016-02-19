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
<script type="text/javascript" src="alertfadeout.js"></script>
</head>
<?php

	if(@$_SESSION['utilisateur'])
	{
		include("produitconnecter.php");
	}
	else
	{
		include("produitnonconnecter.php");
	}
?>
</html>

