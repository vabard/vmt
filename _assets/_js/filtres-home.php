<?php
require_once ('../_inc/init.inc.php');

$tab = array();
$tab['resultat'] = "";
$bind = array();

if (!empty($_POST)) {
	$requete = "SELECT p.*, s.*
				FROM salle s
				LEFT JOIN produit p 
				ON p.id_salle = s.id_salle
				WHERE p.etat = 'libre' AND p.date_arrivee > CURDATE()";
	
	/* CATEGORIES */
	if (isset($_POST['categorie']) && !empty($_POST['categorie']) && is_string($_POST['categorie'])) {
		$mot = " AND s.categorie = '$_POST[categorie]'";
		$requete .= $mot;
		/*$bind .= "bindParam(':categorie', $_POST['categorie'], PDO::PARAM_STR)";*/
	}

	/* VILLE */
	if (isset($_POST['ville']) && !empty($_POST['ville']) && is_string($_POST['ville'])) {
		$requete .= " AND s.ville = '$_POST[ville]'";
		/*$bind .= "bindParam(':ville', $_POST['ville'], PDO::PARAM_STR)";*/
	}

	/* PRIX */
	if (isset($_POST['prix']) && !empty($_POST['prix']) && is_numeric($_POST['prix'])) {
		$requete .= " AND p.prix <= $_POST[prix]";
		/*$bind .= "bindParam(':ville', $_POST['ville'], PDO::PARAM_STR)";*/
	}

	/* CAPACITE */
	if (isset($_POST['capacite']) && !empty($_POST['capacite']) && is_numeric($_POST['capacite'])) {
		$requete .= " AND s.capacite = $_POST[capacite]";
		/*$bind .= "bindParam(':ville', $_POST['ville'], PDO::PARAM_STR)";*/
	}


	$req = $bdd -> query($requete);


/*	foreach ($bind as $value) {
		echo $value;$req -> $value;
		
	}*/
	/*$req -> execute();*/


	if ($req -> rowCount() > 0) {
        $produits = $req -> fetchAll(PDO::FETCH_ASSOC);
        foreach ($produits as $produit) { 
	        $tab['resultat'] .= '<div class="card col-md-4">';
	        $tab['resultat'] .= '<img class="card-img-top" src="_assets/_img/'.$produit['photo'] .'" alt="Photo de la salle" height="200px" >';
	        $tab['resultat'] .= '<div class="card-body">';
	        $tab['resultat'] .= '<h4 class="card-title">'. ucfirst($produit['categorie']). ' ' .ucfirst($produit['titre']).'</h4>';
	        $tab['resultat'] .= '<h3 class="card-title">' . $produit['prix'].' €</h3>';
	        $tab['resultat'] .= '<p class="card-text">'.substr($produit['description'],0,40). '...</p>';
	        $tab['resultat'] .= '<p class="card-text">';
	        $tab['resultat'] .= '<i class="fa fa-calendar" aria-hidden="true"></i> 
		   		  		'.date_format(date_create($produit['date_arrivee']), 'd/m/Y'). ' au ' .date_format(date_create($produit['date_depart']), 'd/m/Y').'</p>

		  		  	<a href="fiche_produit.php?id_produit='.$produit['id_produit'].'" class="btn btn-primary">Voir le produit</a>
	 			</div>

			</div>';
        }
    }
}

echo json_encode($tab);