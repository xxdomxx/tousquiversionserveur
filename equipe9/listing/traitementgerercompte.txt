<?php
	session_start();
	if(@$_SESSION['utilisateur'])
	{
		$nomutil=@$_SESSION['utilisateur'];
	}
	else
	{
		header("Location:index.php");
	}
	$actionafaire=$_REQUEST['actionafaire'];
	//echo $actionafaire;
	$link = mysql_connect("localhost","equipe9h15","ebola-tousqui");
	mysql_set_charset('utf8',$link);
	
	if(@mysql_connect("localhost","equipe9h15","ebola-tousqui") && @mysql_select_db("equipe9h15"))
	{
		if($actionafaire=='modifmdp')
		{
			$mdpreq=$_REQUEST['mdp'];
			$newmdpreq=$_REQUEST['newmdp'];
			$newmdpverifreq=$_REQUEST['newmdpverif'];

			/***traitement***/

			$query = "SELECT mdputil FROM utilisateur where username='$nomutil'"; 
			$resultat = mysql_query($query); 
			if (!$resultat) {
				echo 'Requête invalide : '.mysql_error().'<br>';
			}
			else
			{	
				$val = mysql_fetch_row($resultat);					
				$mdp=$val[0];
				if($mdp==$mdpreq)
				{
					if($newmdpreq==$newmdpverifreq)
					{
						$querysetmdp="UPDATE utilisateur SET mdputil='$newmdpreq' where username='$nomutil'";
						$resultmdpmodif=mysql_query($querysetmdp);
						if(!$resultmdpmodif)
						{
							header("Location:gerercompte.php?msg=erreur");
						}
						else
						{
							header("Location:gerercompte.php?msg=reussi");	
						}
					}
				}
			}
		}
		elseif($actionafaire=='changerpref')
		{
			$formeaupdate=$_REQUEST['formedunom'];
			$querysetforme="UPDATE utilisateur SET forme='$formeaupdate' where username='$nomutil'";
			$resultprefmodif=mysql_query($querysetforme);
			if(!$resultprefmodif)
			{
				header("Location:gerercompte.php?msg=erreur");
			}
			else
			{
				header("Location:gerercompte.php?msg=reussi");	
			}
		}
	}
	mysql_close();
?>
