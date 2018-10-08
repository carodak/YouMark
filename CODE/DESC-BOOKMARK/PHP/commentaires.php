<?php
session_start();
include_once "../../CONNEXION-BDD/connexion.php";
include_once "../../CLASSES/PHP/Commente.php";
include_once "../../CLASSES/PHP/Commente_Manager.php";
include_once "../../CLASSES/PHP/Utilisateur_Manager.php";


$cmmanager=New Commente_Manager($db);
$usrmanager = New Utilisateur_Manager($db);

function chargerClasse($classname)
{
  require '../../CLASSES/PHP/'.$classname.'.php';
}
include "includes/en_tete.php";

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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <link href="rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="rating/js/star-rating.js" type="text/javascript"></script>
    <link href="rating/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
    <script src="rating/themes/krajee-svg/theme.js"></script>

    <title>Espace Commentaires</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="assets/css/main.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="indx.php?id_marque_page=<?php echo $_SESSION["consulted_mp"]; ?>" > Retour au marque page</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="commentaires.php">Commentaires</a></li>
            <li><a href="contact.php">Signaler</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>


<?php
include "fil_dariane.php";
echo fildariane("../../ACCUEIL/index.php");
if (isset($_SESSION['id_connecte']) ) {
?>
    <center><h1><a href="" target="popup" onclick="window.open('addcomment.html','jbnWindow','width=600,height=300')">Ajouter un commentaire </a></h1></center>
<?php
}
?>


<?php
if (!isset($_SESSION['id_connecte']) || $_SESSION['id_connecte'] < 0 ) {
?>
    <center><h1><a href="../../PAGE-REDIRECTION/"  onclick=",'width=600,height=300')">Ajouter un commentaire </a></h1></center>
<?php
}
?>






	<?php $comments=unserialize($_SESSION["comments"]);
				 $ind=0; //Pour alterner entre l'affichage blanc et gris .

				foreach ($comments as $key => $com) {

          $avatar = $usrmanager->getAvatarById($com->getId_utilisateur())["avatar"]; 






if ($ind % 2) {


?>

		<div id="grey">
	    <div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<p><img src=<?php echo $avatar; ?> width="50px" height="50px"> <ba><a href=<?php echo "http://localhost/TER-L3/CODE/ACCUEIL/auteur_list.php?auteur=" .$cmmanager->getPseudo_par_Id($com->getId_utilisateur());?> style="color:black;"> <?php echo $cmmanager->getPseudo_par_Id($com->getId_utilisateur()); ?></ba></p>
					<p><bd><?php echo " " . $com->getDate_c(); ?></bd></p>

          <?php  //Affichage de la note
            for($i=1;$i<=5;$i++) {

              if ($i <= $com->getNote()) { echo "          <i class=\"glyphicon glyphicon-star\"></i>";}
              else { echo "          <i class=\"glyphicon glyphicon-star-empty\"></i>";}
            }?>

					<p><?php echo $com->getLibelle_c(); ?></p>
				</div>

			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /grey -->


<?php

}

else {

?>


<div id="white">
	    <div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<p><img src=<?php echo $avatar; ?> width="50px" height="50px"> <ba><a href=<?php echo "http://localhost/TER-L3/CODE/ACCUEIL/auteur_list.php?auteur=" .$cmmanager->getPseudo_par_Id($com->getId_utilisateur());?> style="color:black;"> <?php echo $cmmanager->getPseudo_par_Id($com->getId_utilisateur()); ?></ba></p>
					<p><bd><?php echo " " . $com->getDate_c(); ?></bd></p>

          <?php  //Affichage de la note
            for($i=1;$i<=5;$i++) {

              if ($i <= $com->getNote()) { echo "          <i class=\"glyphicon glyphicon-star\"></i>";}
              else { echo "          <i class=\"glyphicon glyphicon-star-empty\"></i>";}
            }?>					<p><?php echo $com->getLibelle_c(); ?></p>

        </div>

			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /grey -->


	<?php



	} //Fin du else

	$ind++;

}//Fin du foreach

?>





    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
<script>

function redirect() {


  window.location ="google.com";
}

</script>
