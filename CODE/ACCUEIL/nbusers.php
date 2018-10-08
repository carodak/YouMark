<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');


include "../CONNEXION-BDD/connexion.php";


$usm = New Utilisateur_Manager($db);


$_SESSION["nbusers"]=(int)$usm->count();



?>