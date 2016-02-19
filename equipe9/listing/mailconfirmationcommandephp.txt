<?php
	session_start();
	$link = mysql_connect("localhost","equipe9h15","ebola-tousqui");
	mysql_set_charset('utf8',$link);
	$nomutil=$_SESSION['utilisateur'];

	if(@mysql_connect("localhost","equipe9h15","ebola-tousqui") && @mysql_select_db("equipe9h15"))
	{	
		$querycourriel = "SELECT courrielutil FROM utilisateur where username='$nomutil'";
		$resultatcourriel = mysql_query($querycourriel);
		if (!$resultatcourriel) 
		{
			echo 'Requête invalide : '.mysql_error().'<br>';
		}
		else
		{
			$val = mysql_fetch_row($resultatcourriel);					
			$courriel=$val[0];
			$headers ='From: "TousquiShop"<noreply@tousquishop.ca>'."\n";
			$headers .="Reply-To: $courriel"."\n";
			$headers .='Content-Type: text/plain; charset="utf-8"'."\n";
			$headers .='Content-Transfer-Encoding: 8bit';

			if(mail("$courriel", 'Achat', "Merci d'avoir acheté sur le site de TousquiShop!", $headers))
			{
			  echo 'Le message a bien été envoyé';
			}
			else
			{
			  echo 'Le message n\'a pu être envoyé';
			} 
		}
	}	
	else	
	{
		echo "Impossible de se connecter à la base de données";
	}
	mysql_close();		
?>
