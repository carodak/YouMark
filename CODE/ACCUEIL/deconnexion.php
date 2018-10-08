<?php
/**
* détruit la session
* détruit les cookies
* redirection vers la page d'accueil
*/
session_start();
session_destroy();
setcookie('id_utilisateur', '', (time() - 1*24*60*60));
setcookie('mail_utilisateur', '', (time() - 1*24*60*60));
setcookie('pseudo_utilisateur', '', (time() - 1*24*60*60));
setcookie('avatar_utilisateur', '', (time() - 1*24*60*60));
setcookie('niveau_utilisateur', '', (time() - 1*24*60*60));
setcookie('admin_utilisateur', '', (time() - 1*24*60*60));
header("location: index.php");
?>
