

// Top 5 des salles les mieux notées 
SELECT salle.titre, SUM(avis.note) FROM avis LEFT JOIN salle ON avis.id_salle = salle.id_salle GROUP BY salle.titre ORDER BY SUM(avis.note) DESC LIMIT 0,5;


// Top 5 des salles les plus commandées 

SELECT salle.titre, COUNT(commande.id_produit) FROM commande 
LEFT JOIN produit ON commande.id_produit = produit.id_produit
LEFT JOIN salle ON produit.id_salle = salle.id_salle GROUP BY salle.titre ORDER BY COUNT(commande.id_produit) DESC LIMIT 0,5;

// Top 5 des membres qui achètent le plus (en termes de quantité). 
SELECT membre.pseudo, COUNT(commande.id_produit) FROM membre
LEFT JOIN commande ON membre.id_membre = commande.id_membre
LEFT JOIN produit ON commande.id_produit = produit.id_produit
GROUP BY membre.pseudo
ORDER BY COUNT(commande.id_produit) DESC LIMIT 0,5; 

// Top 5 des membres qui achètent le plus cher (en termes de prix) 
SELECT membre.pseudo, produit.prix, produit.id_produit, SUM(produit.prix) FROM membre
LEFT JOIN commande ON membre.id_membre = commande.id_membre
LEFT JOIN produit ON commande.id_produit = produit.id_produit
GROUP BY membre.pseudo
ORDER BY SUM(produit.prix) DESC LIMIT 0,5; 

<?php

require_once ('../_assets/_inc/init.inc.php');

require_once ('../_assets/_inc/haut.inc.php');
require_once ('../_assets/_inc/header.inc.php');

?>

<section class="app_container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="app_blok">
          	<h3>Statistiques:</h3>
        	<div id="stats" class="app_blok_scroll"></div>
        </div>
    </div>
</section>

<?php
require_once ('../_assets/_inc/footer.inc.php');
?>
