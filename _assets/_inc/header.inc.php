	<!-- SECTION 0 : jumbotron et Navbar -->
<header>
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark mb-5">
	  <a class="navbar-brand" href="<?=RACINE_SITE?>index.php">SALLEA</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">

	    <ul class="navbar-nav mr-auto">
	      	<li class="nav-item" ><a class="nav-link" href="<?=RACINE_SITE?>_backoffice/index.php" >Accueil BackOffice</a></li>
			<li class="nav-item" ><a class="nav-link" href="<?=RACINE_SITE?>_backoffice/membre.php">Membres</a></li>
			<li class="nav-item" ><a class="nav-link" href="<?=RACINE_SITE?>_backoffice/salle.php">Salles</a></li>
			<li class="nav-item" ><a class="nav-link" href="<?=RACINE_SITE?>_backoffice/photos.php">Photos</a></li>
			<li class="nav-item" ><a class="nav-link" href="<?=RACINE_SITE?>_backoffice/produit.php">Produits</a></li>
			<li class="nav-item" ><a class="nav-link" href="<?=RACINE_SITE?>_backoffice/commande.php">Commandes</a></li>
			<li class="nav-item" ><a class="nav-link" href="<?=RACINE_SITE?>_backoffice/avis.php">Avis</a></li>
			<li class="nav-item" ><a class="nav-link" href="<?=RACINE_SITE?>_backoffice/statistiques.php">Statistiques</a></li></ul>
	      
	      <!-- Espace membre -->
	    <ul class="navbar-nav my-2 my-lg-0">
	      <li class="nav-item">
	        <a class="nav-link" href=""><i class="fa fa-user" aria-hidden="true"></i> Espace membre</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="<?= RACINE_SITE ?>_backoffice/index.php"><i class="fa fa-user" aria-hidden="true"></i> Espace backoffice</a>
	      </li>
		 </ul>

	  </div>
	</nav>
</header>
<div class="container-fluid">
