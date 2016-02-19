<?php
session_start();
if(@$_SESSION['utilisateur']==='administrateur')
{
	include("headerconnecteradmin.php");
	$nomproduit=$_REQUEST["nomproduit"];
	$idproduit=$_REQUEST["idproduit"];
	if(@mysql_connect("localhost","equipe9h15","ebola-tousqui") && @mysql_select_db("equipe9h15"))
	{
		$query = "DELETE FROM produit where idproduit='$idproduit';"; 
		$result = mysql_query($query); 	
		if (!$result) {
			//echo 'Requête invalide : '.mysql_error().'<br>';
			header("Location:supprimebd.php?msg=erreur");
		}
		else
		{
			header("Location:supprimebd.php?msg=reussi");
		}
	}
	/*else
	{
		echo "Impossible de se connecter à la base de données";
	}*/
	mysql_close();
}
else
{
	header("Location:index.php");
}
?>
