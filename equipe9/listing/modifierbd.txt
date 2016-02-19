<html>
<head>
<?php
	session_start();
	if(@$_SESSION['utilisateur']==='administrateur')
	{
		include("headerconnecteradmin.php");
	}
	else
	{
		header("Location:index.php");	
	}
?>
<script type="text/javascript" src="modifierobjetmodal.js"></script>
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
	
	<form method="post" action="modifierbd.php">
		<input type="text" class="form-control" placeholder="Recherche" name="recherche"><br>
		<button type="submit" name="submit" class="btn btn-default">Rechercher</button>
	</form>
	</div>
	<div class="text-center col-md-push-1 col-md-10">
<?php	
	$objetrechercher="";
	$link = mysql_connect("localhost","equipe9h15","ebola-tousqui");
	mysql_set_charset('utf8',$link);
	if(@$_REQUEST["recherche"])
	{
		$objetrechercher=@$_REQUEST["recherche"];
	}
	echo "<h2>Résultats pour la recherche:  <b>$objetrechercher</b></h2>";
	if(@mysql_connect("localhost","equipe9h15","ebola-tousqui") && @mysql_select_db("equipe9h15"))
	{	
		
		$query = "SELECT * FROM produit where nomproduit LIKE '%{$objetrechercher}%' or description LIKE '%{$objetrechercher}%'";
		$resultat = mysql_query($query);
		if (!$resultat) 
		{
			echo 'Requête invalide : '.mysql_error().'<br>';
		}
		else
		{
			$ordrephotos=1;

			while($val = mysql_fetch_array($resultat))
			{
				$id=$val["idproduit"];
				$nomproduit=$val["nomproduit"];
				$categorie=$val["Categories"];
				$quantite=$val["quantite"];
				$prixunitaire=$val["prixunitaire"];
				$image=$val["image"];
				$description=$val["description"];
				
				if($ordrephotos==1)
				{
					$ordrephotos++;
					echo "<div class='row col-md-push-1 col-md-10'>";
					  echo "<div class='text-center col-md-2'>";
					   echo"  <div class='thumbnail'>";
					      echo "<img src='$image' alt='image' style='width:100px;height:75px'>";
					      echo "<div class='caption'>";
						echo "<h5>$nomproduit</h5>";
						echo "<span class='categorie' hidden>$categorie</span>";
						echo "<span class='quantite' hidden>$quantite</span>";
						echo "<span class='prixunitaire' hidden>$prixunitaire</span>";
						echo "<span class='description' hidden>$description</span>";
						echo "<span class='image' hidden>$image</span>";
						echo "<p><a href='#' id='$id' class='btn btn-success btn-xs' data-toggle='modal' data-target='#myModal' role='button'>Modifier</a></p>";
					       echo "</div>";
					     echo "</div>";
					  echo "</div>";
				}
				else
				{
					if($ordrephotos<6)
					{	
					  $ordrephotos++;
					   echo "<div class='text-center col-md-2'>";
					    echo"  <div class='thumbnail'>";
					      echo "<img src='$image' alt='image' style='width:100px;height:75px'>";
					      echo "<div class='caption'>";
						echo "<h5>$nomproduit</h5>";
						echo "<span class='categorie' hidden>$categorie</span>";
						echo "<span class='quantite' hidden>$quantite</span>";
						echo "<span class='prixunitaire' hidden>$prixunitaire</span>";
						echo "<span class='description' hidden>$description</span>";
						echo "<span class='image' hidden>$image</span>";
						echo "<p><a href='#' id='$id' class='btn btn-success btn-xs' data-toggle='modal' data-target='#myModal' role='button'>Modifier</a></p>";
					       echo "</div>";
					     echo "</div>";
					  echo "</div>";
					}
					else
					{
						 $ordrephotos=1;
						   echo "<div class='text-center col-md-2'>";
						    echo"  <div class='thumbnail'>";
						      echo "<img src='$image' alt='image' style='width:100px;height:75px'>";
						      echo "<div class='caption'>";
							echo "<h5>$nomproduit</h5>";
							echo "<span class='categorie' hidden>$categorie</span>";
							echo "<span class='quantite' hidden>$quantite</span>";
							echo "<span class='prixunitaire' hidden>$prixunitaire</span>";
							echo "<span class='description' hidden>$description</span>";
							echo "<span class='image' hidden>$image</span>";
							echo "<p><a href='#' id='$id' class='btn btn-success btn-xs' data-toggle='modal' data-target='#myModal' role='button'>Modifier</a></p>";
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

<!-- Modal -->
<form method='post' action='traitementmodifier.php' enctype="multipart/form-data">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Voulez-vous vraiment appliquer les modifications?</h4>
      </div>
      <div class="modal-body">
		<input type="text" id="idproduitamodifier" name="idproduit" value="" hidden/><br>
		<h4>Nom du produit</h4>
		<input type="text" id="nomproduitamodifier" name="nomproduit" value="" class="form-control" required/><br>
		<h4>Catégorie</h4>
		<select id="categorieamodifier"  name="categorie" class="form-control col-md-1">
			<option value="voitures">Voiture</option>
			<option value="nourritures">Nourriture</option>
			<option value="sports">Sport</option>
			<option value="mobiliers">Mobilier</option>
			<option value="animaux">Animaux</option>
			<option value="electromenagers">Électroménagers</option>			
			<option value="vetements">Vêtements</option>
			<option value="electroniques">Électroniques</option>
			<option value="jardinages">Jardinages</option>
			<option value="immobiliers">Immobiliers</option>
		</select><br>
		<h4>Quantité</h4>
		<input type="number" id="quantiteamodifier" name="quantite" value="" class="form-control" required/><br>
		<h4>Prix unitaire</h4>
		<input type="text" id="prixunitaireamodifier" name="prixunitaire" value="" class="form-control" required/><br>
		<h4>Image</h4>
		<input type="file" id="imageamodifier" size="25" name="image" value="" class="form-control" maxlength="150" /><br>
		<h4>Description</h4>
		<textarea id="descriptionamodifier" name="description" value=""  cols="35" rows="10" class="form-control" maxlength="500" required></textarea><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
        <button type="submit" class="btn btn-primary">Oui</button>
      </div>
    </div><!-- endcontentModal -->
  </div><!-- enddialogModal -->
</div><!-- endModal -->
</form>

</body>
</html>
