<body>
<h4><a href="recherche.php">Recherches avancées</a></h4>
<div class="text-center">
<?php
	$pagecourante=@$_GET["page"];
	$pagefooter=$pagecourante;
	$link = mysql_connect("localhost","equipe9h15","ebola-tousqui");
	mysql_set_charset('utf8',$link);	

	if(@$_REQUEST["recherche"])
	{
		$objetrechercher=@$_REQUEST["recherche"];
	}
	else
	{
		$objetrechercher=@$_GET["recherche"];
	}
	if(@$_REQUEST["categorie"])
	{
		$categorie=@$_REQUEST["categorie"];
	}
	else
	{
		$categorie=@$_GET["categorie"];
	}
	echo "<h2>Résultats pour la recherche:  <b>$objetrechercher</b></h2>";
	$pagecourante=(($pagecourante-1)*9);
	
	if(@mysql_connect("localhost","equipe9h15","ebola-tousqui") && @mysql_select_db("equipe9h15"))
	{
		if($categorie=='all')
		{
			$query = "SELECT * FROM produit where nomproduit LIKE '%{$objetrechercher}%' or description LIKE '%{$objetrechercher}%' LIMIT $pagecourante,9"; 
			$nbobjets = "SELECT count(*) FROM produit where nomproduit LIKE '%{$objetrechercher}%' or description LIKE '%{$objetrechercher}%'";
		}
		else
		{
			$query = "SELECT * FROM produit where (nomproduit LIKE '%{$objetrechercher}%' or description LIKE '%{$objetrechercher}%') and categories='$categorie' LIMIT $pagecourante,9";
			$nbobjets = "SELECT count(*) FROM produit where (nomproduit LIKE '%{$objetrechercher}%' or description LIKE '%{$objetrechercher}%') and categories='$categorie'";
		}
	
		$resultat = mysql_query($query);
		$resultatobj= @mysql_query($nbobjets);
	 
		if (!$resultat or !$resultatobj) 
		{
			echo 'Requête invalide : '.mysql_error().'<br>';
		}
		else
		{
			$val = mysql_fetch_row($resultatobj);	
			$nbobjetparpage=$val[0];
			$nbpage=ceil($nbobjetparpage/9);
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
</div>
</body>
<footer>
<div class="text-center">
<?php
echo "<div class='row col-md-push-1 col-md-10'>";
echo "<hr>";
echo "<nav>";
  echo "<ul class='pagination'>";
  $i=1;
  while(@$nbpage>0)
  {
    if($pagefooter==$i)
    {
    	echo "<li class='active'><a href='produit.php?page=$i&recherche=$objetrechercher&categorie=$categorie'>$i<span class='sr-only'>(current)</span></a></li>";
    }
    else
    {
    	echo "<li><a href='produit.php?page=$i&recherche=$objetrechercher&categorie=$categorie'>$i</a></li>";
    }
    $i++;
    $nbpage--;
  }
  echo "</ul>";
echo "</nav>";
echo "</div>";
?>
</div>
</footer>
