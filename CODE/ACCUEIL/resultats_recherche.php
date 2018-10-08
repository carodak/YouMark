<!DOCTYPE html>
        <html>

        <head>
            <meta <charset='utf-8'>
            <title> Social Bookmarking - Youtube </title>

            <!-- font -->
            <link href='https://fonts.googleapis.com/css?family=Raleway:300,400,500,600' rel='stylesheet'>

            <!-- css -->
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
            <link rel='stylesheet' type='text/css' href='css/recherches.css' />
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
            <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
            <script>


              $(function(){
                  $('#barre_de_recherche').load('includes/recherche_simple.html');
              });

            </script>
        </head>

        <body>
          <!-- header -->
          <header class='container-fluid header2'>
              <div class='container'>
                  <img src='includes/logo.png' class='logo' />

                  <!-- barre de recherche -->
                  <div id='barre_de_recherche'></div>

                  <a href='index.php'>'<img src='image_accueil/home.png' class='home' /></a>
                </div>

              </div>
          </header>
          <!-- fin header -->

              <div class='jumbotron'>
                <span class='text-primary'><h1>Resultats de la recherche</h1></span>
              </div>


<?php
	ini_set("display_errors", 1);  //Ecrit sur le fichier php.ini, lui indique d'afficher les erreurs
	error_reporting(E_ALL);
	session_start();

  include "fil_dariane.php";
  echo fildariane("../ACCUEIL/index.php");

	if (!empty ($_POST['envoi_form1']) || isset($_SESSION['contenu_recherche']) ){
    	try{

         /*
            On affiche dans un bel encadré "Résultats de la recherche"
          */

        include 'recherche_avancee.php';
			   include 'resultats_recherche_gauche.php';

    	}

   		catch (PDOException $e){
     		print 'Erreur !: ' . $e->getMessage() . '<br/>';
    	  	die();
    	}
  	}

  	else{
    	echo '<p>Veuillez passer par le formulaire</p>';
  	}

?>
