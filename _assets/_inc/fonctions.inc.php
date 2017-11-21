<?php

function debug($tab){
  echo '<div class="containerblok">';
  echo '<div style="color:white; font-weight:bold;padding:20px;background:#' . rand(111111, 999999). '">';
  $trace = debug_backtrace();
  echo 'fichier source :' . $trace[0]['file'] . ' à la ligne ' . $trace[0]['line'] . '<br/>';
  echo "<pre>";
  print_r($tab);
  echo "</pre>";
  echo '</div>';
  echo '</div>';
}

function userConnected(){
  if(isset($_SESSION['membre'])){
  	return true;
  }else{
  	return false;
  }
}

function userAdmin(){
  if(userConnected() && $_SESSION['membre']['statut']==1){
  	return true;
  }else{
  	return false;
  }
}



// fonction pour créer un panier
// cette fonction nous permet simplement de créer la structure d'un panier vide
function creationPanier(){
  if(!isset($_SESSION['panier'])){
    $_SESSION['panier'] = array();
    $_SESSION['panier'] ['id_produit'] = array();
    $_SESSION['panier'] ['quantite'] = array();
    $_SESSION['panier'] ['prix'] = array();
    $_SESSION['panier'] ['photo'] = array();
    $_SESSION['panier'] ['titre'] = array();
  }
}

// fonction pour ajouter un produit au panier
function ajouterProduit($id_produit, $quantite, $prix, $photo, $titre){
  creationPanier(); // on éxécute d'abord notre fonction creationPanier pour créer un panier

  // nous vérifions d'abord que le produit à ajouter n'existe pas dans le panier :
  $positionPdt = array_search($id_produit, $_SESSION['panier'] ['id_produit']);
  // array_search permet de chercher un élément dans un array et nous retourne soit FALSE (si l'élément n'est pas trouvé) soit sa position (si l'élément est trouvé)

  if($positionPdt !== FALSE){ // cela signifie que le produit existe déjà dans le panier car positionPdt n'est pas false

    $_SESSION['panier'] ['quantite'][$positionPdt] += $quantite; // j'ajoute la nouvelle quantité à la ligne de l'array quantité (créé dans la fonction creationPanier, voir ligne 46) qui correspond à ce produit

  }
  else{
    $_SESSION['panier'] ['id_produit'] [] = $id_produit;
    $_SESSION['panier'] ['quantite'] [] = $quantite;
    $_SESSION['panier'] ['prix'] [] = $prix;
    $_SESSION['panier'] ['photo'] [] = $photo;
    $_SESSION['panier'] ['titre'] [] = $titre;
  }
}

// fonction pour compter le nombre d'articles dans le panier
function quantitePanier(){
  if(!empty($_SESSION['panier']['quantite'])){
    return array_sum($_SESSION['panier']['quantite']);
  }else{
    return false;
  }
}

// fonction pour calculer le montant total d'un panier
// elle parcourt tous les produits dans le panier ($i est le curseur qui parcourt les produits) et ajoute à $total à chaque tour le prix * la quantité
function montantTotal(){
  $total = 0;
  if(!empty($_SESSION['panier'] ['id_produit'])){
    for($i = 0; $i < sizeof($_SESSION['panier'] ['id_produit']); $i++){
      $total += $_SESSION['panier'] ['quantite'][$i] * $_SESSION['panier'] ['prix'][$i];
    }
  }
  if($total != 0){
    return $total;
  }
}

// fonction pour retirer un produit du panier
function retirerProduit($id_produit){
    $position_pdt = array_search($id_produit, $_SESSION['panier']['id_produit']);
    if ($position_pdt !== false){
        array_splice($_SESSION['panier']['id_produit'], $position_pdt, 1);
        array_splice($_SESSION['panier']['quantite'], $position_pdt, 1);
        array_splice($_SESSION['panier']['prix'], $position_pdt, 1);
        array_splice($_SESSION['panier']['photo'], $position_pdt, 1);
        array_splice($_SESSION['panier']['titre'], $position_pdt, 1);
    }
}

?>

