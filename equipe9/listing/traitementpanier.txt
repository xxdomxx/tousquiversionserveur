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
			$nomutil=$_SESSION['utilisateur'];
		}
		else
		{
			header("Location:index.php");			
		}
	}
?>
</head>
<body>
<div class="text-center">
<?php
	/*delete*/	
	@$idpanier=$_REQUEST['btnSupprimerLigne'];
	if($idpanier!=null)
	{
		if(@mysql_connect("localhost","equipe9h15","ebola-tousqui") && @mysql_select_db("equipe9h15"))
		{	
			$query = "delete FROM panier where idpanier='".$idpanier."'";
			$resultat = mysql_query($query);
	
			if (!$resultat) 
			{
				echo 'Requête invalide : '.mysql_error().'<br>';
			}
			else
			{
				header("Location:panier.php");
			}
		}	
		else	
		{
			echo "Impossible de se connecter à la base de données";
		}
		mysql_close();
	}


	/*ajout*/
	@$ajoutpanier=$_GET['prod'];
	@$page=$_GET['page'];
	@$recherche=$_GET['recherche'];
	@$categorie=$_GET['categorie'];
	@$index=$_GET['index'];
	if($ajoutpanier!=null)
	{
		if(@mysql_connect("localhost","equipe9h15","ebola-tousqui") && @mysql_select_db("equipe9h15"))
		{	
			$query = "Select idutil FROM utilisateur where username='".$nomutil."'";
			$resultat = mysql_query($query);
	
			if (!$resultat) 
			{
				echo 'Requête invalide : '.mysql_error().'<br>';				
				header("Location:produit.php?page=$page&recherche=$recherche&categorie=$categorie&msg=erreur");
			}
			else
			{
				$val = mysql_fetch_row($resultat);
				$idutil=$val[0];
				$datecreation=date("Y-m-d");
				$queryajoutpanier="INSERT INTO panier(idproduit,idutil,DateCommande,Quantite) VALUES('$ajoutpanier','$idutil', '$datecreation','1')";
				$resultatajoutpanier=mysql_query($queryajoutpanier);
				if(!$index)
				{
					header("Location:produit.php?page=$page&recherche=$recherche&categorie=$categorie&msg=reussi");
				}
				else
				{	
					header("Location:index.php?msg=reussi");
				}
			}
		}	
		else	
		{
			echo "Impossible de se connecter à la base de données";
			if(!$index)
			{
					header("Location:produit.php?page=$page&recherche=$recherche&categorie=$categorie&msg=erreur");
			}
			else
			{	
					header("Location:index.php?msg=erreur");
			}
		}
		mysql_close();
	}
?>
</div>
</body>
<footer>

</div>
</footer>
</html>
