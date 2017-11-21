<?php

require_once ('../_assets/_inc/init.inc.php');


if (isset($_POST['nouveau']) || isset($_POST['dupliquer'])) {
    // debug($_POST);

    if(strlen($_POST['nom']) < 2){ 
        $msg.='<div class="erreur">Veuillez renseigner un nom valide (plus de 2 charactères).</div>';
        }
    if(strlen($_POST['prenom']) < 2){ 
        $msg.='<div class="erreur">Veuillez renseigner un prénom valide (plus de 2 charactères).</div>';
        }
    if(empty($msg)){
        $rqinsert = $bdd -> prepare("INSERT INTO membre(nom, prenom, pseudo, mdp, email, civilite, statut, date_enregistrement) VALUES (:nom, :prenom, :pseudo, :mdp, :email, :civilite, :statut, :date_enregistrement)") ;
        $rqinsert -> bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':mdp', $_POST['mdp'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':email', $_POST['email'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':civilite', $_POST['civilite'], PDO::PARAM_STR);
        $rqinsert -> bindValue(':statut', 1, PDO::PARAM_INT);
        $rqinsert -> bindValue(':date_enregistrement', date("Y-m-d\H:i:s"), PDO::PARAM_STR);
        if($rqinsert -> execute()){
            $msg.='<div class="validation">Ajout d\'un membre effectué avec succès.</div>';
            }
        }
    }

if (isset($_POST['modifier'])) {
    if(strlen($_POST['nom']) < 2){ 
        $msg.='<div class="erreur">Veuillez renseigner un nom valide (plus de 2 charactères).</div>';
        }
    if(strlen($_POST['prenom']) < 2){ 
        $msg.='<div class="erreur">Veuillez renseigner un prénom valide (plus de 2 charactères).</div>';
        }
    if(empty($msg)){
        $rqinsert = $bdd -> prepare("REPLACE INTO membre(id_membre, nom, prenom, pseudo, mdp, email, civilite) VALUES (:id, :nom, :prenom, :pseudo, :mdp, :email, :civilite)") ;
        $rqinsert -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $rqinsert -> bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':mdp', $_POST['mdp'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':email', $_POST['email'], PDO::PARAM_STR);
        $rqinsert -> bindParam(':civilite', $_POST['civilite'], PDO::PARAM_STR);
        if($rqinsert -> execute()){
            $msg.='<div class="validation">Modification d\'un membre effectuée avec succès.</div>';
            }
        }
    }

if (isset($_POST['supprimer'])) {
    $rqsuppr = $bdd -> prepare("DELETE FROM membre WHERE id_membre = :id") ;
    $rqsuppr -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    if($rqsuppr -> execute()){
        $msg.='<div class="validation">Suppression d\'un membre effectuée avec succès.</div>';
        }
    }

if (isset($_GET['id'])) {
    $rqselect = $bdd -> prepare("SELECT * FROM membre WHERE id_membre = :id");
    $rqselect -> bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $rqselect -> execute();
    if($rqselect -> rowCount() > 0){
        $enr = $rqselect -> fetch(PDO::FETCH_ASSOC);
        extract($enr);
        $_POST['id'] = $enr['id_membre'];
        $_POST['nom'] = $enr['nom'];
        $_POST['prenom'] = $enr['prenom'];
    }

    switch ($_GET['action']) {
        case 'modifier':
        $_POST['action'] = 'modifier';
            break;     
        case 'supprimer':
        $_POST['action'] = 'supprimer';
        $msg.='<div class="erreur">Veuillez confirmer la suppression d\'un membre !</div>';
            break;
    }
}


$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$nom = (isset($_POST['nom'])) ? $_POST['nom'] : '';
$prenom = (isset($_POST['prenom'])) ? $_POST['prenom'] : '';
$action = (isset($_POST['action'])) ? $_POST['action'] : 'nouveau';

switch ($action) {
    case 'modifier':
        $action_comm = 'Modification d\'un membre / ';
        break;
    case 'supprimer':
        $action_comm = 'Suppression d\'un membre / ';
        break;
    default:
        $action_comm = 'Nouveau membre';
        break;
}

require_once ('../_assets/_inc/haut.inc.php');
require_once ('../_assets/_inc/header.inc.php');

?>
<section class="app_container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="app_asside_blok">
            <h3>liste des  membre :</h3>
            <div id="listemembre" class="app_asside_blok_scroll"></div>
        </div>
    </div>
</section>
<section class="app_container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="app_asside_blok">
        	<div id="fichemembre" class="app_asside_blok">
            <h2><?= $action_comm;?></h2>
            <?= $msg;?>
            <form method="post" action="">
                <label for="pseudo" style="width:50%;">Pseudo</label>
                <label for="mdp" style="width:50%;">Mot de Passe</label>
                <input type="hidden" id="id" name="id" >
                <input type="text" class="" style="width:50%;" id="pseuso" name="pseudo" placeholder="votre pseudo" >
                <input type="text" class="" style="width:50%;" id="mdp" name="mdp" placeholder="password" >
                <div class="clear"></div>

                <label for="nom" style="width:50%;">Nom</label>
                <label for="prenom" style="width:50%;">Prénom</label>
                <input type="text" id="nom" name="nom" placeholder="votre nom" style="width:50%;">
                <input type="text" id="prenom" name="prenom" placeholder="votre prénom" style="width:50%;">
                <div class="clear"></div>
                <label for="email" style="width:50%;">Email</label>
        		<label for="civilite" style="width:50%;">Sexe</label>
                <input type="text" id="email" name="email" placeholder="votremail@mail.com" style="width:50%;">
       			<select name="civilite" id="civilite" style="width:50%;">
              		<option value="m">Homme</option>
              		<option value="f">Femme</option>
		        </select>
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
    window.addEventListener("load", listemembre(-1,0));
    // document.querySelector("#btn_chargement01").addEventListener("click", ajax01);
    // document.querySelector("#btn_chargement02").addEventListener("click", ajax01);
</script>