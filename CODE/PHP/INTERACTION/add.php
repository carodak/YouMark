<?php

include_once "..\includes\login.php";
include_once "..\includes\marque_page.php";
include_once "..\includes\marque_page_manager.php";


//A RAJOUTER : VERIFICATION DE LA CONNEXION AVANT l'AJOUT + REDIRECTION VERS LA PAGE DE CONNEXION LE CAS ECHANT

// OBTENIR L'ID DE L'UTILISATEUR CONNECTE ET LA RAJOUTER DANS LA REQUETE (SON ID EST CLE ETRANGERE)




if (isset($_POST["titre"],$_POST["url"])) {  //Les autres variables ne sont pas obligatoires et ont des variables par défaut :


	$db = getDB(); //Connexion à la base de données


	$mp = new Marque_Page($_POST);
	$mpm = new Marque_Page_manager($db);
	$mpm->ajoute($mp);
	
	//Rajouter les tags - Donc insérer chaque tag dans la base de données !

}
?>