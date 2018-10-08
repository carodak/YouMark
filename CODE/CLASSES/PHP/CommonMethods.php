<?php





//Fichier qui me sert à gérer des méthodes communes à différentes classes

//Par exemple : Incrémenter le niveau d'un joueur : Il se fait lors d'ajout/modif d'un marque page, commentaire, note trois classes utiliseront cette méthode.




function IncreScore($id_user,$score) {

$db = new PDO('mysql:host=localhost; dbname=social_bookmarking; charset=UTF8', 'root', '123456789');
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				
$query = $db->prepare("UPDATE `utilisateur` SET `niveau`= :score WHERE id = :iduser");

$query->bindValue(':score', $score);
$query->bindValue(':iduser', $id_user);

$query->execute();


}



?>