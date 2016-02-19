<?php
	$nomutil=$_REQUEST["nomutil"];
	$mdprequest=$_REQUEST["mdp"];
	if(@mysql_connect("localhost","equipe9h15","ebola-tousqui") && @mysql_select_db("equipe9h15"))
	{	
		$query = "SELECT mdputil FROM utilisateur where username='$nomutil'"; 
		$resultat = mysql_query($query); 
		if (!$resultat) {
			echo 'Requête invalide : '.mysql_error().'<br>';
		}
		else
		{	
			$val = mysql_fetch_row($resultat);					
			$mdp=$val[0];
			if($mdprequest==$mdp)
			{
				session_start();
				$_SESSION['utilisateur']=$nomutil;
				setcookie("nomidentifiant",$nomutil,time()+365*24*3600);
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
				header("Location:index.php");
			}
			else
			{
				$erreur=1;
				header("Location:index.php?erreur=$erreur");
			}
		}
	}
	else
	{
		echo "Impossible de se connecter à la base de données";
	}
	mysql_close();
?>
