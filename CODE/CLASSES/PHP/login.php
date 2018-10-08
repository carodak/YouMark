<?php
session_start();

/* CONFIGURATION */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '123456789');
define('DB_DATABASE', 'social_bookmarking');


//Pour se connecter il faut :

 // 1  include_once "..\includes\login.php";
 // 2 $var = getDB()
 // fini ! | on modifie username et password dans les define pour la fac !


function getDB()
{
$dbhost=DB_SERVER;
$dbuser=DB_USERNAME;
$dbpass=DB_PASSWORD;
$dbname=DB_DATABASE;

try {

$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
$dbConnection->exec("set names utf8"); //Affichage en UTF8
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Erreurs SQL
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES,TRUE);

return $dbConnection;

}

catch (PDOException $e) {
echo 'Erreur de connexion : ' . $e->getMessage();
}

}
?>
