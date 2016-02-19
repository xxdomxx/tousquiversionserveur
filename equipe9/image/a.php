<?php
$prenomutil=$_REQUEST["prenom"];
setcookie("prenomutil",$prenomutil,time()+(24*3600)); //365*24*3600  //= 1 an
?>
<html>
	<body>
		<center>
		<fieldset>
			<?php
			$infomembre=array();
			$nom=$_REQUEST['nom'];
			$prenom=$_REQUEST['prenom'];
			$adresse=$_REQUEST['adresse'];
			$ville=$_REQUEST['ville'];
			$courriel=$_REQUEST['courriel'];
			$sexe=$_REQUEST['sexe'];
			$nomusager=$_REQUEST['nomutil'];
			$mdp=$_REQUEST['mdp'];

			array_push($infomembre, $nom, $prenom, $sexe, $adresse, $ville, $courriel,$nomusager,$mdp);
		
			$inscription="";		
			foreach($infomembre as $var)
			{
				if($inscription!="")
				{
					$inscription=$inscription."|".$var;
				}
				else
				{
					$inscription=$var;
				}
			}
		
		
			if($fo=fopen("lab4enregistrement.txt","a"))
			{	
				fputs($fo,"$inscription \n");
				fclose($fo);
				echo "Nom: $nom <br>";
				echo "Prenom: $prenom <br>";
				echo "Sexe: $sexe <br>";
				echo "Adresse: $adresse <br>";
				echo "Ville: $ville <br>";
				echo "Courriel: $courriel <br>";
				echo "Nom d'usager: $nomusager<br>";
				echo "Mot de passe: $mdp <br>";
				echo "Bravo! L'inscription a réussi!<br>";
				echo "<a href='b.php'>b.php</a>";
				
			}
			else
			{
				echo "L'inscription n'a pas réussi :(";
			}
			?>
		</center>
		</fieldset>
	</body>
</html>
