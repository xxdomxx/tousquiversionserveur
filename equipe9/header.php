<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" />
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


<title>
	Tousquishop
</title>
<nav class="navbar navbar-default">
      <!--<div class="container">-->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Tousquishop</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-left" method='post' action='produit.php?page=1' role="search">
             <div class="form-group">
                <input type="text" class="form-control" placeholder="Recherche" name="recherche" required>
		<input type="hidden" name="categorie" value="all">
             </div>
             <button type="submit" class="btn btn-default">Rechercher</button>
          </form>
	  <form class="navbar-form navbar-right" method='post' action='connexion.php'>
		<div class="form-group">
		<?php        
		if(@$_COOKIE['nomidentifiant'])
		{ 
			$_nomidentifiant=$_COOKIE['nomidentifiant'];
			//echo "Bonjour $_nomidentifiant!";
			echo "<input type='text' class='form-control' placeholder='Nom utilisateur'  size='25' name='nomutil' value='$_nomidentifiant' required/>";
			echo "</div>";
			echo "<div class='form-group'>";
			echo "<input type='password' class='form-control' placeholder='Mot de passe' size='25' name='mdp' required/>";
		}
		else
		{
			//include("presentationcompagnie.txt");
			echo "<input type='text' class='form-control' placeholder='Nom utilisateur' size='25' name='nomutil' required/>"; 
			echo "</div>";
			echo "<div class='form-group'>";
			echo "<input type='password' class='form-control' placeholder='Mot de passe' size='25' name='mdp' required/>";
		}
		?>
		</div>
		<button type="submit" class="btn btn-default">Connexion</button>
		<h5><a class="nav navbar-right" href="inscription.php">S'inscrire</a></h5>
           </form>
        </div><!--/.nav-collapse -->
      <!--</div>-->
    </nav>
