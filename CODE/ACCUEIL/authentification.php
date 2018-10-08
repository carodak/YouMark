<?php
ob_start();
/*******PAGE D AUTHENTIFICATION*******/
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

include "../CONNEXION-BDD/connexion.php";
include "../CLASSES/PHP/Utilisateur_Manager.php";


$usm = New Utilisateur_Manager($db);


if(!empty($_POST['auth'])){

$_SESSION['id_connecte']=-1; //Si elle reste à -1 aucune connexion n'a abouti .
$_SESSION['pseudo']=$_POST['pseudo'];
$_SESSION['mot_de_passe']=$_POST['mot_de_passe'];
$uid = $usm->getIdByPseudo($_SESSION['pseudo']);
$_SESSION['id_connecte'] = $uid;

}

?>

<?php

$valider = !empty($_POST['auth']) ? $_POST['auth'] : NULL;




if($valider){



// Connexion à la base de données


// On va chercher le mot de passe (crypté) en MD5 de l'utilisateur connecté

// Cryptage du mot de passe donné par l'utilisateur à la connexion par requête SQL

$requete ="select MD5('".$_SESSION['mot_de_passe']."');";



foreach($db->query($requete) as $ligne)

// Le vrai mot de passe crypté est sauvergardé dans la variable $VraiMDP

{

  $VraiMDP=$ligne["MD5('".$_SESSION['mot_de_passe']. "')"];

}

// Initialisation à Faux de la variable "L'utilisateur existe".

$trouver=False;

// On interroge la base de donnée sur les utilisateurs enregistrés

$requete ="select mail,mot_de_passe,pseudo,avatar,niveau,admin,id from utilisateur;";



foreach($db->query($requete) as $ligne){

// Si l'utilisateur X est celui de la session

if ( $ligne['pseudo']==$_SESSION['pseudo'])

{

// Alors on vérifie si le mot de passe est le bon


if ($VraiMDP == $ligne['mot_de_passe'])


// Si le couple est bon, c’est que l’utilisateur est le bon.

{
  $trouver=True;
  $mail=$ligne['mail'];$avatar=$ligne['avatar']; $niveau=$ligne['niveau']; $admin=$ligne['admin']; $id=$ligne['id'];

    setcookie('pseudo_utilisateur', $_POST['pseudo'], (time() + 1*24*60*60));
    header ("location: index.php");

}



}

}

// Si l'utilisateur n'est toujours pas valide à la fin de la lecture tableau

if ( $trouver==False )

// Redirection vers la fenêtre de connexion.

{

echo "Utilisateur ou mot de passe incorrect !!";
header ("location: index.php?connexion=erreur");

}

else{
  /**Creation des cookies**/
  if(isset($_POST['se_souvenir_de_moi'])) {
            //Creer les cookies pour 1 jour, ie, 1*24*60*60 secs
            setcookie('id_utilisateur', $id, (time() + 1*24*60*60));
            setcookie('mail_utilisateur', $mail, (time() + 1*24*60*60));
            setcookie('pseudo_utilisateur', $_POST['pseudo'], (time() + 1*24*60*60));
            setcookie('avatar_utilisateur', $avatar, (time() + 1*24*60*60));
            setcookie('niveau_utilisateur', $niveau, (time() + 1*24*60*60));
            setcookie('admin_utilisateur', $admin, (time() + 1*24*60*60));
        } else {
            //Détruire les cookies

            setcookie('id_utilisateur', '', (time() - 1*24*60*60));
            setcookie('mail_utilisateur', '', (time() - 1*24*60*60));
            setcookie('avatar_utilisateur', '', (time() - 1*24*60*60));
            setcookie('niveau_utilisateur', '', (time() - 1*24*60*60));
            setcookie('admin_utilisateur', '', (time() - 1*24*60*60));
        }

}

}


ob_end_flush();
?>
