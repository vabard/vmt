<?php

require_once ('../../_assets/_inc/init.inc.php');

$tab = array();
$tab['liste'] = "";
$tab['fiche'] = "";
$tab['listemembre'] = "";
$tab['listeproduit'] = "";

// echo($_POST['id']);
if ($_POST['id'] == -2) {

}
    $rqselect = $bdd -> prepare("SELECT * FROM commande");
    $rqselect -> execute();

    while($extract = $rqselect -> fetch(PDO::FETCH_ASSOC)){

        $tab['liste'] .= '<div class="divtable"><a class="" onclick="listecommande(' . $extract['id_commande'] . ', ' . '1' . ')"">';
        $tab['liste'] .= '<div class="divchamp" style="width:2%;"> ' . $extract['id_commande'] .'</div>';
        // $tab['liste'] .= '<div class="divchamp" style="width:10%;"> ' . $extract['id_membre'] .'</div>';
            $rqselect2 = $bdd -> query("SELECT * FROM membre WHERE id_membre = $extract[id_membre]");
            $membre = $rqselect2 -> fetch(PDO::FETCH_ASSOC);
            $lemembre = '<div class="divchamp" style="width:15%;"> ';
            $lemembre .= $membre['prenom'] . ' ' . $membre['nom'] . '</div>';
        $tab['liste'] .= $lemembre;
        // $tab['liste'] .= '<div class="divchamp" style="width:10%;"> ' . $extract['id_produit'] .'</div>';
            $rqselect3 = $bdd -> query("SELECT * FROM produit WHERE id_produit = $extract[id_produit]");
            $produit = $rqselect3 -> fetch(PDO::FETCH_ASSOC);
            $leproduit = '<div class="divchamp" style="width:15%;"> ';
            $leproduit .= $produit['id_salle'] . ' ' . $produit['prix'] . '</div>';
        $tab['liste'] .= $leproduit;
        // $tab['liste'] .= '<div class="divchamp" style="width:40%;"> ' . $extract['id_membre'] .'</div>';
        $tab['liste'] .= '<div class="divchamp" style="width:20%;"> ' . $extract['date_enregistrement'] .'</div>';
        $tab['liste'] .= '<div class="divchamp" style="width:5%;"><i class="fa fa-pencil-square fa-1x"></i></div></a>';
        $tab['liste'] .= '<a class="" onclick="listecommande(' . $extract['id_commande'] . ', ' . '2' . ')""><div class="divchamp" style="width:10%;"><i class="fa fa-remove fa-1x"></i></div></a>';
        $tab['liste'] .= '</div>';
        $tab['liste'] .= '<div class="clear"></div>';

        }


if ($_POST['id'] != -1) {
    $rqselect3 = $bdd -> prepare("SELECT * FROM commande WHERE id_commande = :id");
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

        // préparation de la zone de liste des produits
        $rqselect = $bdd -> query("SELECT * FROM produit");
        $listeproduit = '<select id="id_produit" name="id_produit" style="width:25%;">';
        $listeproduit .= '<option value="" disabled selected>-----</option>';
            while($extract = $rqselect -> fetch(PDO::FETCH_ASSOC)){
            $listeproduit .= "<option ";
                if ($enrencours['id_produit'] == $extract['id_produit']) {
                    $listeproduit .= "selected";
                }
            $listeproduit .= " value='" . $extract['id_produit'] . "'>" . $extract['id_salle'] . ' ' . $extract['prix'] . "</option>";
            }
        $listeproduit .= '</select>';
        $tab['listeproduit'] = $listeproduit;
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
        // préparation de la zone de liste des produits
        $rqselect = $bdd -> query("SELECT * FROM produit");
        $listeproduit = '<select id="id_produit" name="id_produit" style="width:25%;">';
        $listeproduit .= '<option value="" disabled selected>-----</option>';
            while($extract = $rqselect -> fetch(PDO::FETCH_ASSOC)){
            $listeproduit .= "<option ";
            $listeproduit .= " value='" . $extract['id_produit'] . "'>" . $extract['id_salle'] . ' ' . $extract['prix'] . "</option>";
            }
        $listeproduit .= '</select>';
        $tab['listeproduit'] = $listeproduit;
}

if ($_POST['id'] != -1) {
    $rqselect = $bdd -> prepare("SELECT * FROM commande WHERE id_commande = :id");
    $rqselect -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    $rqselect -> execute();
    if($rqselect -> rowCount() > 0){
        $enr = $rqselect -> fetch(PDO::FETCH_ASSOC);
        extract($enr);
        $tab['fiche'] .= '<h2>fiche commande (n° ' . $enr['id_commande'] . ' )</h2>';
        $tab['fiche'] .= '<div id="message" class=""></div>';
        $tab['fiche'] .= '<form method="post" action="">';
        $tab['fiche'] .= '<label for="id_commande" style="width:25%;">id_commande</label>';
        $tab['fiche'] .= '<label for="id_membre" style="width:25%;">id_membre</label>';
        $tab['fiche'] .= '<label for="id_produit" style="width:25%;">id_produit</label>';
        $tab['fiche'] .= '<label for="date_enregistrement" style="width:25%;">date_enregistrement</label>';
        // $tab['fiche'] .= '<input type="hidden" id="id" name="id" value="' . $enr['id_commande'] .'" >';
        $tab['fiche'] .= '<input type="text" class="" style="width:25%;" id="id" name="id" value="' . $enr['id_commande'] .'" >';
        $tab['fiche'] .= $listemembre;
        // $tab['fiche'] .= '<input type="text" class="" style="width:25%;" id="id_membre" name="id_membre" value="' . $enr['id_membre'] .'" >';
        $tab['fiche'] .= $listeproduit;
        // $tab['fiche'] .= '<input type="text" class="" style="width:25%;" id="id_produit" name="id_produit" value="' . $enr['id_produit'] .'" >';
        $tab['fiche'] .= '<input type="text" id="date_enregistrement" name="date_enregistrement" style="width:25%;" value="' . $enr['date_enregistrement'] .'" >';
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