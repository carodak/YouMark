<?php
session_start();
?>


 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">





<?php








if (!isset($_SESSION['id_connecte']) || $_SESSION['id_connecte'] < 0 ) {

	  header('Location: ../../PAGE-REDIRECTION/');
      exit();      


}

include "en_tete.php";
include "../../ACCUEIL/fil_dariane.php";
echo fildariane("../../ACCUEIL/index.php");
include("add.html");






if (isset($_SESSION["helper"])) {

if ( $_SESSION["helper"] >= 0 ) {


 if ($_SESSION["helper"] === 1)  {//L'ajout du marque page a reussi

 include("succes.html");


 }




else if ($_SESSION["helper"] == 0 ) {

include("fail.html");

echo $_SESSION["helper"];


}

}

$_SESSION["helper"]=-1;


}



?>



<script type="text/javascript"> 

        setTimeout(function(){ 	document.getElementById("succesorfail").innerHTML=" "; }, 4000);


</script>
