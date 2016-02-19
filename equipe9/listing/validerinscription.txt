<html>
<head></head>
<body>
<?php

	$nom=$_REQUEST['nom'];
	$prenom=$_REQUEST['prenom'];
	$courriel = $_REQUEST['courriel'];
	$mdp= $_REQUEST['mdp'];
	$mdpverif= $_REQUEST['mdpverif'];
	$nomutil= $_REQUEST['nomutil'];

	$adresse=$_REQUEST['adresse'];
	$codepostal=$_REQUEST['codepostal'];
	$ville=$_REQUEST['ville'];
	$datecreation=date("Y-m-d");

	$erreurcourriel=false;
	$erreurmdp=false;
	$erreur=0;
	
	$link = mysql_connect("localhost","equipe9h15","ebola-tousqui");
	mysql_set_charset('utf8',$link);


	if(!filter_var($courriel, FILTER_VALIDATE_EMAIL))
  	{
  		$erreurcourriel=true;
		$erreur=$erreur+1;
  	}
	if($mdp!=$mdpverif)
	{
		$erreurmdp=true;
		$erreur=$erreur+2;
	}
	if($erreurcourriel===false and $erreurmdp===false)
	{
		
		if(@mysql_connect("localhost","equipe9h15","ebola-tousqui") && @mysql_select_db("equipe9h15"))
		{
			$query = "INSERT INTO utilisateur(username,mdputil,prenomutil,nomutil,courrielutil,adresse,codepostal,ville,datecreation,forme) VALUES('$nomutil','$mdp', '$prenom','$nom','$courriel','$adresse','$codepostal','$ville','$datecreation','circle')"; 
			$result = mysql_query($query); 	
			if (!$result) {
				//echo 'Requête invalide : '.mysql_error().'<br>';
				$erreur=4;
				header("Location:inscription.php?erreur=$erreur");
			}
			else
			{
			     $headers ='From: "TousquiShop"<noreply@tousquishop.ca>'."\n";
			     $headers .="Reply-To: $courriel"."\n";
			     $headers .='Content-Type: text/plain; charset="utf-8"'."\n";
			     $headers .='Content-Transfer-Encoding: 8bit';

			     if(mail("$courriel", 'Inscription', "Merci de vous être inscrit sur le site de TousquiShop!", $headers))
			     {
				  echo 'Le message a bien été envoyé';
				  echo $courriel;
			     }
			     else
			     {
				  echo 'Le message n\'a pu être envoyé';
				  echo $courriel;
			     } 
				setcookie("nomidentifiant",$nomutil,time()+365*24*3600);
				header("Location:index.php");
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
		header("Location:inscription.php?erreur=$erreur");
	}
?>
</body>
</html>
