
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


include "../../CONNEXION-BDD/connexion.php";

include "includes/en_tete.php";
include "fil_dariane.php";
echo fildariane("../../ACCUEIL/index.php");


//Pas d'id marque page, ou id négatif..

if (!isset($_GET["id_marque_page"]) ||  $_GET["id_marque_page"] < 0  )  {



      header('Location: ../../PAGE-REDIRECTION/');
      exit();


}



//Pas obligé d'etre connecté pour consulter un mp
if (isset($_SESSION['id_connecte'])) { $id_user_encours=$_SESSION['id_connecte'];  } // l'id de l'utilisateur qui consulte la page






$id_selected_mrkpage=$_GET["id_marque_page"];
$_SESSION["consulted_mp"] = $_GET["id_marque_page"];


$mpg = new Marque_Page_Manager($db);
$tgm = new Tag_Manager($db);
$cmm = new Commente_Manager($db);
$AjouteManager = New Ajoute_Modifie_Manager($db);
$usm = new Utilisateur_Manager($db);

//Obtenir les infos de ce marque page +  (commentaires+ tag correspodnant à ce dernier)


// DEBUT DE LA PARTIE OBTENTION DES INFOS


$mp = $mpg->get_Par_Id($id_selected_mrkpage); //Renvoi le marque page d'id 159
$tags = $tgm->get_Par_Id($id_selected_mrkpage);  //Tous les tags correspondant
$comments = $cmm->getListeCommentaireParMarque($id_selected_mrkpage); //Tous les commentaires correspondant au marque page
$Ajout = $AjouteManager->get_by_Key($id_selected_mrkpage); //J'obtiens tous les ajouts/modifications concérnant ce marque page

$_SESSION["comments"]=serialize($comments);
//Informations du marque page ;

//Celles stoqués dans la table marque_page


$url=$mp->getUrl();
$titre=$mp->getTitre();
$note=$mp->getNote();

//Fin d'obtention de la table marque_page


//Obtention des descriptions, logo, date_ajout, date_modification, pseudo createur


$id_createur= $usm->getCreator($id_selected_mrkpage); //Renvoi l'id du createur d'un marque page
$createur= $usm->getPseudo_par_Id($id_createur); //Renvoi le pseudo à partir de l'id
$type_droit = $Ajout->getType_Droit();
$date_a = $Ajout->getDate_a(); //Date d'ajout ( de création )
$date_m =  $Ajout->getDate_m(); // Dernière date de modification
$desc =  $Ajout->getDescription();
$logo_choisi = $Ajout->getLogo_Choisi();
$main_desc = $AjouteManager->getMainDescription($id_selected_mrkpage);

if (isset($_SESSION['id_connecte'])) { //Si l'utilisateur est connecté j'affiche les 2 descriptions, sinon uniquement celle du createur
$user_desc = $AjouteManager->getUserDescription($id_selected_mrkpage,$id_user_encours);
}
// FIN DE LA PARTIE OBTENTION DES INFOS




/*
if( $type_droit == 0 ) {


  echo "Le marque page demandé est privé ! <br />";
  exit();

}*/


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <link href="rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="rating/js/star-rating.js" type="text/javascript"></script>
    <link href="rating/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
    <script src="rating/themes/krajee-svg/theme.js"></script>

    <title><?php echo $titre;?></title>




    <link href="assets/css/bootstrap.css" rel="stylesheet">


    <link href="assets/css/main.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="assets/js/hover.zoom.js"></script>
    <script src="assets/js/hover.zoom.conf.js"></script>

  </head>

  <body>

    <!-- Static navbar -->
    <div class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href=<?php basename($_SERVER['REQUEST_URI']); ?>> <?php echo $titre;?></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="commentaires.php">Commentaires</a></li>
            <li><a href="contact.php">Signaler</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<!-- +++++ Welcome Section +++++ -->
	<div id="ww">
	    <div class="container">



			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 centered">
					<img src=<?php echo "icons/".$logo_choisi.".png"; ?> alt="Stanley">
					<a href=<?php echo $url ?>><h1>Titre : <?php echo $titre;?></h1></a>
          <h2>URL :  <a href=<?php echo $url ?>> <img src="url"> </h2></a>
          <h3>Ajouté le : <?php echo $date_a;?>  Par : <a href=<?php echo "http://localhost/TER-L3/CODE/ACCUEIL/auteur_list.php?auteur=" .$createur;?>> <?php echo $createur; ?>  </a></h3>
          <?php if($date_m) { ?><h3>Dernière modification le : <?php echo $date_m;?></h3> <?php } ?>  <!--Si le marque page n'a jamais été modifié, inutile d'afficher une date vide -->
          <h3>Description Auteur : <?php echo $main_desc; ?></h3>
          <?php if ( isset($_SESSION['id_connecte']) )  { ?><h3>Ma description : <?php echo $user_desc;  ?></h3><?php } ?>

            <?php  //Affichage de la note
            for($i=1;$i<=5;$i++) {

              if ($i <= $note) { echo "          <i class=\"glyphicon glyphicon-star\"></i>";}
              else { echo "          <i class=\"glyphicon glyphicon-star-empty\"></i>";}
            }?>

					<h4>Tags correspondants : </h4>
          <?php foreach ($tags as $key => $tg) {echo "<i><a href=\" http://localhost/TER-L3/CODE/ACCUEIL/clic_tag.php?label_tag=" . $tg['label'] . "\" style=\"color:blue;\" " . ">" . $tg['label'] ."</i><br /> ";} ?>

				</div><!-- /col-lg-8 -->

			</div><!-- /row -->

	    </div> <!-- /container -->

	</div><!-- /ww -->

    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>

<script>


setTimeout(function(){

document.querySelector("#ww > div > div > div > div > div.clear-rating.clear-rating-active > i").remove();
document.querySelector("#ww > div > div > div > div > div.caption > span").remove();
document.querySelector("#ww > div > div > div > div > div.rating-stars > span.filled-stars").style.width="40%";
}, 200);




</script>
