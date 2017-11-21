<?php

require_once ('../_assets/_inc/init.inc.php');


if (isset($_POST['nouveau']) || isset($_POST['dupliquer'])) {
    // debug($_POST);

    if(strlen($_POST['titre']) < 2){ 
        $msg.='<div class="erreur">Veuillez renseigner un titre valide (plus de 2 charactères).</div>';
        }
    if(strlen($_POST['description']) < 2){ 
        $msg.='<div class="erreur">Veuillez renseigner une description valide (plus de 2 charactères).</div>';
        }
    if(empty($msg)){
        $rqinsert = $bdd -> prepare("INSERT INTO salle(titre, description, pays, ville, adresse, cp, capacite, categorie) VALUES (:titre, :description, :pays, :ville, :adresse, :cp, :capacite, :categorie)") ;
        $rqinsert -> bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':description', $_POST['description'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':pays', $_POST['pays'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':ville', $_POST['ville'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':cp', $_POST['cp'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':capacite', $_POST['capacite'], PDO::PARAM_INT);
        $rqinsert -> bindParam(':categorie', $_POST['categorie'], PDO::PARAM_STR);
        if($rqinsert -> execute()){
            $msg.='<div class="validation">Ajout d\'une salle effectué avec succès.</div>';
            }
        }
    }

if (isset($_POST['modifier'])) {
    if(strlen($_POST['titre']) < 2){ 
        $msg.='<div class="erreur">Veuillez renseigner un titre valide (plus de 2 charactères).</div>';
        }
    if(strlen($_POST['description']) < 2){ 
        $msg.='<div class="erreur">Veuillez renseigner une description valide (plus de 2 charactères).</div>';
        }
    if(empty($msg)){
        $rqinsert = $bdd -> prepare("REPLACE INTO salle(id_salle, titre, description, pays, ville, adresse, cp, capacite, categorie) VALUES (:id, :titre, :description, :pays, :ville, :adresse, :cp, :capacite, :categorie)") ;
        $rqinsert -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $rqinsert -> bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':description', $_POST['description'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':pays', $_POST['pays'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':ville', $_POST['ville'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':cp', $_POST['cp'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':capacite', $_POST['capacite'], PDO::PARAM_INT);
        $rqinsert -> bindParam(':categorie', $_POST['categorie'], PDO::PARAM_STR);
        if($rqinsert -> execute()){
            $msg.='<div class="validation">Modification d\'un salle effectuée avec succès.</div>';
            }
        }
    }

if (isset($_POST['supprimer'])) {
    $rqsuppr = $bdd -> prepare("DELETE FROM salle WHERE id_salle = :id") ;
    $rqsuppr -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    if($rqsuppr -> execute()){
        $msg.='<div class="validation">Suppression d\'un salle effectuée avec succès.</div>';
        }
    }

if (isset($_GET['id'])) {
    $rqselect = $bdd -> prepare("SELECT * FROM salle WHERE id_salle = :id");
    $rqselect -> bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $rqselect -> execute();
    if($rqselect -> rowCount() > 0){
        $enr = $rqselect -> fetch(PDO::FETCH_ASSOC);
        extract($enr);
        $_POST['id'] = $enr['id_salle'];
        $_POST['titre'] = $enr['titre'];
        $_POST['description'] = $enr['description'];
    }

    switch ($_GET['action']) {
        case 'modifier':
        $_POST['action'] = 'modifier';
            break;     
        case 'supprimer':
        $_POST['action'] = 'supprimer';
        $msg.='<div class="erreur">Veuillez confirmer la suppression d\'un salle !</div>';
            break;
    }
}


$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$titre = (isset($_POST['titre'])) ? $_POST['titre'] : '';
$description = (isset($_POST['description'])) ? $_POST['description'] : '';
$action = (isset($_POST['action'])) ? $_POST['action'] : 'nouveau';

switch ($action) {
    case 'modifier':
        $action_comm = 'Modification d\'un salle / ';
        break;
    case 'supprimer':
        $action_comm = 'Suppression d\'un salle / ';
        break;
    default:
        $action_comm = 'Nouveau salle';
        break;
}

require_once ('../_assets/_inc/haut.inc.php');
require_once ('../_assets/_inc/header.inc.php');

?>

<section class="app_container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="app_blok">
          	<h3>liste des  salles :</h3>
        	<div id="listesalles" class="app_blok_scroll"></div>
        </div>
    </div>
</section>
<section class="app_container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="app_blok">
        	<div id="fichesalle" class="app_blok">
			<h2><?= $action_comm;?></h2>
            <?= $msg;?>
            <form method="post" action="">
                <label for="titre" style="width:50%;">titre</label>
                <label for="ville" style="width:25%;">ville</label>
                <label for="pays" style="width:25%;">pays</label>
                <input type="hidden" id="id" name="id" >
                <input type="text" class="" style="width:50%;" id="titre" name="titre" placeholder="titre de la salle" >
                <input type="text" class="" style="width:25%;" id="ville" name="ville" placeholder="ville" >
                <input type="text" id="pays" name="pays" placeholder="pays" style="width:25%;">
                <div class="clear"></div>
                <label for="description" style="width:100%;">description</label>
                <input type="text" id="description" name="description" placeholder="description" style="width:100%;">
                <div class="clear"></div>
                <label for="cp" style="width:20%;">cp</label>
                <label for="adresse" style="width:80%;">adresse</label>
                <input type="text" name="cp" id="cp" style="width:20%;">
                <input type="text" id="adresse" name="adresse" placeholder="adresse" style="width:80%;">
                <div class="clear"></div>
                <label for="capacite" style="width:20%;">capacite</label>
                <label for="categorie" style="width:80%;">categorie</label>
       			<input type="text" name="capacite" id="capacite" style="width:20%;">
                <input type="text" id="categorie" name="categorie" placeholder="categorie" style="width:80%;">
                <div class="clear"></div>
                <!-- <div class="app_btn" style="width:25%;"><a href="#.php">modifier</a></div> -->
                <input class="app_btn" type="submit" style="width:50%;" name="<?= $action ?>" value="<?= $action ?>">
                <!-- <div class="app_btn" style="width:25%;"><a href="#.php">supprimer</a></div> -->
                <div class="app_btn" style="width:50%;"><a href="salles.php">raz du formulaire</a></div>
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
    window.addEventListener("load", listesalles(-1,0));
    // document.querySelector("#btn_chargement01").addEventListener("click", ajax01);
    // document.querySelector("#btn_chargement02").addEventListener("click", ajax01);
</script>