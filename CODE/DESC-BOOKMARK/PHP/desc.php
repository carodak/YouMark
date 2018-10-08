<?php 


ob_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

function chargerClasse($classname)
{
  require '../../CLASSES/PHP/'.$classname.'.php';
}



spl_autoload_register('chargerClasse');

session_start();




//Ce script PHP doit recevoir l'ID du marque page à afficher via $_POST ou $_GET...

//Passage par des constantes juste pour tester, en attendant de lié nos travaux 



$mpg = new Marque_Page_Manager($db);
$tgm = new Tag_Manager($db);
$cmm = new Commente_Manager($db);
$AjouteManager = New Ajoute_Modifie_Manager($db);
$usm = new Utilisateur_Manager($db);

//Obtenir les infos de ce marque page +  (commentaires+ tag correspodnant à ce dernier) 


// DEBUT DE LA PARTIE OBTENTION DES INFOS


$mp = $mpg->get_Par_Id(142); //Renvoi le marque page d'id 159
$tags = $tgm->get_Par_Id(142);  //Tous les tags correspondant
$comments = $cmm->getListeCommentaireParMarque(5); //Tous les commentaires correspondant au marque page
$Ajout = $AjouteManager->get_by_Key(142); //J'obtiens tous les ajouts/modifications concérnant ce marque page




//Informations du marque page ;

//Celles stoqués dans la table marque_page


$url=$mp->getUrl();
$titre=$mp->getTitre();
$note=$mp->getNote();

//Fin d'obtention de la table marque_page


//Obtention des descriptions, logo, date_ajout, date_modification, pseudo createur



$createur= $usm->getPseudo_par_Id(5); //Rajouter une redirection vers le profil de l'utilisateur une fois les travaux liés .
$type_droit = $Ajout->getType_Droit();
$date_a = $Ajout->getDate_a(); //Date d'ajout ( de création )
$date_m =  $Ajout->getDate_m(); // Dernière date de modification
$desc =  $Ajout->getDescription();
$logo_choisi = $Ajout->getLogo_Choisi();



// FIN DE LA PARTIE OBTENTION DES INFOS





// DEBUT PARTIE AFFICHAGE :


echo "CREATEUR : ".$createur . "<br />";
echo "TYPE DROIT : ".$type_droit . "<br />";
echo "DATE AJOUT ".$date_a  . "<br />";
echo "DATE MODIF ".$date_m . "<br />";
echo "DESCRIPTION : ".$desc . "<br />";

  

/*
if( $type_droit == 0 ) {


	echo "Le marque page demandé est privé ! <br />";
	exit();

}*/


echo "<img src=../icons/$logo_choisi.png> <br />";
echo "Titre $titre <br />";
echo "Url : $url <br />";
echo "logo choisi : $logo_choisi <br />";
echo "Note obtenue : $note /5 <br />";


echo "Tags correspondants : ";
foreach ($tags as $key => $tg) {
	echo $tg['label'].",";
}


echo "<h3> Affichage des 5 derniers commentaires : </h3>";

print_r($comments);

/*foreach ($comments as $key => $com) {


	echo "Le : " . $com->getDate_c() .  "<br />";
	echo "Contenu : . ". $com->getLibelle_c(). "  <br />";
	echo "A mis la note : ". $com->getNote() . " /5 <br />";;

	echo "ID UTILSIATEUR : ". $com->getID_Utilisateur(). "  <br />";
	echo "ID MARQUE PAGE : ". $com->getID_MarquePage(). "  <br />";
}*/

$_SESSION["comments"]=serialize($comments);

foreach ($comments as $key => $com) {


	echo "Le : " . $com->getDate_c() .  "<br />";
	echo "Contenu : . ". $com->getLibelle_c(). "  <br />";
	echo "A mis la note : ". $com->getNote() . " /5 <br />";;

	echo "ID UTILSIATEUR : ". $com->getId_utilisateur(). "  <br />";
	echo "ID MARQUE PAGE : ". $com->getId_marque_page(). "  <br />";
}



// FIN PARTIE AFFICHAGE .






//Permet de poster un commentaire et mettre un note
include("desc.html");
//FIN




//Insertion du commentaire et de la note dans la base de données . 

	$_POST["id_marque_page"]=5;
	$_POST["id_utilisateur"]=645;


if (isset($_POST["libelle_c"],$_POST["note"])) { //Pour le moment il faut commenter et mettre une note! 

//"Ajout du commentaire <br />";




//$cm=new Commente($_POST);
//echo "ID du marque page : " . $cm->getID_MarquePage(); //n'affiche rien !
//$cmm->ajoute($cm);

}


//Fin 

?>


