<!-- contenu du site -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> Comment installer le bouton ? </title>

    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/accueil_bootstrap.css" />
      <link rel="stylesheet" type="text/css" href="./css/styles.css" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
      <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src='http://code.jquery.com/jquery-2.1.4.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js'></script>

</head>



<?php

include "includes/en_tete.php";
include "../ACCUEIL/fil_dariane.php";
//echo fildariane("../ACCUEIL/index.php");
$pseudo = $_GET['utilisateur'];
  /***Recuperation des informations de l'utilisateur par le biai du cookie stockant le pseudo de l'utilisateur***/
$utilisateur = $managerUtilisateur->get_par_Pseudo($pseudo);
$id_utilisateur = $utilisateur->getID();

?>

    <!-- page principale -->

              <body>
              <div class="container">
    <div class="row" style="margin-top:50px;">
        <div class="col-md-4">
            <!-- It can be fixed with bootstrap affix http://getbootstrap.com/javascript/#affix-->
            <div id="sidebar" class="well sidebar-nav">
                <h5><i class="glyphicon glyphicon-home"></i>
                    <small><b>Mon Compte</b></small>
                </h5>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="../AJOUTER-MARQUE-PAGE/HTML-CSS/add.php">Ajouter un bookmark</a></li>
                </ul>
                <h5><i class="glyphicon glyphicon-user"></i>
                    <small><b>Utilisateur</b></small>
                </h5>
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href=<?php echo "'mes_favoris.php?utilisateur=".$pseudo."'"; ?> >Mes Favoris</a></li>
                    <li><a href=<?php echo "'parametres.php?utilisateur=".$pseudo."'"; ?> >Mes informations</a></li>
                    <li><a href=<?php echo "'explications_bouton.php?utilisateur=".$pseudo."'"; ?> >Installation Bouton</a></li>
                </ul>
                <h5><i class="glyphicon glyphicon-off"></i>
                    <a href="../ACCUEIL/deconnexion.php"><small><b>Deconnexion</b></small></a>
                </h5>
            </div>
        </div>
        <div class="col-md-8">



                 <h2>Comment installer le bouton sur le site Youtube?</h2><br><br>

                 <h4>Navigateur requis : Firefoxo, Chrome, Opéra. </h4>
                 <br>
                 <p><b>Etape 1 :</b><br> <br />
                 <img src="includes/firefox.png"> Télécharger GreaseMonkey : <a href="https://addons.mozilla.org/fr/firefox/addon/greasemonkey/">https://addons.mozilla.org/fr/firefox/addon/greasemonkey/</a></p>
                  <img src="includes/opera.png"> Télécharger GreaseMonkey : <a href="https://addons.opera.com/fr/extensions/details/tampermonkey-beta/?display=en">https://addons.opera.com/fr/extensions/details/tampermonkey-beta/</a></p>
                  <img src="includes/chrome.png"> Télécharger TamperMonkey : <a href="https://chrome.google.com/webstore/detail/tampermonkey/dhdgffkkebhmkfjojejmpbldmpobfkfo?hl=fr">https://chrome.google.com/webstore/detail/tampermonkey/</a></p>

                 <p><b>Etape 2 :</b><br> Installer le scripte suivant : <a href="https://openuserjs.org/scripts/lyes.megharagmail.com/AvosMarquesHelper">AvosMarquesHelper</a> </p>
                 <img src="images_explications/3.png" alt="GreaseMountain" style="width:800px;height:400px;">

<br>

<br><br>
<br>

<img src="images_explications/4.jpg" alt="GreaseMountain" style="width:800px;height:400px;">
Il devrait à présent apparaître dans la liste des scripts.
     
<br><br>
                 

<b><h3>Le bouton est maintenant visible à chaque fois que vous regardez une vidéo sur YouTube.</h3></b>

</p>
<img src="images_explications/5.jpg" alt="Page Youtube avec Bouton" style="width:500px;height:400px;">


        </div>
        </div>

    </div>

        </div>
        </div>
        </div>
             <!-- footer -->
    <footer class="container-fluid footer">
      <div class="container" style="margin-top: 25px;">
         <div class="row">
             <legend></legend>
             <p>© Copyright 2017. <i>YouMark</i>. Tous droits réservés.
               <span class="pull-right"><a href='contact_footer.php'>Contact</a></span></p>
              </div>
            </div>

    </footer>
    <!-- fin footer -->
