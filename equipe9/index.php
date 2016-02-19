<html>
<head>
<?php
	@session_start();
	if(@$_SESSION['utilisateur']==='administrateur')
	{
		include("headerconnecteradmin.php");
	}
	else
	{
		if(@$_SESSION['utilisateur'])
		{
			include("headerconnecter.php");
		}
		else
		{
			include("header.php");
		}
	}
?>
<!--<script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>-->
<script type="text/javascript" src="http://s3.amazonaws.com/codecademy-content/courses/hour-of-code/js/alphabet.js"></script>
<script type="text/javascript" src="alertfadeout.js"></script>
</head>
<body>
<div class="text-center col-md-8 col-md-offset-2">
	<?php
		$geterreur= @$_GET['erreur'];
		if(@$geterreur)
		{
			echo "<div class='alert alert-danger' role='alert'>Erreur de connexion veuillez réessayer</div>";	
		}
	?>
	<?php
		if(@$_COOKIE['nomidentifiant'])
		{ 
			$_nomidentifiant=$_COOKIE['nomidentifiant'];
			$link = mysql_connect("localhost","equipe9h15","ebola-tousqui");
			mysql_set_charset('utf8',$link);
	
			if(@mysql_connect("localhost","equipe9h15","ebola-tousqui") && @mysql_select_db("equipe9h15"))
			{
				$query = "SELECT forme FROM utilisateur where username='".$_nomidentifiant."'"; 
				$resultatforme = mysql_query($query); 
				if (!$resultatforme) 
				{
					echo 'Requête invalide : '.mysql_error().'<br>';
				}
				else
				{
					$valforme = mysql_fetch_row($resultatforme);					
					$forme=$valforme[0];
				}
				echo "<input type='hidden' value='$_nomidentifiant' id='nomutilisateurbubble'/>";
				echo "<input type='hidden' value='$forme' id='formechoisi'/>";
				//echo "Bonjour $_nomidentifiant!";
				echo "<canvas id='myCanvas'></canvas>";
			}
			else
			{
				echo "Impossible de se connecter à la base de données";
			}
			mysql_close();
			
		}
		else
		{
			echo "<h3>";
			include("presentationcompagnie.txt");
			echo "</h3>";
		}
	?>
	<script type="text/javascript" src="bubule.js"></script>
	<script type="text/javascript" src="Tousquibubule.js"></script>
<?php

	if(@$_SESSION['utilisateur'] && @$_SESSION['utilisateur'] != 'administrateur')
	{
		include("produitIndexConnecter.php");
	}
	else
	{
		include("produitIndexNonConnecter.php");
	}
?>
</div>
</body>
</html>
