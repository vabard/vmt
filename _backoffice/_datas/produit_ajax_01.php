<?php

require_once ('../../_assets/_inc/init.inc.php');

$tab = array();
$tab['liste'] = "";
$tab['fiche'] = "";

$tab['listesalle'] = "";
$tab['listeetat'] = "";

// echo($_POST['id']);
if ($_POST['id'] == -2) {

}
    $rqselect = $bdd -> prepare("SELECT * FROM produit");
    $rqselect -> execute();

    while($extract = $rqselect -> fetch(PDO::FETCH_ASSOC)){

        $tab['liste'] .= '<div class="divtable"><a class="" onclick="listeproduit(' . $extract['id_produit'] . ', ' . '1' . ')"">';
        $tab['liste'] .= '<div class="divchamp" style="width:2%;"> ' . $extract['id_produit'] .'</div>';
        // $tab['liste'] .= '<div class="divchamp" style="width:10%;"> ' . $extract['id_salle'] .'</div>';
            $rqselect3 = $bdd -> query("SELECT * FROM salle WHERE id_salle = $extract[id_salle]");
            $salle = $rqselect3 -> fetch(PDO::FETCH_ASSOC);
            $lasalle = '<div class="divchamp" style="width:15%;"> ';
            $lasalle .= $salle['titre'] . ' ' . $salle['ville'] . '</div>';
        $tab['liste'] .= $lasalle;
        $tab['liste'] .= '<div class="divchamp" style="width:20%;"> ' . $extract['date_arrivee'] .'</div>';
        $tab['liste'] .= '<div class="divchamp" style="width:20%;"> ' . $extract['date_depart'] .'</div>';
        $tab['liste'] .= '<div class="divchamp" style="width:10%;"> ' . $extract['prix'] .'</div>';
        $tab['liste'] .= '<div class="divchamp" style="width:10%;"> ' . $extract['etat'] .'</div>';
        $tab['liste'] .= '<div class="divchamp" style="width:5%;"><i class="fa fa-pencil-square fa-1x"></i></div></a>';
        $tab['liste'] .= '<a class="" onclick="listeproduit(' . $extract['id_produit'] . ', ' . '2' . ')""><div class="divchamp" style="width:10%;"><i class="fa fa-remove fa-1x"></i></div></a>';
        $tab['liste'] .= '</div>';
        $tab['liste'] .= '<div class="clear"></div>';

        }

if ($_POST['id'] != -1) {
    $rqselect3 = $bdd -> prepare("SELECT * FROM produit WHERE id_produit = :id");
        $rqselect3 -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $rqselect3 -> execute();
        $enrencours = $rqselect3 -> fetch(PDO::FETCH_ASSOC);
        extract($enrencours);
        // préparation de la zone de disponibilité
        $listeetat = '<select id="etat" name="etat" style="width:25%;">';
        $listeetat .= '<option value="" disabled selected>-----</option>';
        $listeetat .= "<option ";
            if ($enrencours['etat'] == 'reservation') {
                $listeetat .= "<option value='reservation' selected>reservation</option>";
                $listeetat .= "<option value='libre' >libre</option>";
            }else{
                $listeetat .= "<option value='reservation' >reservation</option>";
                $listeetat .= "<option value='libre' selected>libre</option>";
            }
        $listeetat .= '</select>';
        $tab['listeetat'] = $listeetat;
        // préparation de la zone de liste des salles
        $rqselect = $bdd -> query("SELECT * FROM salle");
        $listesalle = '<select id="id_salle" name="id_salle" style="width:25%;">';
        $listesalle .= '<option value="" disabled selected>-----</option>';
            while($extract = $rqselect -> fetch(PDO::FETCH_ASSOC)){
            $listesalle .= "<option ";
                if ($enrencours['id_salle'] == $extract['id_salle']) {
                    $listesalle .= "selected";
                }
            $listesalle .= " value='" . $extract['id_salle'] . "'>" . $extract['titre'] . ' ' . $extract['ville'] . "</option>";
            }
        $listesalle .= '</select>';
        $tab['listesalle'] = $listesalle;
}else{
        // préparation de la zone de disponibilité
        $listeetat = '<select id="etat" name="etat" style="width:25%;">';
        $listeetat .= '<option value="" disabled selected>-----</option>';
        $listeetat .= "<option value='reservation'>reservation</option>";
        $listeetat .= '</select>';
        $tab['listeetat'] = $listeetat;
        // préparation de la zone de liste des salles
        $rqselect = $bdd -> query("SELECT * FROM salle");
        $listesalle = '<select id="id_salle" name="id_salle" style="width:25%;">';
        $listesalle .= '<option value="" disabled selected>-----</option>';
            while($extract = $rqselect -> fetch(PDO::FETCH_ASSOC)){
            $listesalle .= "<option ";
            $listesalle .= " value='" . $extract['id_salle'] . "'>" . $extract['titre'] . ' ' . $extract['ville'] . "</option>";
            }
        $listesalle .= '</select>';
        $tab['listesalle'] = $listesalle;
}


