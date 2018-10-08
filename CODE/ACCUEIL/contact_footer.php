<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

function chargerClasse($classname)
{
  require '../CLASSES/PHP/'.$classname.'.php';
}



spl_autoload_register('chargerClasse');

session_start();


$db = new PDO('mysql:host=localhost;dbname=social_bookmarking', 'root', 'root');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

if(isset($_POST['envoyer'])){
  if(isset($_POST['mail']) && filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL) && isset($_POST['nom']) && isset($_POST['sujet']) && isset($_POST['message'])){
    $to = "nomdusite@mail.com";
    $from = $_POST['mail'];
    $nom = $_POST['nom'];
    $sujet = $_POST['sujet'];
    $message = $nom . " a écrit :" . "\n\n" . $_POST['message'];
    $message2 = "Voici un copie de votre message " . $nom . "\n\n" . $_POST['message'];
    echo $nom." ".$sujet." ".$message." ".$from;

    $headers = "From: ".$from;
    $headers2 = "From: ".$to;
    if(mail($to,$sujet,$message,$headers) && mail($from,$sujet,$message2,$headers2)){
    ?>
    <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Mail envoyé!</strong> Merci <?php echo $nom; ?> , nous allons vous contacter sous peu.
    </div>
    <?php
    }else{
      ?>
      <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Oops!</strong> L'envoi du message a échoué.
            </div>
    <?php
    }
    }
    else{
      ?>
      <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Veuillez bien remplir tous les champs svp!.</strong>
            </div>
    <?php

    }
  }

?>

<!DOCTYPE html>
<html>

<head>
    <meta <charset="utf-8">
    <title> Contact </title>

    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css">
    .jumbotron {
    background: #2980B9;
    color: #FFF;
    border-radius: 0px;
    }
    .jumbotron-sm { padding-top: 12px;
    padding-bottom: 12px; }
    .jumbotron small {
    color: #FFF;
    }
    .h1 small {
    font-size: 24px;
    }
    .button {
    background: #2980B9;
    color: #FFF;
    border-radius: 3px;
    }
    .button.hover {
    background: #2980B9;
    color: #358CCE;
    }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<!-- contenu du site -->

<body>
  <div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-sm-12">
                <h1 class="h1">
                    Contactez-nous <small>Soyez libres de nous contacter</small></h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
      <?php include "fil_dariane.php";
      echo fildariane("../ACCUEIL/index.php"); ?>
        <div class="col-md-8">
            <div class="well well-sm">
                <form method="post" action="contact.php">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">
                                Nom</label>
                                <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                                </span>
                            <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez votre nom" required="required"/></div>
                        </div>
                        <div class="form-group">
                            <label for="mail">
                                Mail</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" class="form-control" name="mail" id="mail" placeholder="Entrez votre mail" required="required" /></div>
                        </div>
                        <div class="form-group">
                            <label for="sujet">
                                Sujet</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-list"></span>
                                </span>
                                <input type="text" class="form-control" name="sujet" id="sujet" placeholder="Entrez le sujet" required="required" /></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">
                                Message</label>
                            <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
                                placeholder="Message"></textarea>
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-md-12">
                            <button type="submit" name="envoyer" class="btn btn-warning pull-right">Envoyer <span class="glyphicon glyphicon-send"></span></button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <form>
            <legend><span class="glyphicon glyphicon-globe"></span> Notre Position</legend>
            <address>
                <strong>nomdusite.com</strong><br>
                Montpellier<br>
                France<br>
                <abbr title="Phone">
                    Phone</abbr>
                (+33) 000 000 000
            </address>
            <address>
                Email: <a href="mailto:nomdusite@mail.com">nomdusite@mail.com</a>
            </address>
            </form>
        </div>
    </div>
</div>

</body>
</html>
