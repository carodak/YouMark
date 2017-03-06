<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

function chargerClasse($classname)
{
  require $classname.'.php';
}

spl_autoload_register('chargerClasse');

session_start();


$db = new PDO('mysql:host=localhost;dbname=SocialBookmarking', 'root', 'root');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); 

$_POST["titre"]="youtube/rirejaune";
$_POST["url"]="www.youtube/rirejaune.com";

if (isset($_POST["titre"],$_POST["url"])) {  //Les autres variables ne sont pas obligatoires et ont des variables par défaut :
	echo "je suis là\n";

	$msqdate = (new \DateTime())->format('Y-m-d H:i:s');

	$mpm = new Marque_Page_manager($db);
	$mp = new Marque_Page(['url' => $_POST["url"], 'titre' => $_POST["titre"], 'date_p' => $msqdate, 'type_droit' => 1, 'description_p' => "desc", 'logo_choisi' => 2]);

	echo $mp->getUrl();

	echo $mp->getTitre();

	echo $mp->getDate_p();
	echo $mp->getDescription_p();

	echo "\najoute";
	$mpm->ajoute($mp);
	
	echo $mp->getUrl();

	echo $mp->getTitre();

	echo $mp->getDate_p();
	echo $mp->getDescription_p();
	//echo $mp->getLogo();

	//$mpm ->ajoute($mp);




}

?>