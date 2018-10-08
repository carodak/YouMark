<?php
	include "includes/en_tete.php";
?>
<!-- bannière -->
<section class="container-fluid banner">
		<div class="ban">
				<img src="image_accueil/banner.png" alt="bannière du site" />
		</div>
		<div class="inner-banner">
				<h1> Bienvenue sur <i>YouMark</i> </h1>
		</div>
</section>
<!-- fin bannière -->
<?php
include "fil_dariane.php";
echo fildariane("../ACCUEIL/index.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Inscription utilisateur</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">

    </style>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
<form action='' method='post' id="form_inscription">
	<div class="container-fluid">
	    <section class="container">
			<div class="container-page">
				<div class="col-md-6">
					<p><h3 class="dark-grey">Inscription</h3>

						<div class="form-group col-lg-12">
							<label>Pseudo</label>
							<input type="" name="pseudo" class="form-control" id="" value="" required="Veuillez compléter ce champ">
						</div>

						<div class="form-group col-lg-6">
							<label>Mot de passe</label>
							<input type="password" name="mdp" class="form-control" id="" value="" required="Veuillez compléter ce champ">
						</div>

						<div class="form-group col-lg-6">
							<label>Répéter le mot de passe</label>
							<input type="password" name="mdp_verification" class="form-control" id="" value="" required="Veuillez compléter ce champ">
						</div>

						<div class="form-group col-lg-6">
							<label>Adresse mail</label>
							<input type="" name="email" class="form-control" id="" value="" required="Veuillez compléter ce champ">
						</div>

						<div class="form-group col-lg-6">
							<label>Répéter l'adresse mail</label>
							<input type="" name="email_verification" class="form-control" id="" value="" required="Veuillez compléter ce champ">
						</div>

					</div>

					<div class="col-md-6">
						<h3 class="dark-grey">Termes et conditions</h3>
						<p>
						 	Le site permet à l'utilisateur un accès gratuit aux services suivants :

						 	 <ul style="list-style-type:disc">
							  <li>Ajout de bookmarks</li>
							  <li>Consultation de ses bookmarks</li>
							  <li>Publication de commentaires</li>
							  <li>Ajout de favoris</li>
							</ul>

							En vous enregistrant vous acceptez les termes et conditions du site <i>YouMark</i>
						</p>

					<input type="submit" class="btn btn-primary" value="S'enregistrer" name="env">
				</div>
				</p>
			</div>
		</section>
	</div>
</form>
<script type="text/javascript">

</script>
</body>
</html>


<?php
	include '../CLASSES/PHP/Utilisateur.php';


	if (!empty ($_POST["env"])){
		try{

			/*-----INCLUDES
			 	Connexion à la bdd
			 	Utilisateur_Manager -> méthode ajoute
			 */
			include '../CONNEXION-BDD/connexion.php';


			/*
		 		htmlspecialchars(), c'est ça qui évite les injections SQL
				l'ID est en auto incrément, plus besoin de l'inserer, c'est automatique
			*/

			$pseudo=htmlspecialchars($_POST["pseudo"]);
			$mail=htmlspecialchars($_POST["email"]);
			$mail_verification=htmlspecialchars($_POST["email_verification"]);
			$motDePasse=htmlspecialchars($_POST["mdp"]);
			$mdp_verification=htmlspecialchars($_POST["mdp_verification"]);

			/*
				On vérifie si la vérification de l'adresse mail, mot de passe est correcte
				strcmp : compare deux chaines de caractères
			*/

			if (strcmp($motDePasse, $mdp_verification) !== 0){
				echo "<p>Erreur lors de la vérification des mots de passes. Veuillez vérifier qu'ils soient identiques.</p>";
			}

			else if (strcmp($mail, $mail_verification) !== 0){
				echo "<p>Erreur lors de la vérification des adresses mails. Veuillez vérifier qu'elles soient identiques.</p>";
			}

			else {
				//On créé un tableau contenant le pseudo, le mail et le mot de passe de l'utilisateur
				$tab = array(
				    "pseudo" => $pseudo,
				    "mail" => $mail,
				    "motDePasse"   => md5($motDePasse),
				    "niveau" => 1,
				    "admin" => 0,
				);
				$utilisateur = new Utilisateur($tab); //On créé une instance de la classe Utilisateur grâce aux données du tableau

				$a = new Utilisateur_Manager($db);
				$a->ajoute($utilisateur); // On ajoute l'utilisateur via la méthode ajoute de Utilisateur_Manager

				echo "<p>Votre compte a bien été créé. Redirection en cours..</p>";
				header('Refresh: 4; url=index.php');
			}

		}
		catch (PDOException $e){
			print "Erreur !: " . $e->getMessage() . "<br/>";
			die();
		}
	}

?>
<html>
	<body>

	<!-- footer -->
	    <footer class="container-fluid footer">
	      <div class="container" style="margin-top: 25px;">
	         <div class="row">
	             <legend></legend>
	             <p>© Copyright 2017. <i>YouMark</i>. Tous droits réservés.
	               <span class="pull-right"><a href="contact.php">Contact</a></span></p>
	              </div>
	            </div>

	    </footer>
	    <!-- fin footer -->
	</body>
</html>
