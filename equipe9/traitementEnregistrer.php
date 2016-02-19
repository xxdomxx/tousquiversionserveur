<?php
	$nomfichier = "presentationcompagnie.txt";
	if(@$letout=stripslashes($_REQUEST['ckeditor']))
	{
		$fp = fopen($nomfichier,"w"); //ouverture du fichier
		fputs($fp, $letout); // on écrit dans le fichier
		fclose($fp);
		header("Location:editertxtcompagnie.php?msg=reussi");
	}
	else
	{
		header("Location:editertxtcompagnie.php?msg=erreur");
	}
?>
