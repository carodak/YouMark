<?php
session_start();

include_once "../../CONNEXION-BDD/connexion.php";
include_once "../../CLASSES/PHP/Commente.php";
include_once "../../CLASSES/PHP/Commente_Manager.php";
include_once "../../CLASSES/PHP/marque_page_manager.php";
include_once "../../CLASSES/PHP/CommonMethods.php";




if (!isset($_SESSION['id_connecte']) || $_SESSION['id_connecte'] < 0 ) {

	  header('Location: ../../PAGE-REDIRECTION/');
      exit();      


}



/* Valeurs constantes pour test, à remplacer par les session après */
$_POST["id_utilisateur"]=$_SESSION['id_connecte'];
$id_usr=$_SESSION['id_connecte'];
$_POST["id_marque_page"]=$_SESSION["consulted_mp"];

function alertSucces() { //Fonction qui affiche un message de succès et qui ferme le popup après 5.5 s


	echo " <p><center>Merci, Votre évaluation a été prise en compte !</center></p>
	<script type=\"text/javascript\"> setTimeout(function(){
	window.close();
	}, 5500); </script>";
}


if (isset($_POST["note"],$_POST["libelle_c"])) { //Si l'utilisateur note + commente : CAS 1
		
		if($_POST["note"] > 0 && strlen($_POST["libelle_c"]) > 5 ) { 
		//Insertion dans la table commente 
		$cmm = new Commente_Manager($db);
		$cm = New Commente($_POST);
		$cmm->Ajoute($cm);
		// FIN

		//Mise à jour de la note du marque page : 

		$mmp = new marque_page_manager($db);
		$mmp->updateSomme(1,$_POST["note"]);  //1 JUSTE POUR TESTER, A compléter avec l'id du marque page passé par SESSION une fois les fichiers liés 
		IncreScore($id_usr,15); //Mise à jour du score de l'utilisateur.
		alertSucces();
		exit();
		}
}




if (isset($_POST["note"])) { //L'utilisateur ne fait que noter  : CAS 2
	if($_POST["note"] > 0 && strlen($_POST["libelle_c"]) == 0 ) {
	$mmp = new marque_page_manager($db);
	$mmp->updateSomme(1,$_POST["note"]);
	IncreScore($id_usr,5); //Le niveau d'une note est de 5
	alertSucces();
	exit();
	}
}



if (isset($_POST["libelle_c"])) { //L'utilisateur ne fait que commenter  : CAS 3
	//Insertion dans la table commente 
	$cmm = new Commente_Manager($db);
	$cm = New Commente($_POST);
	$cmm->Ajoute($cm);
	IncreScore($id_usr,10); //Le niveau d'un commentaire est de 10
	alertSucces();
	exit();
	// FIN
}
?>







