<?php

require_once ('../../_assets/_inc/init.inc.php');

$tab = array();
$tab['liste'] = "";
$tab['fiche'] = "";

// echo($_POST['id']);
if ($_POST['id'] == -2) {

}
    $rqselect = $bdd -> prepare("SELECT * FROM membre");
    $rqselect -> execute();

    while($extract = $rqselect -> fetch(PDO::FETCH_ASSOC)){

        $tab['liste'] .= '<div class="divtable"><a class="" onclick="listeMembres(' . $extract['id_membre'] . ', ' . '1' . ')"">';
        $tab['liste'] .= '<div class="divchamp" style="width:20%;"> ' . $extract['nom'] .'</div>';
        $tab['liste'] .= '<div class="divchamp" style="width:20%;"> ' . $extract['prenom'] .'</div>';
        $tab['liste'] .= '<div class="divchamp" style="width:20%;"> ' . $extract['email'] .'</div>';
        $tab['liste'] .= '<div class="divchamp" style="width:10%;"><i class="fa fa-pencil-square fa-1x"></i></div></a>';
        $tab['liste'] .= '<a class="" onclick="listeMembres(' . $extract['id_membre'] . ', ' . '2' . ')""><div class="divchamp" style="width:10%;"><i class="fa fa-remove fa-1x"></i></div></a>';
        $tab['liste'] .= '</div>';
        $tab['liste'] .= '<div class="clear"></div>';




        // $tab['liste'] .= '<input type="text" name="prenom" style="width:20%; color:red;" value="' . $extract['prenom'] .'" disabled>';
        // $tab['liste'] .= '<input type="text" name="nom" style="width:30%;" value="' . $extract['nom'] .'" disabled>';
        // $tab['liste'] .= '<input type="text" name="nom" style="width:30%;" value="' . $extract['email'] .'" disabled>';
        // $tab['liste'] .= '</a>';
        // $tab['liste'] .= '<a class="app_btn" style="width:10%;" onclick="listeMembres(' . $extract['id_membre'] . ', ' . '1' . ')""><i class="fa fa-pencil-square fa-1x"></i></a>';
        // $tab['liste'] .= '<a class="app_btn" style="width:10%;" onclick="listeMembres(' . $extract['id_membre'] . ', ' . '2' . ')""><i class="fa fa-remove fa-1x"></i></a>';
        // $tab['liste'] .= '<div class="clear"></div>';
        }

if ($_POST['id'] != -1) {
    $rqselect = $bdd -> prepare("SELECT * FROM membre WHERE id_membre = :id");
    $rqselect -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    $rqselect -> execute();
    if($rqselect -> rowCount() > 0){
        $enr = $rqselect -> fetch(PDO::FETCH_ASSOC);
        extract($enr);
        $tab['fiche'] .= '<h2>fiche membre de : ' . $enr['pseudo'] . '</h2>';
        $tab['fiche'] .= '<div id="message" class=""></div>';
        $tab['fiche'] .= '<form method="post" action="">';
        $tab['fiche'] .= '<label for="pseudo" style="width:50%;">Pseudo</label>';
        $tab['fiche'] .= '<label for="mdp" style="width:50%;">Mot de Passe</label>';
        $tab['fiche'] .= '<input type="hidden" id="id" name="id" value="' . $enr['id_membre'] .'" >';
        $tab['fiche'] .= '<input type="text" class="" style="width:50%;" id="pseuso" name="pseudo" value="' . $enr['pseudo'] .'" >';
        $tab['fiche'] .= '<input type="text" class="" style="width:50%;" id="mdp" name="mdp" value="' . $enr['mdp'] .'" >';
        $tab['fiche'] .= '<div class="clear"></div>';
        $tab['fiche'] .= '<label for="nom" style="width:50%;">Nom</label>';
        $tab['fiche'] .= '<label for="prenom" style="width:50%;">Prénom</label>';
        $tab['fiche'] .= '<input type="text" id="nom" name="nom" placeholder="votre nom" style="width:50%;" value="' . $enr['nom'] .'" >';
        $tab['fiche'] .= '<input type="text" id="prenom" name="prenom" placeholder="votre prénom" style="width:50%;" value="' . $enr['prenom'] .'" >';
        $tab['fiche'] .= '<div class="clear"></div>';
        $tab['fiche'] .= '<label for="email" style="width:50%;">Email</label>';
        $tab['fiche'] .= '<label for="civilite" style="width:50%;">Sexe</label>';
        $tab['fiche'] .= '<input type="text" id="email" name="email" placeholder="votremail@mail.com" style="width:50%;" value="' . $enr['email'] .'" >';
        $tab['fiche'] .= '<select name="civilite" id="civilite" style="width:50%;">';
        if ($enr['civilite']  == 'm')
        {
        $tab['fiche'] .= '<option value="m">Homme</option>';
            }else{
        $tab['fiche'] .= '<option value="f">Femme</option>';
        }
        $tab['fiche'] .= '</select>';
        $tab['fiche'] .= '<div class="clear"></div>';
        $tab['fiche'] .= '<input class="app_btn" type="submit" style="width:50%;" name="modifier" value="modifier">';
        $tab['fiche'] .= '<input class="app_btn" type="submit" style="width:50%;" name="supprimer" value="supprimer">';
        $tab['fiche'] .= '<input class="app_btn" type="submit" style="width:50%;" name="dupliquer" value="dupliquer">';
        // $tab['fiche'] .= '<div class="app_btn" style="width:25%;"><a href="#.php">dupliquer</a></div>';
        // $tab['fiche'] .= '<div class="app_btn" style="width:25%;"><a href="#.php">supprimer</a></div>';
        $tab['fiche'] .= '<div class="app_btn" style="width:50%;" onclick="listeMembres(-1)"><a href="">raz du formulaire</a></div>';
        $tab['fiche'] .= '<div class="clear"></div>';
    }
}

echo json_encode($tab);