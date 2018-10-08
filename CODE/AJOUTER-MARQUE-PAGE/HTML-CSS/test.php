<?php

session_start();

if (isset($_SESSION["helper"])) {

if ( $_SESSION["helper"] >= 0 ) {


 if ($_SESSION["helper"] === 1)  {//L'ajout du marque page a reussi

 //header("Refresh:0");
echo "Le marque page a bien été ajouté !";

 }




else if ($_SESSION["helper"] == 0 ) {


echo "Le marque page n'a pas bien été ajouté !";



}

}



}

echo $_SESSION["helper"];


?>



<script type="text/javascript"> 

        setTimeout(function(){ 	document.getElementById("succesorfail").innerHTML=" "; }, 4000);


</script>


