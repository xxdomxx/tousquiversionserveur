<?php
	echo "<h4><a href='recherche.php'>Recherches avancées</a></h4>";
	$link = mysql_connect("localhost","equipe9h15","ebola-tousqui");
	mysql_set_charset('utf8',$link);	
	$geterreur= @$_GET['msg'];
	switch($geterreur)
	{
		case "reussi": echo "<div class='alert alert-success' role='alert'>L'ajout a réussi</div>";
		break;
		case "erreur": echo "<div class='alert alert-danger' role='alert'>Une erreur est survenue</div>";
	}
	echo "<h3>Produits récemment ajoutés</h3>";
	if(@mysql_connect("localhost","equipe9h15","ebola-tousqui") && @mysql_select_db("equipe9h15"))
	{	
		$query = "SELECT * From produit order by idproduit desc limit 6";
		$val = 6;

		$resultat = mysql_query($query);
 
		if (!$resultat) 
		{
			echo 'Requête invalide : '.mysql_error().'<br>';
		}
		else
		{
			$nbobjetparpage=$val;
			$ordrephotos=1;

			while($val = mysql_fetch_array($resultat))
			{
				$idproduit=$val["idproduit"];
				$nomproduit=$val["nomproduit"];
				$quantite=$val["quantite"];
				$prixunitaire=$val["prixunitaire"];
				$image=$val["image"];
				$description=$val["description"];
				
				if($ordrephotos==1)
				{
					$ordrephotos=2;
					echo "<div class='row col-md-push-1 col-md-10'>";
					  echo "<div class='text-center col-md-4'>";
					   echo"  <div class='thumbnail'>";
					      echo "<img src='$image' alt='image' style='width:250px;height:200px'>";
					      echo "<div class='caption'>";
						echo "<h3>$nomproduit</h3>";
						echo "<h5>Description: $description</h5>";
						echo "<h5>Prix: $prixunitaire</h5>";
						echo "<h5>Quantité: $quantite</h5>";
						echo "<p><a href='traitementpanier.php?prod=$idproduit&index=true' class='btn btn-primary' role='button'>Ajouter au panier</a></p>";
					       echo "</div>";
					     echo "</div>";
					  echo "</div>";
				}
				else
				{
					if($ordrephotos==2)
					{
						$ordrephotos=3;
						  echo "<div class='text-center col-md-4'>";
						   echo"  <div class='thumbnail'>";
						      echo "<img src='$image' alt='image' style='width:250px;height:200px'>";
						      echo "<div class='caption'>";
							echo "<h3>$nomproduit</h3>";
							echo "<h5>Description: $description</h5>";
							echo "<h5>Prix: $prixunitaire</h5>";
							echo "<h5>Quantité: $quantite</h5>";
							echo "<p><a href='traitementpanier.php?prod=$idproduit&index=true' class='btn btn-primary' role='button'>Ajouter au panier</a></p>";
						       echo "</div>";
						     echo "</div>";
						  echo "</div>";	
					}
					else
					{
						$ordrephotos=1;
						  echo "<div class='text-center col-md-4'>";
						   echo"  <div class='thumbnail'>";
						      echo "<img src='$image' alt='image' style='width:250px;height:200px'>";
						      echo "<div class='caption'>";
							echo "<h3>$nomproduit</h3>";
							echo "<h5>Description: $description</h5>";
							echo "<h5>Prix: $prixunitaire</h5>";
							echo "<h5>Quantité: $quantite</h5>";
							echo "<p><a href='traitementpanier.php?prod=$idproduit&index=true' class='btn btn-primary' role='button'>Ajouter au panier</a></p>";
						       echo "</div>";
						     echo "</div>";
						  echo "</div>";
						echo "</div>";	
					}
				}
			}
			if($ordrephotos!=1)
			{
				echo "</div>";
			}
		}
	}
	else
	{
		echo "Impossible de se connecter à la base de données";
	}
	mysql_close();
?>