if ($_POST['id'] != -1) {
    $rqselect = $bdd -> prepare("SELECT * FROM produit WHERE id_produit = :id");
    $rqselect -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    $rqselect -> execute();
    if($rqselect -> rowCount() > 0){
        $enr = $rqselect -> fetch(PDO::FETCH_ASSOC);
        extract($enr);
        $tab['fiche'] .= '<h2>fiche produit (n° ' . $enr['id_produit'] . ' )</h2>';
        $tab['fiche'] .= '<div id="message" class=""></div>';
        $tab['fiche'] .= '<form method="post" action="">';
        $tab['fiche'] .= '<label for="id_produit" style="width:25%;">id_produit</label>';
        $tab['fiche'] .= '<label for="id_salle" style="width:25%;">id_salle</label>';
        $tab['fiche'] .= '<label for="etat" style="width:25%;">etat</label>';
        $tab['fiche'] .= '<label for="prix" style="width:25%;">prix</label>';
        // $tab['fiche'] .= '<input type="hidden" id="id" name="id" value="' . $enr['id_produit'] .'" >';
        $tab['fiche'] .= '<input type="text" class="" style="width:25%;" id="id_produit" name="id" value="' . $enr['id_produit'] .'" >';
        $tab['fiche'] .= $listesalle;
        // $tab['fiche'] .= '<input type="text" id="etat" name="etat" style="width:25%;" value="' . $enr['etat'] .'" >';
        $tab['fiche'] .= $listeetat;
        // $tab['fiche'] .= '<input type="text" class="" style="width:25%;" id="id_salle" name="id_salle" value="' . $enr['id_salle'] .'" >';
        $tab['fiche'] .= '<input type="text" id="prix" name="prix" style="width:25%;text-align:right;" value="' . number_format($enr['prix'],2,'.',' ') .'" >';
        $tab['fiche'] .= '<div class="clear"></div>';
        $tab['fiche'] .= '<label for="date_arrivee" style="width:50%;">date_arrivee</label>';
        $tab['fiche'] .= '<label for="date_depart" style="width:50%;">date_depart</label>';
        $tab['fiche'] .= '<input type="text" id="date_arrivee" name="date_arrivee" style="width:50%;" value="' . $enr['date_arrivee'] .'" >';
        $tab['fiche'] .= '<input type="text" id="date_depart" name="date_depart" style="width:50%;" value="' . $enr['date_depart'] .'" >';
        $tab['fiche'] .= '<div class="clear"></div>';
        $tab['fiche'] .= '<input class="app_btn" type="submit" style="width:50%;" name="modifier" value="modifier">';
        $tab['fiche'] .= '<input class="app_btn" type="submit" style="width:50%;" name="supprimer" value="supprimer">';
        $tab['fiche'] .= '<input class="app_btn" type="submit" style="width:50%;" name="dupliquer" value="dupliquer">';
        // $tab['fiche'] .= '<div class="app_btn" style="width:25%;"><a href="#.php">dupliquer</a></div>';
        // $tab['fiche'] .= '<div class="app_btn" style="width:25%;"><a href="#.php">supprimer</a></div>';
        $tab['fiche'] .= '<div class="app_btn" style="width:50%;" onclick="listemembre(-1)"><a href="">raz du formulaire</a></div>';
        $tab['fiche'] .= '<div class="clear"></div>';
    }
}


echo json_encode($tab);