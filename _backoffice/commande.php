<?php

require_once ('../_assets/_inc/init.inc.php');


if (isset($_POST['nouveau']) || isset($_POST['dupliquer'])) {
    // debug($_POST);

    if(strlen($_POST['date_enregistrement']) <= 0){ 
        $msg.='<div class="erreur">Veuillez renseigner une date valide.</div>';
        }
    if(empty($msg)){
        $rqinsert = $bdd -> prepare("INSERT INTO commande(id_produit, id_membre, date_enregistrement) VALUES (:id_produit, :id_membre, :date_enregistrement)") ;
        $rqinsert -> bindParam(':id_produit', $_POST['id_produit'], PDO::PARAM_INT);
        $rqinsert -> bindParam(':id_membre', $_POST['id_membre'], PDO::PARAM_INT);
        $rqinsert -> bindValue(':date_enregistrement', date("Y-m-d\H:i:s"), PDO::PARAM_STR);
        if($rqinsert -> execute()){
            $msg.='<div class="validation">Ajout d\'une commande effectué avec succès.</div>';
            }
        }
    }

if (isset($_POST['modifier'])) {
    if(strlen($_POST['date_enregistrement']) <= 0){ 
        $msg.='<div class="erreur">Veuillez renseigner une date valide.</div>';
        }
    if(empty($msg)){
        $rqinsert = $bdd -> prepare("REPLACE INTO commande(id_commande, id_produit, id_membre, date_enregistrement) VALUES (:id, :id_produit, :id_membre, :date_enregistrement)") ;
        $rqinsert -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $rqinsert -> bindParam(':id_produit', $_POST['id_produit'], PDO::PARAM_INT);
        $rqinsert -> bindParam(':id_membre', $_POST['id_membre'], PDO::PARAM_INT);
        $rqinsert -> bindValue(':date_enregistrement', date("Y-m-d\H:i:s"), PDO::PARAM_STR);
        if($rqinsert -> execute()){
            $msg.='<div class="validation">Modification d\'une commande effectuée avec succès.</div>';
            }
        }
    }

if (isset($_POST['supprimer'])) {
    $rqsuppr = $bdd -> prepare("DELETE FROM commande WHERE id_commande = :id") ;
    $rqsuppr -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    if($rqsuppr -> execute()){
        $msg.='<div class="validation">Suppression d\'une commande effectuée avec succès.</div>';
        }
    }

if (isset($_GET['id'])) {
    $rqselect = $bdd -> prepare("SELECT * FROM commande WHERE id_commande = :id");
    $rqselect -> bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $rqselect -> execute();
    if($rqselect -> rowCount() > 0){
        $enr = $rqselect -> fetch(PDO::FETCH_ASSOC);
        extract($enr);
    }

    switch ($_GET['action']) {
        case 'modifier':
        $_POST['action'] = 'modifier';
            break;     
        case 'supprimer':
        $_POST['action'] = 'supprimer';
        $msg.='<div class="erreur">Veuillez confirmer la suppression d\'une commande !</div>';
            break;
    }
}


$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$id_membre = (isset($_POST['id_membre'])) ? $_POST['id_membre'] : '';
$id_produit = (isset($_POST['id_produit'])) ? $_POST['id_produit'] : '';
$date_enregistrement = (isset($_POST['date_enregistrement'])) ? $_POST['date_enregistrement'] : '';
$note = (isset($_POST['note'])) ? $_POST['note'] : '';

$action = (isset($_POST['action'])) ? $_POST['action'] : 'nouveau';

switch ($action) {
    case 'modifier':
        $action_comm = 'Modification d\'une commande / ';
        break;
    case 'supprimer':
        $action_comm = 'Suppression d\'une commande / ';
        break;
    default:
        $action_comm = 'Nouvelle commande';
        break;
}

require_once ('../_assets/_inc/haut.inc.php');
require_once ('../_assets/_inc/header.inc.php');

?>

<section class="app_container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="app_blok">
          	<h3>liste des commandes :</h3>
        	<div id="listecommande" class="app_blok_scroll"></div>
        </div>
    </div>
</section>
<section class="app_container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="app_blok">
        	<div id="fichecommande" class="app_blok">
			<h2><?= $action_comm;?></h2>
            <?= $msg;?>
            <form method="post" action="">
                <label for="id_commande" style="width:25%;">id_commande</label>
                <label for="id_membre" style="width:25%;">id_membre</label>
                <label for="id_produit" style="width:25%;">id_produit</label>
                <label for="date_enregistrement" style="width:25%;">date_enregistrement</label>
                <div class="clear"></div>
                <input type="text" class="" style="width:25%;" id="id" name="id" placeholder="id_commande" >
                <input type="text" class="" style="width:25%;" id="id_membre" name="id_membre" placeholder="" >
                <input type="text" class="" style="width:25%;" id="id_produit" name="id_produit" placeholder="" >
                <input type="text" class="" style="width:25%;" id="date_enregistrement" name="date_enregistrement" placeholder="date_enregistrement" >
                <div class="clear"></div>
               
                <div class="clear"></div>
                <!-- <div class="app_btn" style="width:25%;"><a href="#.php">modifier</a></div> -->
                <input class="app_btn" type="submit" style="width:50%;" name="<?= $action ?>" value="<?= $action ?>">
                <!-- <div class="app_btn" style="width:25%;"><a href="#.php">supprimer</a></div> -->
                <div class="app_btn" style="width:50%;"><a href="commande.php">raz du formulaire</a></div>
                <div class="clear"></div>
            </form>
            </div>
        </div>
    </div>
</section>
<?php
require_once ('../_assets/_inc/footer.inc.php');
?>
<script>
    // window.onload = randomUser();
    window.addEventListener("load", listecommande(-1,0));
    // document.querySelector("#btn_chargement01").addEventListener("click", ajax01);
    // document.querySelector("#btn_chargement02").addEventListener("click", ajax01);
</script>