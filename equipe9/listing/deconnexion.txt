<?php
	session_start();
	$nomutil=$_SESSION['utilisateur'];
	if(@mysql_connect("localhost","equipe9h15","ebola-tousqui") && @mysql_select_db("equipe9h15"))
	{	
		$query = "SELECT idutil FROM utilisateur where username='".$nomutil."'"; 
		$resultat = mysql_query($query); 
		if (!$resultat) 
		{
    			echo 'Requête invalide : '.mysql_error().'<br>';
		}
		else
		{
			$val = mysql_fetch_row($resultat);					
			$idutil=$val[0];
			$deletePanier="Delete from panier where idutil=".$idutil."";
			$resultat = mysql_query($deletePanier);
			if(!$resultat)
			{
				echo 'Requête invalide : '.mysql_error().'<br>';
			}
		}
	}
	else
	{
		echo "Impossible de se connecter à la base de données";
	}
	mysql_close();
	session_destroy();
	header("Location:index.php");
?>
