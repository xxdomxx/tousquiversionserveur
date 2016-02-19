<?php
session_start();
if(@$_SESSION['utilisateur']==='administrateur')
{
	$nomproduit=$_REQUEST['nomproduit'];
	$categorie=$_REQUEST['categorie'];
	$quantite = $_REQUEST['quantite'];
	$prixunitaire= $_REQUEST['prixunitaire'];
	//$image= $_REQUEST['image'];
	$description= $_REQUEST['description'];
	$today = date("YmdHis"); 
	$link = mysql_connect("localhost","equipe9h15","ebola-tousqui");
	mysql_set_charset('utf8',$link);

	$dir = "/var/mers/html/projet/h2015/equipe9/image/";
	if (isset($_FILES["image"]))
	{
		if ( copy($_FILES["image"]["tmp_name"],$dir.$_FILES["image"]["name"].$today))
		{
			$image=$_FILES["image"]["name"].$today;
			if(@mysql_connect("localhost","equipe9h15","ebola-tousqui") && @mysql_select_db("equipe9h15"))
			{
			
				$query = "INSERT INTO produit(nomproduit,categories,quantite,prixunitaire,image,description) VALUES('$nomproduit','$categorie', '$quantite','$prixunitaire','image/$image','$description')"; 
				$result = mysql_query($query); 	
				if (!$result) {
					header("Location:ajoutbd.php?msg=erreur");
				}
				else
				{
					header("Location:ajoutbd.php?msg=reussi");
				}
			}
			/*else
			{
				echo "Impossible de se connecter à la base de données";
			}*/
			mysql_close();
		}
		else {
			header("Location:ajoutbd.php?msg=erreur");
		}
	}
	
}
else
{
	header("Location:index.php");
}
?>
