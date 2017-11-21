<header>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	  <a class="navbar-brand" href="#">SALLEA</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">

	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item <?= ($page == 'Accueil') ? 'active' : ''?>">
	        <a class="nav-link" href="<?= RACINE_SITE ?>index.php" >Accueil</a>
	      </li>    
		</ul>
	      
	      <!-- Espace membre -->
	    <ul class="navbar-nav my-2 my-lg-0">
	      <li class="nav-item">
	        <a class="nav-link" href=""><i class="fa fa-user" aria-hidden="true"></i> Espace membre</a>
	      </li>
		 </ul>

	  </div>
	</nav>
</header>

<main>
	<div class="container">
