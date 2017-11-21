<?php

require_once ('../_assets/_inc/init.inc.php');


if (isset($_POST['nouveau']) || isset($_POST['dupliquer'])) {
    // debug($_POST);

    if(strlen($_POST['date_arrivee']) < 2){ 
        $msg.='<div class="erreur">Veuillez renseigner une date_arrivee valide (plus de 2 charactères).</div>';
        }
    if(empty($msg)){
        $rqinsert = $bdd -> prepare("INSERT INTO produit(id_salle, date_arrivee, date_depart, prix, etat) VALUES (:id_salle, :date_arrivee, :date_depart, :prix, :etat)") ;
        $rqinsert -> bindParam(':id_salle', $_POST['id_salle'], PDO::PARAM_INT);
        $rqinsert -> bindParam(':date_arrivee', $_POST['date_arrivee'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':date_depart', $_POST['date_depart'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':prix', $_POST['prix'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':etat', $_POST['etat'], PDO::PARAM_STR);
        if($rqinsert -> execute()){
            $msg.='<div class="validation">Ajout d\'un produit effectué avec succès.</div>';
            }
        }
    }

if (isset($_POST['modifier'])) {
    if(strlen($_POST['date_arrivee']) < 2){ 
        $msg.='<div class="erreur">Veuillez renseigner une date_arrivee valide (plus de 2 charactères).</div>';
        }
    if(empty($msg)){
        $rqinsert = $bdd -> prepare("REPLACE INTO produit(id_produit, id_salle, date_arrivee, date_depart, prix, etat) VALUES (:id, :id_salle, :date_arrivee, :date_depart, :prix, :etat)") ;
        $rqinsert -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $rqinsert -> bindParam(':id_salle', $_POST['id_salle'], PDO::PARAM_INT);
        $rqinsert -> bindParam(':date_arrivee', $_POST['date_arrivee'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':date_depart', $_POST['date_depart'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':prix', $_POST['prix'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':etat', $_POST['etat'], PDO::PARAM_STR);
        if($rqinsert -> execute()){
            $msg.='<div class="validation">Modification d\'un produit effectuée avec succès.</div>';
            }
        }
    }

if (isset($_POST['supprimer'])) {
    $rqsuppr = $bdd -> prepare("DELETE FROM produit WHERE id_produit = :id") ;
    $rqsuppr -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    if($rqsuppr -> execute()){
        $msg.='<div class="validation">Suppression d\'un produit effectuée avec succès.</div>';
        }
    }

if (isset($_GET['id'])) {
    $rqselect = $bdd -> prepare("SELECT * FROM produit WHERE id_produit = :id");
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
        $msg.='<div class="erreur">Veuillez confirmer la suppression d\'un produit !</div>';
            break;
    }
}


$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$etat = (isset($_POST['etat'])) ? $_POST['etat'] : '';
$id_salle = (isset($_POST['id_salle'])) ? $_POST['id_salle'] : '';
$date_arrivee = (isset($_POST['date_arrivee'])) ? $_POST['date_arrivee'] : '';
$prix = (isset($_POST['prix'])) ? $_POST['prix'] : '';
$action = (isset($_POST['action'])) ? $_POST['action'] : 'nouveau';

switch ($action) {
    case 'modifier':
        $action_comm = 'Modification d\'un produit / ';
        break;
    case 'supprimer':
        $action_comm = 'Suppression d\'un produit / ';
        break;
    default:
        $action_comm = 'Nouvel produit';
        break;
}

require_once ('../_assets/_inc/haut.inc.php');
require_once ('../_assets/_inc/header.inc.php');

?>

<section class="app_container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="app_blok">
          	<h3>liste des  produit :</h3>
        	<div id="listeproduit" class="app_blok_scroll"></div>
        </div>
    </div>
</section>
<section class="app_container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="app_blok">
            <?= $msg;?>
        	<div id="ficheproduit" class="app_blok">
			<h2><?= $action_comm;?><?=$date_arrivee?></h2>
            <form method="post" action="">
                <label for="id_produit" style="width:25%;">id_produit</label>
                <label for="id_salle" style="width:25%;">id_salle</label>
                <label for="etat" style="width:25%;">etat</label>
                <label for="prix" style="width:25%;">prix</label>
                <input type="text" class="" style="width:25%;" id="id_produit" name="id" placeholder="id_produit" >
                <input type="text" class="" style="width:25%;" id="id_salle" name="id_salle" placeholder="" >
                <input type="text" class="" style="width:25%;" id="etat" name="etat" placeholder="" >
                <input type="text" class="" style="width:25%;text-align:right;" id="prix" name="prix" placeholder="prix" >
                <div class="clear"></div>

                <label for="date_arrivee" style="width:50%;">date_arrivee</label>
                <label for="date_depart" style="width:50%;">date_depart</label>
                <input type="text" id="date_arrivee" name="date_arrivee" style="width:50%;" >
                <input type="text" id="date_depart" name="date_depart" style="width:50%;" >
                <div class="clear"></div>
                <!-- <div class="app_btn" style="width:25%;"><a href="#.php">modifier</a></div> -->
                <input class="app_btn" type="submit" style="width:50%;" name="<?= $action ?>" value="<?= $action ?>">
                <!-- <div class="app_btn" style="width:25%;"><a href="#.php">supprimer</a></div> -->
                <div class="app_btn" style="width:50%;"><a href="membre.php">raz du formulaire</a></div>
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
    window.addEventListener("load", listeproduit(-1,0));
    // document.querySelector("#btn_chargement01").addEventListener("click", ajax01);
    // document.querySelector("#btn_chargement02").addEventListener("click", ajax01);
</script>