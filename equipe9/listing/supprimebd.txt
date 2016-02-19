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
<script type="text/javascript" src="supprimeobjetmodel.js"></script>
<script type="text/javascript" src="alertfadeout.js"></script>
</head>
<body>
<div class="text-center col-md-4 col-md-offset-4">
<?php
	$geterreur= @$_GET['msg'];
	
	switch($geterreur)
	{
		case "reussi": echo "<div class='alert alert-success' role='alert'>La suppression a réussi</div>";
		break;
		case "erreur": echo "<div class='alert alert-danger' role='alert'>Une erreur est survenue</div>";
		break;
	}
?>
	
	<form method="post" action="supprimebd.php">
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
				$image=$val["image"];
				
				if($ordrephotos==1)
				{
					$ordrephotos++;
					echo "<div class='row col-md-push-1 col-md-10'>";
					  echo "<div class='text-center col-md-2'>";
					   echo"  <div class='thumbnail'>";
					      echo "<img src='$image' alt='image' style='width:100px;height:75px'>";
					      echo "<div class='caption'>";
						echo "<h5>$nomproduit</h5>";
						echo "<p><a href='#' id='$id' class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal' role='button'>Supprimer</a></p>";
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
						echo "<p><a href='#' id='$id' class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal' role='button'>Supprimer</a></p>";
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
							echo "<p><a href='#' id='$id' class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal' role='button'>Supprimer</a></p>";
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
<form method='post' action='traitementsupprimer.php'>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Voulez-vous vraiment supprimer?</h4>
      </div>
      <div class="modal-body">
		<h3 id="produitadelete"></h3>
		<input type="hidden" id="idadelete" name="idproduit" value=""/>
		<input type="hidden" id="produitadelete2" name="nomproduit" value=""/>
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
