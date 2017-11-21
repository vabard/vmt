<?php

require_once ('../_assets/_inc/init.inc.php');


if (isset($_POST['nouveau']) || isset($_POST['dupliquer'])) {
    // debug($_POST);

    if(strlen($_POST['commentaire']) < 2){ 
        $msg.='<div class="erreur">Veuillez renseigner un commentaire valide (plus de 2 charactères).</div>';
        }
        if(strlen($_POST['note']) > 5){ 
        $msg.='<div class="erreur">Veuillez renseigner une note valide .</div>';
        }
    if(empty($msg)){
        $rqinsert = $bdd -> prepare("INSERT INTO avis(id_salle, id_membre, commentaire, note, date_enregistrement) VALUES (:id_salle, :id_membre, :commentaire, :note, :date_enregistrement)") ;
        $rqinsert -> bindParam(':id_salle', $_POST['id_salle'], PDO::PARAM_INT);
        $rqinsert -> bindParam(':id_membre', $_POST['id_membre'], PDO::PARAM_INT);
        $rqinsert -> bindParam(':commentaire', $_POST['commentaire'], PDO::PARAM_STR);
        $rqinsert -> bindValue(':note', PDO::PARAM_INT);
        $rqinsert -> bindValue(':date_enregistrement', date("Y-m-d\H:i:s"), PDO::PARAM_STR);
        if($rqinsert -> execute()){
            $msg.='<div class="validation">Ajout d\'un commentaire effectué avec succès.</div>';
            }
        }
    }

if (isset($_POST['modifier'])) {
    if(strlen($_POST['commentaire']) < 2){ 
        $msg.='<div class="erreur">Veuillez renseigner un commentaire valide (plus de 2 charactères).</div>';
        }
    if(strlen($_POST['note']) > 5){ 
        $msg.='<div class="erreur">Veuillez renseigner une note valide .</div>';
        }
    if(empty($msg)){
        $rqinsert = $bdd -> prepare("REPLACE INTO avis(id_avis, id_salle, id_membre, commentaire, note, date_enregistrement) VALUES (:id, :id_salle, :id_membre :commentaire, :note, :date_enregistrement)") ;
        $rqinsert -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $rqinsert -> bindParam(':id_salle', $_POST['id_salle'], PDO::PARAM_INT);
        $rqinsert -> bindParam(':id_membre', $_POST['id_membre'], PDO::PARAM_INT);
        $rqinsert -> bindParam(':commentaire', $_POST['commentaire'], PDO::PARAM_STR);
        $rqinsert -> bindValue(':note', $_POST['note'], PDO::PARAM_INT);
        if($rqinsert -> execute()){
            $msg.='<div class="validation">Modification d\'un avis effectuée avec succès.</div>';
            }
        }
    }

if (isset($_POST['supprimer'])) {
    $rqsuppr = $bdd -> prepare("DELETE FROM avis WHERE id_avis = :id") ;
    $rqsuppr -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    if($rqsuppr -> execute()){
        $msg.='<div class="validation">Suppression d\'un avis effectuée avec succès.</div>';
        }
    }

if (isset($_GET['id'])) {
    $rqselect = $bdd -> prepare("SELECT * FROM avis WHERE id_avis = :id");
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
        $msg.='<div class="erreur">Veuillez confirmer la suppression d\'un avis !</div>';
            break;
    }
}


$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$id_membre = (isset($_POST['id_membre'])) ? $_POST['id_membre'] : '';
$id_salle = (isset($_POST['id_salle'])) ? $_POST['id_salle'] : '';
$commentaire = (isset($_POST['commentaire'])) ? $_POST['commentaire'] : '';
$note = (isset($_POST['note'])) ? $_POST['note'] : '';

$action = (isset($_POST['action'])) ? $_POST['action'] : 'nouveau';

switch ($action) {
    case 'modifier':
        $action_comm = 'Modification d\'un avis / ';
        break;
    case 'supprimer':
        $action_comm = 'Suppression d\'un avis / ';
        break;
    default:
        $action_comm = 'Nouvel avis';
        break;
}

require_once ('../_assets/_inc/haut.inc.php');
require_once ('../_assets/_inc/header.inc.php');

?>

<section class="app_container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="app_blok">
          	<h3>liste des  avis :</h3>
        	<div id="listeavis" class="app_blok_scroll"></div>
        </div>
    </div>
</section>
<section class="app_container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="app_blok">
            <?= $msg;?>
        	<div id="ficheavis" class="app_blok">
			<h2><?= $action_comm;?><?=$commentaire?></h2>
            <form method="post" action="">
                <label for="id_avis" style="width:25%;">id_avis</label>
                <label for="id_membre" style="width:25%;">id_membre</label>
                <label for="id_salle" style="width:25%;">id_salle</label>
                <label for="civilite" style="width:25%;">note</label>
                <input type="text" class="" style="width:25%;" id="id_avis" name="id_avis" placeholder="id_avis" >
                <input type="text" class="" style="width:25%;" id="id_membre" name="id_membre" placeholder="" >
                <input type="text" class="" style="width:25%;" id="id_salle" name="id_salle" placeholder="" >
                <input type="text" class="" style="width:25%;" id="note" name="note" placeholder="note" >
                <div class="clear"></div>

                <label for="commentaire" style="width:100%;">commentaire</label>
                <textarea id="commentaire" name="commentaire" rows="5"></textarea>
               
                <div class="clear"></div>
                <!-- <div class="app_btn" style="width:25%;"><a href="#.php">modifier</a></div> -->
                <input class="app_btn" type="submit" style="width:50%;" name="<?= $action ?>" value="<?= $action ?>">
                <!-- <div class="app_btn" style="width:25%;"><a href="#.php">supprimer</a></div> -->
                <div class="app_btn" style="width:50%;"><a href="avis.php">raz du formulaire</a></div>
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
    window.addEventListener("load", listeavis(-1,0));
    // document.querySelector("#btn_chargement01").addEventListener("click", ajax01);
    // document.querySelector("#btn_chargement02").addEventListener("click", ajax01);
</script>