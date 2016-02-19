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
	<ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
	    <?php
	      @session_start();
	      $nomutil=$_SESSION['utilisateur'];
	      echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Connecté en tant que <b>$nomutil</b><span class='caret'></span></a>";
		
	    ?>
              <ul class="dropdown-menu" role="menu">
		<li class="dropdown-header">Commande</li>
                <!--<li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>-->
                <li><a href="panier.php">Panier<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Compte</li>
                <li><a href="gerercompte.php">Gérer le compte<span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></li>
                <li><a href="deconnexion.php">Déconnexion<span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
              </ul>
            </li>
          </ul>



        </div><!--/.nav-collapse -->
      <!--</div>-->
    </nav>

