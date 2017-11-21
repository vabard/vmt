<?php
require_once ('_assets/_inc/init.inc.php');

/*echo "<br><br><br>GET<pre>";
print_r($_GET);
echo "</pre>";

echo "<br><br>POST<br><pre>";
print_r($_POST);
echo "</pre>";
*/

/*Par défaut cette page affiche dynamiquement tous les produits signalés « libre » et dont la date d’arrivée est supérieure à la date du jour.*/
$req = $bdd -> query("	SELECT p.*, s.*
						FROM salle s
						LEFT JOIN produit p 
						ON p.id_salle = s.id_salle
						WHERE p.etat = 'libre' AND p.date_arrivee > CURDATE()");

$produits = $req -> fetchAll();

/*---------------------------------------------------------------*/

/*Recuperation des categories*/
$resultat = $bdd -> query("SELECT DISTINCT categorie FROM salle");
if ($resultat) {
	$categories = $resultat -> fetchAll();
}

/*---------------------------------------------------------------*/

/*Recuperation des Villes*/
$resultat = $bdd -> query("SELECT DISTINCT ville FROM salle");
if ($resultat) {
	$villes = $resultat -> fetchAll();
}



/*---------------------------------------------------------------*/

/*Recuperation des Capacité*/
$resultat = $bdd -> query("SELECT DISTINCT capacite FROM salle ORDER BY capacite");
if ($resultat) {
	$capacites = $resultat -> fetchAll();
}

// Filtre - Capacité 
if (isset($_GET['capacite']) && !empty($_GET['capacite']) && is_numeric($_GET['capacite'])) {
	$req = $bdd -> prepare("SELECT p.*, s.*
							FROM salle s
							LEFT JOIN produit p 
							ON p.id_salle = s.id_salle
							WHERE p.etat = 'libre' AND p.date_arrivee > CURDATE() AND s.capacite = :capacite");

	
	$req -> bindParam(':capacite', $_GET['capacite'], PDO::PARAM_STR);
	$req -> execute();
	if ($req -> rowCount() > 0) {
		$produits = $req -> fetchAll();
	} else {
		$req = $bdd -> query("	SELECT p.*, s.*
								FROM salle s
								LEFT JOIN produit p 
								ON p.id_salle = s.id_salle
								WHERE p.etat = 'libre' AND p.date_arrivee > CURDATE()");

		$produits = $req -> fetchAll();	
	}	
} 

/*---------------------------------------------------------------*/

/*Recuperation des Prix*/
$resultat = $bdd -> query("SELECT DISTINCT prix FROM produit ORDER BY prix");
if ($resultat) {
	$prixs = $resultat -> fetchAll();
}
/*$resultat = $bdd -> query("SELECT MAX(prix) FROM produit");
if ($resultat) {
	$prixs = $resultat -> fetchAll();
	
}*/

/*// Filtre - Prix 
if (isset($_GET['prix']) && !empty($_GET['prix']) && is_numeric($_GET['prix'])) {
	$req = $bdd -> prepare("SELECT p.*, s.*
							FROM salle s
							LEFT JOIN produit p 
							ON p.id_salle = s.id_salle
							WHERE p.etat = 'libre' AND p.date_arrivee > CURDATE() AND p.prix <= :prix");

	
	$req -> bindParam(':prix', $_GET['prix'], PDO::PARAM_STR);
	$req -> execute();
	if ($req -> rowCount() > 0) {
		$produits = $req -> fetchAll();
	} else {
		$req = $bdd -> query("	SELECT p.*, s.*
								FROM salle s
								LEFT JOIN produit p 
								ON p.id_salle = s.id_salle
								WHERE p.etat = 'libre' AND p.date_arrivee > CURDATE()");

		$produits = $req -> fetchAll();	
	}	
} 
*/



$page = 'Accueil';
require_once ('_assets/_inc/haut-front.inc.php');
require_once ('_assets/_inc/header-front.inc.php');
?>

<h1 class="pt-5">Location des salles</h1>

<div class="row">
	<!-- Sidebar -->
	<div class="col-md-3">
		<h2>Categories</h2>
		<ul class="list-group">
			<li class="list-group-item list-group-item-action"><a href="index.php">Toutes les salles</a></li>

			<?php foreach ($categories AS $categorie) : ?>
		  	<li class="list-group-item list-group-item-action categorie" value="<?= $categorie['categorie']; ?>">
		  		<?= ucfirst($categorie['categorie']); ?>
		  	</li>
		  	<?php endforeach; ?>
		</ul>

		<h2>Villes</h2>
		<ul class="list-group">
			
			<?php foreach ($villes AS $ville) : ?>
		  	<li class="list-group-item list-group-item-action ville" value="<?= $ville['ville']; ?>">
		  		<?= ucfirst($ville['ville']); ?>
		  	</li>
		  	<?php endforeach; ?>
		</ul>

		<h2>Capacité</h2>
		<form method="get" action="">
			<div class="form-group">
		    <select class="form-control" id="selectCapacite" name="selectCapacite">
				<?php foreach ($capacites AS $capacite) : ?>
		      	<option><?= $capacite['capacite']; ?></option>
				<?php endforeach; ?>
		    </select>
		  </div>
		</form>

		<h2>Prix max</h2>
		<form method="post" action="">
			<input id="par" name="par" type="hidden" value="">

			<div class="form-group">
		    <select class="form-control" id="selectPrix" name="selectPrix">
				<?php foreach ($prixs AS $prix) : ?>
		      	<option><?= $prix['prix']; ?></option>
				<?php endforeach; ?>
		    </select>
		  </div>
		</form>		

<!-- 		<h2>Période</h2>
		<form method="get" action="">
			<div class="form-group">
				<label for="selectDateArrive">Date d'arrivée</label>
				<input type="date" name="selectDateArrive" id="selectDateArrive">
		  </div>
			<div class="form-group">
				<label for="selectDateDepart">Date de départ</label>
				<input type="date" name="selectDateArrive" id="selectDateDepart">
		  </div>
		</form>	 -->	



	</div>

	<!-- Affichage des salles -->
	<div class="col-md-9">
		<h2>Nos salles</h2>
		<div class="row" id="salles">
			<?php foreach ($produits as $produit) : ?>
			<div class="card col-md-4">
				
				<img class="card-img-top" src="_assets/_img/<?= $produit['photo']; ?>" alt="Photo de la salle" height="200px" >

				<div class="card-body">
		  		  	<h4 class="card-title"><?= ucfirst($produit['categorie']).' '.ucfirst($produit['titre']); ?></h4>
		  		  	<h3 class="card-title"><?= $produit['prix']; ?> €</h3>
		   		  	<p class="card-text"><?= substr($produit['description'],0,40). '...'; ?></p>
		   		  	<p class="card-text">
		   		  		<i class="fa fa-calendar" aria-hidden="true"></i> 
		   		  		<?= date_format(date_create($produit['date_arrivee']), 'd/m/Y').' au '.date_format(date_create($produit['date_depart']), 'd/m/Y'); ?>
		   		  	</p>

		  		  	<a href="fiche_produit.php?id_produit=<?= $produit['id_produit']; ?>" class="btn btn-primary">Voir le produit</a>
	 			</div>

			</div>
			<?php endforeach; ?>
		</div> <!-- end row -->
	</div>
</div>



<?php
require_once ('_assets/_inc/footer-front.inc.php');
?>