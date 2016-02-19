<?php
session_start();
if(@$_SESSION['utilisateur']==='administrateur')
{
	include("headerconnecteradmin.php");
	$idproduit=$_REQUEST["idproduit"];
	$nomproduit=$_REQUEST["nomproduit"];
	$categorie=$_REQUEST["categorie"];
	$quantite=$_REQUEST["quantite"];
	$prixunitaire=$_REQUEST["prixunitaire"];
	//$image=@$_REQUEST["image"];
	$description=$_REQUEST["description"];
	$dir = "/var/mers/html/projet/h2015/equipe9/image/";
	$link = mysql_connect("localhost","equipe9h15","ebola-tousqui");
	mysql_set_charset('utf8',$link);
	$today = date("YmdHis");

	/*echo "id: $idproduit<br>";
	echo "nomproduit $nomproduit<br>";
	echo "categorie $categorie<br>";
	echo "quantite $quantite<br>";
	echo "prix $prixunitaire<br>";
	echo "description $description<br>";*/

	if(@mysql_connect("localhost","equipe9h15","ebola-tousqui") && @mysql_select_db("equipe9h15"))
	{
		
			if (@copy($_FILES["image"]["tmp_name"],$dir.$_FILES["image"]["name"].$today))
			{
				$image=$_FILES["image"]["name"].$today;
				$queryimagemodif = "UPDATE produit SET nomproduit='$nomproduit', categories='$categorie', quantite=$quantite, prixunitaire=$prixunitaire, image='image/$image', description='$description' where idproduit=$idproduit;"; 
				$resultimagemodif = mysql_query($queryimagemodif); 	
				if (!$resultimagemodif) {
					header("Location:modifierbd.php?msg=erreur");
					//echo 'Requête invalide : '.mysql_error().'<br>';
				}
				else
				{
					header("Location:modifierbd.php?msg=reussi");
					//echo "reussi update";
				}
			}
			else 
			{
				$queryimage="UPDATE produit SET nomproduit='$nomproduit' ,categories='$categorie' ,quantite=$quantite ,prixunitaire=$prixunitaire, description='$description' where idproduit=$idproduit;";
				$resultimage=mysql_query($queryimage);
				if(!$resultimage)
				{
					header("Location:modifierbd.php?msg=erreur");
					//echo 'Requête invalide : '.mysql_error().'<br>';
				}
				else
				{
					header("Location:modifierbd.php?msg=reussi");	
					///echo "reussi update 2";	
				}
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

