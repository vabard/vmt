
 
<?php 
 
require_once ('../_assets/_inc/init.inc.php'); 
require_once ('../_assets/_inc/haut.inc.php');
require_once ('../_assets/_inc/header.inc.php');
?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
        <div class="app_blok"> 
            <h3>Statistiques:</h3> 
  
          <div id="stats" class="app_blok_scroll"> 
            <?php 
            $resultat = $bdd -> query("SELECT salle.titre AS salle, SUM(avis.note) AS note FROM avis LEFT JOIN salle ON avis.id_salle = salle.id_salle GROUP BY salle.titre ORDER BY SUM(avis.note) DESC LIMIT 0,5;"); 
        echo 'Top 5 des salles les mieux notées : ' ; 
        echo '<table border="1">'; 
        echo '<tr>';  
        for($i = 0; $i < $resultat -> columnCount(); $i++){ 
          $champs = $resultat -> getColumnMeta($i); 
          echo '<th>' . $champs['name'] . '</th>';         
        } 
        echo '</tr>'; 
        while ($infos = $resultat -> fetch(PDO::FETCH_ASSOC)) { 
          echo '<tr>';   
          foreach ($infos as $key => $value) { 
          echo '<td>' . $value . '</td>'; 
          } 
        }   
        echo '</tr>'; 
        echo '</table><br/><br/>'; 
 
        $resultat = $bdd -> query("SELECT salle.titre AS salle, COUNT(commande.id_produit) AS commandes FROM commande  
        LEFT JOIN produit ON commande.id_produit = produit.id_produit 
        LEFT JOIN salle ON produit.id_salle = salle.id_salle GROUP BY salle.titre ORDER BY COUNT(commande.id_produit) DESC LIMIT 0,5"); 
        echo 'Top 5 des salles les plus commandées : ' ; 
        echo '<table border="1">'; 
        echo '<tr>';  
        for($i = 0; $i < $resultat -> columnCount(); $i++){ 
          $champs = $resultat -> getColumnMeta($i); 
          echo '<th>' . $champs['name'] . '</th>';         
        } 
        echo '</tr>'; 
        while ($infos = $resultat -> fetch(PDO::FETCH_ASSOC)) { 
          echo '<tr>';   
          foreach ($infos as $key => $value) { 
          echo '<td>' . $value . '</td>'; 
          } 
        }   
        echo '</tr>'; 
        echo '</table><br/><br/>'; 
 
        $resultat = $bdd -> query("SELECT membre.pseudo, COUNT(commande.id_produit) AS quantité FROM membre 
        LEFT JOIN commande ON membre.id_membre = commande.id_membre 
        LEFT JOIN produit ON commande.id_produit = produit.id_produit 
        GROUP BY membre.pseudo 
        ORDER BY COUNT(commande.id_produit) DESC LIMIT 0,5"); 
        echo 'Top 5 des membres qui achètent le plus (en termes de quantité) : ' ; 
        echo '<table border="1">'; 
        echo '<tr>';  
        for($i = 0; $i < $resultat -> columnCount(); $i++){ 
          $champs = $resultat -> getColumnMeta($i); 
          echo '<th>' . $champs['name'] . '</th>';         
        } 
        echo '</tr>'; 
        while ($infos = $resultat -> fetch(PDO::FETCH_ASSOC)) { 
          echo '<tr>';   
          foreach ($infos as $key => $value) { 
          echo '<td>' . $value . '</td>'; 
          } 
        }   
        echo '</tr>'; 
        echo '</table><br/><br/>'; 
 
        $resultat = $bdd -> query("SELECT membre.pseudo, SUM(produit.prix) AS prix FROM membre 
        LEFT JOIN commande ON membre.id_membre = commande.id_membre 
        LEFT JOIN produit ON commande.id_produit = produit.id_produit 
        GROUP BY membre.pseudo 
        ORDER BY SUM(produit.prix) DESC LIMIT 0,5"); 
        echo 'Top 5 des membres qui achètent le plus cher (en termes de prix) : ' ; 
        echo '<table border="1">'; 
        echo '<tr>';  
        for($i = 0; $i < $resultat -> columnCount(); $i++){ 
          $champs = $resultat -> getColumnMeta($i); 
          echo '<th>' . $champs['name'] . '</th>';         
        } 
        echo '</tr>'; 
        while ($infos = $resultat -> fetch(PDO::FETCH_ASSOC)) { 
          echo '<tr>';   
          foreach ($infos as $key => $value) { 
          echo '<td>' . $value . '</td>'; 
          } 
        }   
        echo '</tr>'; 
        echo '</table><br/><br/>'; 
 
        ?> 
          </div> 
        </div> 
    </div> 
</section> 

<?php
require_once ('../_assets/_inc/footer.inc.php');
?>
