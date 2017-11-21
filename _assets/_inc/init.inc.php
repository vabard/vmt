<?php
//  session
session_start();
//  connection bdd local
$bdd = new PDO('mysql:host=localhost;dbname=vmt', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
// serveur
// $bdd = new PDO('mysql:host=iasctmod1.mysql.db;dbname=iasctmod1', 'iasctmod1', 'Tb021405', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));

//  variables
$msg = '';
$page = ''; // pour affichage dans les balises titles de la page et de menu 'active'

//  chemins
// define('RACINE_SITE', 'http://www.iasct.com/');
define('RACINE_SITE', '/vmt/');
// autres inclusions
// require_once ('fonctions.inc.php');