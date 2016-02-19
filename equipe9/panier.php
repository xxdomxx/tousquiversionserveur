<html>
<head>
<?php
	session_start();
	if(@$_SESSION['utilisateur']==='administrateur')
	{
		header("Location:index.php");
	}
	else
	{
		if(@$_SESSION['utilisateur'])
		{
			include("headerconnecter.php");
			$nomutil=$_SESSION['utilisateur'];
		}
		else
		{
			header("Location:index.php");
		}
	}
?>
<script type="text/javascript" src="mailconfirmationcommande.js"></script>
<script type="text/javascript" src="scriptpanier.js"></script>
</head>
<body>
<div class="text-center">
<h3>Votre Panier</h3>
<?php
	$link = mysql_connect("localhost","equipe9h15","ebola-tousqui");
	mysql_set_charset('utf8',$link);
	if(@mysql_connect("localhost","equipe9h15","ebola-tousqui") && @mysql_select_db("equipe9h15"))
	{	
		$query = "SELECT idpanier, nomproduit, image, prixunitaire FROM panier pa join utilisateur u on u.idutil=pa.idutil join produit p on p.idproduit=pa.idproduit where u.username='{$nomutil}'";
		$compte = "SELECT count(*) FROM panier pa join utilisateur u on u.idutil=pa.idutil join produit p on p.idproduit=pa.idproduit where u.username='{$nomutil}'";
		$resultat = mysql_query($query);
		$resultcompte=mysql_query($compte);
		if (!$resultat or !$compte) 
		{
			echo 'Requête invalide : '.mysql_error().'<br>';
		}
		else
		{
			$val = mysql_fetch_row($resultcompte);					
			$nbElement=$val[0];
			if($nbElement > 0)
			{
				$prixtotal=0;
				echo "<center>";
				echo "<table border='2'><tr><th>Nom produit</th><th>Image</th><th>Quantité</th><th>Prix Unitaire</th><th></th></tr>";
				while($val = mysql_fetch_array($resultat))
				{
					$nomproduit=$val["nomproduit"];
					$prixunitaire=$val["prixunitaire"];
					$image=$val["image"];
					$idpanier=$val["idpanier"];

					echo "<tr>";
						echo "<td>".$nomproduit."</td>";
						echo "<td><img src='$image' alt='image' style='width:100px;height:75px'></td>";
						echo "<td class='inputquantiteproduitproduit'><input type='number' min='1' max='999999' value='1' name='quantite' size='6' class='form-control quantiteproduitproduit' maxlength='6' required/></td>";
						echo "<td align='right' class='prixunitaireproduit'>".number_format($prixunitaire,2)."$</td>";
						echo "<td><form action='traitementpanier.php'><button type='submit' class='btn btn-danger' name='btnSupprimerLigne' value='".$idpanier."'>Supprimer</button></form></td>";
					echo "</tr>";
					$prixtotal=$prixtotal+$prixunitaire;
				}
				
				echo "<tr><td align='right' colspan='3'><h3>Prix total:&nbsp</h3></td><td align='right' class='prixtotaltotal'>".number_format($prixtotal,2)."$</td></tr>";
				echo "</table>";
				echo "</center>";

				echo "<form id='form-payer-paypal' action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top'>";
				echo "<input type='hidden' name='cmd' value='_xclick'>";
				echo "<input type='hidden' name='business' value='nic_pandolfo@hotmail.com'>";
				echo "<input type='hidden' name='lc' value='CA'>";
				echo "<input type='hidden' name='item_name' value='Achats tousquishop'>";
				echo "<input type='hidden' name='item_number' value='".$idpanier."'>";
				echo "<input type='text' id='totalpaypal' name='amount' value='$prixtotal' hidden>";
				echo "<input type='hidden' name='currency_code' value='CAD'>";
				echo "<input type='hidden' name='button_subtype' value='services'>";
				echo "<input type='hidden' name='no_note' value='0'>";
				echo "<input type='hidden' name='bn' value='PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest'>";
				//echo "<button type='submit' class='btn btn-success' name='submit' alt='PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !'>Acheter avec Paypal</button>";
				echo "<img alt=' ' border='0' src='https://www.paypalobjects.com/fr_CA/i/scr/pixel.gif' width='1' height='1'>";
				echo "</form>";
				echo "<button  class='btn btn-success' id='btnpayeravecpaypal' alt='PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !'>Acheter avec Paypal</button>";
			}
			else
			{
				echo"<br><br><h4>Vous n'avez aucun produit dans votre panier. Visitez notre <a href='produit.php?categorie=all&page=1'>page des produits</a>";
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
</body>
</html>

