<?php

require_once ('../../_assets/_inc/init.inc.php');

$tab = array();
$tab['liste'] = "";
$tab['fiche'] = "";
$tab['listemembre'] = "";
$tab['listesalle'] = "";

// echo($_POST['id']);
if ($_POST['id'] == -2) {

}
    $rqselect = $bdd -> prepare("SELECT * FROM avis");
    $rqselect -> execute();

    while($extract = $rqselect -> fetch(PDO::FETCH_ASSOC)){

        $tab['liste'] .= '<div class="divtable"><a class="" onclick="listeavis(' . $extract['id_avis'] . ', ' . '1' . ')"">';
        $tab['liste'] .= '<div class="divchamp" style="width:2%;"> ' . $extract['id_avis'] .'</div>';
        // $tab['liste'] .= '<div class="divchamp" style="width:10%;"> ' . $extract['id_membre'] .'</div>';
            $rqselect2 = $bdd -> query("SELECT * FROM membre WHERE id_membre = $extract[id_membre]");
            $membre = $rqselect2 -> fetch(PDO::FETCH_ASSOC);
            $lemembre = '<div class="divchamp" style="width:15%;"> ';
            $lemembre .= $membre['prenom'] . ' ' . $membre['nom'] . '</div>';
        $tab['liste'] .= $lemembre;
        // $tab['liste'] .= '<div class="divchamp" style="width:10%;"> ' . $extract['id_salle'] .'</div>';
            $rqselect3 = $bdd -> query("SELECT * FROM salle WHERE id_salle = $extract[id_salle]");
            $salle = $rqselect3 -> fetch(PDO::FETCH_ASSOC);
            $lasalle = '<div class="divchamp" style="width:15%;"> ';
            $lasalle .= $salle['titre'] . ' ' . $salle['ville'] . '</div>';
        $tab['liste'] .= $lasalle;
        $tab['liste'] .= '<div class="divchamp" style="width:40%;"> ' . $extract['commentaire'] .'</div>';
        $tab['liste'] .= '<div class="divchamp" style="width:5%;"> ' . $extract['note'] .'</div>';
        $tab['liste'] .= '<div class="divchamp" style="width:5%;"><i class="fa fa-pencil-square fa-1x"></i></div></a>';
        $tab['liste'] .= '<a class="" onclick="listeavis(' . $extract['id_avis'] . ', ' . '2' . ')""><div class="divchamp" style="width:10%;"><i class="fa fa-remove fa-1x"></i></div></a>';
        $tab['liste'] .= '</div>';
        $tab['liste'] .= '<div class="clear"></div>';

        }


if ($_POST['id'] != -1) {
    $rqselect3 = $bdd -> prepare("SELECT * FROM avis WHERE id_avis = :id");
        $rqselect3 -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $rqselect3 -> execute();
        $enrencours = $rqselect3 -> fetch(PDO::FETCH_ASSOC);
        extract($enrencours);
        // préparation de la zone de liste des membres        
        $rqselect = $bdd -> query("SELECT * FROM membre");
        $listemembre = '<select id="id_membre" name="id_membre" style="width:25%;">';
        $listemembre .= '<option value="" disabled selected>-----</option>';
            while($extract = $rqselect -> fetch(PDO::FETCH_ASSOC)){
            $listemembre .= "<option ";
                if ($enrencours['id_membre'] == $extract['id_membre']) {
                    $listemembre .= "selected";
                }
            $listemembre .= " value='" . $extract['id_membre'] . "'>" . $extract['prenom'] . ' ' . $extract['nom'] . "</option>";
            }
        $listemembre .= '</select>';
        $tab['listemembre'] = $listemembre;

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
        // préparation de la zone de liste des membres        
        $rqselect = $bdd -> query("SELECT * FROM membre");
        $listemembre = '<select id="id_membre" name="id_membre" style="width:25%;">';
        $listemembre .= '<option value="" disabled selected>-----</option>';
            while($extract = $rqselect -> fetch(PDO::FETCH_ASSOC)){
            $listemembre .= "<option ";
            $listemembre .= " value='" . $extract['id_membre'] . "'>" . $extract['prenom'] . ' ' . $extract['nom'] . "</option>";
            }
        $listemembre .= '</select>';
        $tab['listemembre'] = $listemembre;
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
    $rqselect = $bdd -> prepare("SELECT * FROM avis WHERE id_avis = :id");
    $rqselect -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    $rqselect -> execute();
    if($rqselect -> rowCount() > 0){
        $enr = $rqselect -> fetch(PDO::FETCH_ASSOC);
        extract($enr);
        $tab['fiche'] .= '<h2>fiche avis (n° ' . $enr['id_avis'] . ' )</h2>';
        $tab['fiche'] .= '<div id="message" class=""></div>';
        $tab['fiche'] .= '<form method="post" action="">';
        $tab['fiche'] .= '<label for="id_avis" style="width:25%;">id_avis</label>';
        $tab['fiche'] .= '<label for="id_membre" style="width:25%;">id_membre</label>';
        $tab['fiche'] .= '<label for="id_salle" style="width:25%;">id_salle</label>';
        $tab['fiche'] .= '<label for="note" style="width:25%;">note</label>';
        // $tab['fiche'] .= '<input type="hidden" id="id" name="id" value="' . $enr['id_avis'] .'" >';
        $tab['fiche'] .= '<input type="text" class="" style="width:25%;" id="id_avis" name="id_avis" value="' . $enr['id_avis'] .'" >';
        $tab['fiche'] .= $listemembre;
        // $tab['fiche'] .= '<input type="text" class="" style="width:25%;" id="id_membre" name="id_membre" value="' . $enr['id_membre'] .'" >';
        $tab['fiche'] .= $listesalle;
        // $tab['fiche'] .= '<input type="text" class="" style="width:25%;" id="id_salle" name="id_salle" value="' . $enr['id_salle'] .'" >';
        $tab['fiche'] .= '<input type="text" id="note" name="note" style="width:25%;" value="' . $enr['note'] .'" >';
        $tab['fiche'] .= '<div class="clear"></div>';
        $tab['fiche'] .= '<label for="commentaire" style="width:100%;">commentaire</label>';
        $tab['fiche'] .= '<textarea type="text" id="commentaire" name="commentaire" rows="5" style="width:100%;">' . $enr['commentaire'] .'"</textarea>';
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