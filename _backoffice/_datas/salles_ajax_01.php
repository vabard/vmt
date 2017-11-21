<?php

require_once ('../../_assets/_inc/init.inc.php');

$tab = array();
$tab['liste'] = "";
$tab['fiche'] = "";

// echo($_POST['id']);
if ($_POST['id'] == -2) {

}
    $rqselect = $bdd -> prepare("SELECT * FROM salle");
    $rqselect -> execute();

    while($extract = $rqselect -> fetch(PDO::FETCH_ASSOC)){

        $tab['liste'] .= '<div class="divtable"><a class="" onclick="listesalles(' . $extract['id_salle'] . ', ' . '1' . ')"">';
        $tab['liste'] .= '<div class="divchamp" style="width:20%;"> ' . $extract['titre'] .'</div>';
        $tab['liste'] .= '<div class="divchamp" style="width:20%;"> ' . $extract['description'] .'</div>';
        $tab['liste'] .= '<div class="divchamp" style="width:20%;"> ' . $extract['pays'] .'</div>';
        $tab['liste'] .= '<div class="divchamp" style="width:20%;"> ' . $extract['ville'] .'</div>';
        $tab['liste'] .= '<div class="divchamp" style="width:10%;"><i class="fa fa-pencil-square fa-1x"></i></div></a>';
        $tab['liste'] .= '<a class="" onclick="listesalles(' . $extract['id_salle'] . ', ' . '2' . ')""><div class="divchamp" style="width:10%;"><i class="fa fa-remove fa-1x"></i></div></a>';
        $tab['liste'] .= '</div>';
        $tab['liste'] .= '<div class="clear"></div>';




        // $tab['liste'] .= '<input type="text" name="description" style="width:20%; color:red;" value="' . $extract['description'] .'" disabled>';
        // $tab['liste'] .= '<input type="text" name="titre" style="width:30%;" value="' . $extract['titre'] .'" disabled>';
        // $tab['liste'] .= '<input type="text" name="titre" style="width:30%;" value="' . $extract['adresse'] .'" disabled>';
        // $tab['liste'] .= '</a>';
        // $tab['liste'] .= '<a class="app_btn" style="width:10%;" onclick="listesalles(' . $extract['id_salle'] . ', ' . '1' . ')""><i class="fa fa-pencil-square fa-1x"></i></a>';
        // $tab['liste'] .= '<a class="app_btn" style="width:10%;" onclick="listesalles(' . $extract['id_salle'] . ', ' . '2' . ')""><i class="fa fa-remove fa-1x"></i></a>';
        // $tab['liste'] .= '<div class="clear"></div>';
        }

if ($_POST['id'] != -1) {
    $rqselect = $bdd -> prepare("SELECT * FROM salle WHERE id_salle = :id");
    $rqselect -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    $rqselect -> execute();
    if($rqselect -> rowCount() > 0){
        $enr = $rqselect -> fetch(PDO::FETCH_ASSOC);
        extract($enr);
        $tab['fiche'] .= '<h2>fiche salle de : ' . $enr['titre'] . '</h2>';
        $tab['fiche'] .= '<div id="message" class=""></div>';
        $tab['fiche'] .= '<form method="post" action="">';
        $tab['fiche'] .= '<label for="titre" style="width:50%;">titre</label>';
        $tab['fiche'] .= '<label for="ville" style="width:25%;">ville</label>';
        $tab['fiche'] .= '<label for="pays" style="width:25%;">pays</label>';
        $tab['fiche'] .= '<input type="hidden" id="id" name="id" value="' . $enr['id_salle'] .'" >';
        $tab['fiche'] .= '<input type="text" class="" style="width:50%;" id="titre" name="titre" value="' . $enr['titre'] .'" >';
        $tab['fiche'] .= '<input type="text" class="" style="width:25%;" id="ville" name="ville" value="' . $enr['ville'] .'" >';
        $tab['fiche'] .= '<input type="text" class="" style="width:25%;" id="pays" name="pays" value="' . $enr['pays'] .'" >';
        $tab['fiche'] .= '<div class="clear"></div>';
        $tab['fiche'] .= '<label for="description" style="width:100%;">description</label>';
        $tab['fiche'] .= '<input type="text" id="description" name="description" placeholder="description" style="width:100%;" value="' . $enr['description'] .'" >';
        $tab['fiche'] .= '<div class="clear"></div>';
        $tab['fiche'] .= '<label for="cp" style="width:20%;">cp</label>';
        $tab['fiche'] .= '<label for="adresse" style="width:80%;">adresse</label>';
        $tab['fiche'] .= '<input type="text" name="cp" id="cp" style="width:20%;" value="' . $enr['cp'] .'" >';
        $tab['fiche'] .= '<input type="text" id="adresse" name="adresse" placeholder="adresse" style="width:80%;" value="' . $enr['adresse'] .'" >';
        $tab['fiche'] .= '<div class="clear"></div>';
        $tab['fiche'] .= '<label for="capacite" style="width:20%;">capacite</label>';
        $tab['fiche'] .= '<label for="categorie" style="width:80%;">categorie</label>';
        $tab['fiche'] .= '<input type="text" name="capacite" id="capacite" style="width:20%;" value="' . $enr['capacite'] .'" >';
        $tab['fiche'] .= '<input type="text" id="categorie" name="categorie" placeholder="categorie" style="width:80%;" value="' . $enr['categorie'] .'" >';
        $tab['fiche'] .= '<div class="clear"></div>';
        $tab['fiche'] .= '</br>';
        $tab['fiche'] .= '<input class="app_btn" type="submit" style="width:50%;" name="modifier" value="modifier">';
        $tab['fiche'] .= '<input class="app_btn" type="submit" style="width:50%;" name="supprimer" value="supprimer">';
        $tab['fiche'] .= '<input class="app_btn" type="submit" style="width:50%;" name="dupliquer" value="dupliquer">';
        // $tab['fiche'] .= '<div class="app_btn" style="width:25%;"><a href="#.php">dupliquer</a></div>';
        // $tab['fiche'] .= '<div class="app_btn" style="width:25%;"><a href="#.php">supprimer</a></div>';
        $tab['fiche'] .= '<div class="app_btn" style="width:50%;" onclick="listesalles(-1)"><a href="">raz du formulaire</a></div>';
        $tab['fiche'] .= '<div class="clear"></div>';
    }
}

echo json_encode($tab);