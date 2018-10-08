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


include "connexion.php";


$managerTag = new Tag_Manager($db);
$managerUtilisateur = new Utilisateur_Manager($db);
$managerMarque_Page = new Marque_Page_Manager($db);
$managerCommente = new Commente_Manager($db);
$managerAjoute_Modifie = new Ajoute_Modifie_Manager($db);

?>


<!DOCTYPE html>
<html>

<head>
    <meta <charset="utf-8">
    <title> Social Bookmarking - Youtube </title>

    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/accueil_bootstrap.css" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	  <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
      $(function(){
         $("#barre_de_recherche").load("recherche_simple.html");
      });

      $(document).ready(function() {
        $(".dropdown-toggle").dropdown();
      });

      </script>

</head>

<!-- contenu du site -->

<body>
    <!-- header -->
    <header class="container-fluid header">
        <div class="container">
            <img src="includes/logo.png" class="logo" />

            <!-- barre de recherche -->
            <div id="barre_de_recherche"></div>

            <a href='../ACCUEIL/index.php'>'<img src="image_accueil/home.png" class="home" /></a>
          </div>

        </div>
    </header>
    <!-- fin header -->
