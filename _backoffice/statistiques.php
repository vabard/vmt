<?php


//require_once ('../_assets/_inc/init.inc.php');

// connexion à la BDD en mode WARNING
$pdo = new PDO('mysql:host=localhost;dbname=vmt', 'root', '', array(
	PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
));

/******************** STATISTISQUES *******************************/

// Top 5 des salles les mieux notées 

$resultat = $pdo -> query("SELECT salle.titre, SUM(avis.note) FROM avis LEFT JOIN salle ON avis.id_salle = salle.id_salle GROUP BY salle.titre ORDER BY SUM(avis.note) DESC LIMIT 0,5;");
echo 'Top 5 des salles les mieux notées : ' ;
echo '<table border="1">';
echo '<tr>'; 
for($i = 0; $i < $resultat -> columnCount(); $i++){
	$champs = $resultat -> getColumnMeta($i);
	echo '<th>' . $champs['name'] . '</th>';				
}
echo '</tr>';
while ($infos = $resultat -> fetch(PDO::FETCH_ASSOC)) {
	echo '<tr>';  
	foreach ($infos as $key => $value) {
	echo '<td>' . $value . '</td>';
	}
}	
echo '</tr>';
echo '</table><br/><br/>';



// Top 5 des salles les plus commandées 

// Top 5 des membres qui achètent le plus (en termes de quantité). 

// Top 5 des membres qui achètent le plus cher (en termes de prix) 

