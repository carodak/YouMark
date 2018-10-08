
<!DOCTYPE html>
<html>

<head>
    <meta <charset="utf-8">
    <title> Paramètres du compte </title>

    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/accueil_bootstrap.css" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
      <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<!-- contenu du site -->

<body>

<?php

	include "includes/en_tete.php";
  include "../ACCUEIL/fil_dariane.php";
  echo fildariane("../ACCUEIL/index.php");

$pseudo = $_GET['utilisateur'];
	/***Recuperation des informations de l'utilisateur par le biai du cookie stockant le pseudo de l'utilisateur***/
$utilisateur = $managerUtilisateur->get_par_Pseudo($pseudo);
$id_utilisateur = $utilisateur->getID();

?>

              <tbody>
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
                    <li><a href=<?php echo "'mes_favoris.php?utilisateur=".$pseudo."'"; ?> >Mes Favoris</a></li>
                    <li class="active"><a href=<?php echo "'parametres.php?utilisateur=".$pseudo."'"; ?>>Mes informations</a></li>
                 <li><a href=<?php echo "'explications_bouton.php?utilisateur=".$pseudo."'"; ?> >Installation Bouton</a></li>
		</ul>
                <h5><i class="glyphicon glyphicon-off"></i>
                    <a href="../ACCUEIL/deconnexion.php"><small><b>Deconnexion</b></small></a>
                </h5>
            </div>
        </div>
        <div class="col-md-8">

		<h2>Paramètres du compte</h2><br><br>

<?php

 /**si modifications**/
          if(isset($_POST['valider'])){
            $onglet=3;
            if(isset($_POST['mdp']) && isset($_POST['mdp2']) && (strcmp($_POST['mdp'],$_POST['mdp2']) == 0)){
              $utilisateur->setMotDePasse($_POST['mdp']);
              $managerUtilisateur->update($utilisateur);
              ?>
               <div class="alert alert-success">
                    <strong>Confirmation: </strong> Votre mot de passe a été modifié !
              </div>
              <?php
            }

            else{
              ?>
                  <div class="alert alert-danger">
                    <strong>Erreur: </strong> Mot de passe différents !
                  </div>
              <?php
            }
          }

          if(isset($_POST['valider_a'])){
            $onglet=3;
            if(isset($_POST['url_avatar'])){
              $utilisateur->setAvatar($_POST['url_avatar']);
              $managerUtilisateur->update($utilisateur);
              ?>
               <div class="alert alert-success">
                    <strong>Confirmation: </strong> Votre avatar a été modifié !
              </div>
              <?php
            }

            else{
              ?>
                  <div class="alert alert-danger">
                    <strong>Erreur: </strong> Veuillez saisir une URL valide !
                  </div>
              <?php
            }
          }

?>


<h3>Modifier mon mot de passe:</h3>

<form method="post" id="passwordForm">
<input type="password" class="input-xs form-control" name="mdp" id="mdp" placeholder="Nouveau Mot de Passe" autocomplete="off"><br>

<input type="password" class="input form-control" name="mdp2" id="mdp2" placeholder="Confirmer le mot de passe" autocomplete="off"><br>

<input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Changer" name="valider" OnClick="return confirm('Voulez-vous vraiment modifier votre mot de passe ? ');">
</form>


            <br><br>
            <h3>Modifier mon avatar:</h3>
            <form method="post">


              <input type="text" class="input form-control" name="url_avatar" placeholder="URL de l'avatar" autocomplete="off"><br>

              <input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Modifier" name="valider_a" OnClick="return confirm('Voulez-vous vraiment modifier votre avatar ? ');">
            </form>


            </div>

            </div></div>
            </tbody>


            <!-- footer -->
    <footer class="container-fluid footer">
      <div class="container" style="margin-top: 25px;">
         <div class="row">
             <legend></legend>
             <p>© Copyright 2017. <i>YouMark</i>. Tous droits réservés.
               <span class="pull-right"><a href="contact_footer.php">Contact</a></span></p>
              </div>
            </div>

    </footer>
    <!-- fin footer -->
