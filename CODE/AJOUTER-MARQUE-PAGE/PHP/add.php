<?php

session_start();

include_once "../../CONNEXION-BDD/connexion.php";
include_once "../../CLASSES/PHP/Marque_page.php";
include_once "../../CLASSES/PHP/Marque_Page_Manager.php";
include_once "../../CLASSES/PHP/Tag.php";
include_once "../../CLASSES/PHP/Tag_manager.php";
include_once "../../CLASSES/PHP/Ajoute_Modifie.php";
include_once "../../CLASSES/PHP/Ajoute_Modifie_Manager.php";
include_once "../../CLASSES/PHP/CommonMethods.php";



//A RAJOUTER : VERIFICATION DE LA CONNEXION AVANT l'AJOUT + REDIRECTION VERS LA PAGE DE CONNEXION LE CAS ECHANT

// OBTENIR L'ID DE L'UTILISATEUR CONNECTE ET LA RAJOUTER DANS LA REQUETE (SON ID EST CLE ETRANGERE)

$_SESSION["helper"]=0; //Pour m'indiquer si tout s'est bien passé


if (isset($_POST["titre"],$_POST["url"])) {  //Les autres variables ne sont pas obligatoires et ont des valeurs par défaut :



	$_POST["id_utilisateur"]=$_SESSION['id_connecte']; //Le $_POST est utilisé comme objet constructeur, d'où la double affection
	$id_usr = $_SESSION['id_connecte'];
	$mp = new Marque_Page($_POST);
	$mpm = new Marque_Page_manager($db);

	//S'il n'existait pas,  je le rajoute dans ma table marque_page : OK
	
	$indicateur = 0; //Me permet de savoir si c'est la première personne à ajouter ce marque page
	
	if(($mpm->existe($mp->getUrl())) == 0) {

	$mpm->ajoute($mp);
	$indicateur = 1; //Alors mettre l'attribut createur à 1 dans marque page

	}


	//Si il existe | si il n'existe pas : je remplie la table ajout_modifie ainsi que tag


	$_POST["description"]=$_POST["description_p"]; //Pour ajout_modifie_manager, ils ne portent pas le meme nom..


	//Et là on rajoute ses tags dans la table Tag : 


	$liste_tag=explode(",", $_POST["label"]);  //Les tags sont séparés par des "," donc pour tous les insérer je dois le faire dans une boucle l'un après l'autre
	$liste_tag = array_diff($liste_tag,array("null","")); //Je suprimme les valeurs null et vides du tableau

	foreach ($liste_tag as $key => $value) {


	$_POST["label"] = $value;	
	$tg = new Tag($_POST);  
	$tgm = new Tag_Manager($db);
	$tgm->ajoute($tg);
	
	}

	//Fin d'ajout des tags


	//Insertion dans la table ajout_modifie
	$am = new Ajoute_Modifie($_POST);
	$amm = new Ajoute_Modifie_Manager($db);
	$amm -> ajoute($am);

	if ($indicateur == 1) {


		echo "je dois mettre 1";
		echo $mpm->getLatest();
		echo $_SESSION['id_connecte'];
		$amm->UpdateCreateur($_SESSION['id_connecte'],$mpm->getLatest());
	}
	//Fin
	 //Juste pour tester, sera remplacer par l'id de celui qui ajoute le marque page
	// 15 correspond au points à rajouter à son score, reste constant
	IncreScore($id_usr,15);
	$_SESSION["helper"]=1;
	echo "Le marque page a bien été ajouté, redirection..";
	header('Location: ../HTML-CSS/add.php');      

	



}
?>