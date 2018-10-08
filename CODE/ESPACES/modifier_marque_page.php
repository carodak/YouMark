<!-- contenu du site -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> Modifier un marque-page </title>

    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="./css/iconselect.css" >
    <link rel="stylesheet" type="text/css" href="./css/accueil_bootstrap.css" />
      <link rel="stylesheet" type="text/css" href="./css/styles.css" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
      <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript" src="lib/iconselect.js"></script>
<script type="text/javascript" src="lib/iscroll.js"></script>
<script src='http://code.jquery.com/jquery-2.1.4.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js'></script>

</head>



<?php

include "includes/en_tete.php";
include "../ACCUEIL/fil_dariane.php";
echo fildariane("../ACCUEIL/index.php");
$pseudo = $_GET['utilisateur'];
  /***Recuperation des informations de l'utilisateur par le biai du cookie stockant le pseudo de l'utilisateur***/
$utilisateur = $managerUtilisateur->get_par_Pseudo($pseudo);
$id_utilisateur = $utilisateur->getID();

$ajoute_modifie = $managerAjoute_Modifie->get_par_Key($id_utilisateur, $_GET['id_marque_page'], $_GET['date_a']);

if(isset($_POST['modifier'])){
  $modifie = new Ajoute_Modifie(['id_utilisateur' => $_GET['id_utilisateur'], 'id_marque_page' => $_GET['id_marque_page'], 'date_m'=> date("Y-m-d H:i:s"), 'date_a' => $_GET['date_a'], 'description' => $_POST['description_p'], 'type_droit' => $_POST['type_droit'], 'createur' => $ajoute_modifie->getCreateur(), 'logo_choisi' => $_POST['logo_choisi']]);
  $managerAjoute_Modifie->update($modifie);

  //Et là on rajoute ses tags dans la table Tag :


  $liste_tag=explode(",", $_POST["label"]);  //Les tags sont séparés par des "," donc pour tous les insérer je dois le faire dans une boucle l'un après l'autre
  $liste_tag = array_diff($liste_tag,array("null","")); //Je suprimme les valeurs null et vides du tableau

  foreach ($liste_tag as $key => $value) {


  $tg = new Tag(['id_utilisateur' => $_GET['id_utilisateur'], 'id_marque_page' => $_GET['id_marque_page'], 'date_t'=> date("Y-m-d H:i:s"), 'label'=>$value]);
  $managerTag->ajoute($tg);

  }

  //Fin d'ajout des tags

  //redirection du la page des favoris du créateur
  header('Location: mes_favoris.php?utilisateur='.$pseudo."&modification=OK");
  exit();

}


?>

    <!-- page principale -->

              <body>
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
                    <li class="active"><a href=<?php echo "'mes_favoris.php?utilisateur=".$pseudo."'"; ?> >Mes Favoris</a></li>
                    <li><a href=<?php echo "'parametres.php?utilisateur=".$pseudo."'"; ?> >Mes informations</a></li>
                 <li><a href=<?php echo "'explications_bouton.php?utilisateur=".$pseudo."'"; ?> >Installation Bouton</a></li>
</ul>
                <h5><i class="glyphicon glyphicon-off"></i>
                    <a href="../ACCUEIL/deconnexion.php"><small><b>Deconnexion</b></small></a>
                </h5>
            </div>
        </div>
        <div class="col-md-8">



                 <h2>Modifier un marque page</h2><br><br>
                  <h5>Aperçu actuel:</h5>

                <?php
                $value = $managerAjoute_Modifie->get_createur($_GET['id_marque_page']);
                echo '<table class="table table-filter">';
                                echo "
                                <tr>
                                      <td>
                                           <div class='media'>
                                           <a href='#' class='pull-left'>
                                           <img src='includes/images/".$value['logo_choisi'].".png' alt='Photo Marque-Page' width='75' height='75' class='media-photo'>
                                           </a>
                                           <div class='media-body'>
                                           <h4 class='title'><a style='color:blue;' href=".$value['url'].">".$value['titre']."</a></h4>
                                            <p class='description'>".$value['description']."</p>
                                 <h5 style='font-style:italic;'> Soumis il y a ";
                                 $managerMarque_Page->tempsEcoule($value['date_a']);

                                 if($value['id_utilisateur']!=NULL){
                                   $auteur=$managerUtilisateur->get_par_Id($value['id_utilisateur']);
                                   echo "par ".$auteur->getPseudo();
                                 }
                                 echo "</h5>";

                                       $tags = $managerTag->tag_Par_Marque_Page($value['id_marque_page']);
                                     foreach ($tags as $key => $value2) {
                                      echo "<a href=../ACCUEIL/clic_tag.php?label_tag=".rawurlencode($value2['label'])." class='btn btn-xs btn-primary'>".$value2['label']."</a>  ";
                                     }
                                     echo "<br>

                                           </div>
                                           </div>
                                      </td>

                            <td>
                              <h4>".$value['note']."/5</h4>
                              <div class='hoverflash'>
                              <a href='../DESC-BOOKMARK/PHP/indx.php?id_marque_page=".$value['id_marque_page']."'>
                              <figure>
                              <img src='image_accueil/plus.png' alt='En savoir plus!' width='120' height='45''>
                              </figure>
                              </a>

                            </td>
                                </tr>";

                              echo "</table>";


                ?>

           <form method="post" action=""<?php //echo "'mes_favoris.php?utilisateur=".$pseudo."'"; ?> >

             <div class="input-field col s6">
              <label>Rajouter des Tag(s) : </label><br>
              <input type="text" id="label"  class="form-control" name="label" pattern="([a-zA-Z]*),*">
             </div>
             <br>
              <div class="input-field col s6">
              <label>Modifier la Description: </label><br>
              <textarea id="description_p" name="description_p" class="form-control"><?php echo $ajoute_modifie->getDescription(); ?></textarea>
              </div>
              <br>
              <div class="input-field col s6">
              <label>Confidentialité:</label>
              <input  id="droitsp" name="type_droit" type="radio" value="1" <?php if($ajoute_modifie->getType_Droit() == 1){ echo "checked";} ?> >
              <label for="droitsp">Public</label>
              <input  id="droitspr" name="type_droit" type="radio"  value="0" <?php if($ajoute_modifie->getType_Droit() == 0){ echo "checked";} ?> >
              <label for="droitspr">Privé</label>

              </div>

  <script>


        var iconSelect;
        var selectedText;

        window.onload = function(){

            selectedText = document.getElementById('logo_choisi');

            document.getElementById('my-icon-select').addEventListener('changed', function(e){
               selectedText.value = iconSelect.getSelectedValue();
            });

            iconSelect = new IconSelect("my-icon-select");

            var icons = [];
            icons.push({'iconFilePath':'includes/images/1.png', 'iconValue':'1'});
            icons.push({'iconFilePath':'includes/images/2.png', 'iconValue':'2'});
            icons.push({'iconFilePath':'includes/images/3.png', 'iconValue':'3'});
            icons.push({'iconFilePath':'includes/images/4.png', 'iconValue':'4'});
            icons.push({'iconFilePath':'includes/images/5.png', 'iconValue':'5'});
            icons.push({'iconFilePath':'includes/images/6.png', 'iconValue':'6'});
            icons.push({'iconFilePath':'includes/images/7.png', 'iconValue':'7'});
            icons.push({'iconFilePath':'includes/images/8.png', 'iconValue':'8'});
            icons.push({'iconFilePath':'includes/images/9.png', 'iconValue':'9'});
            icons.push({'iconFilePath':'includes/images/10.png', 'iconValue':'10'});
            icons.push({'iconFilePath':'includes/images/11.png', 'iconValue':'11'});
            icons.push({'iconFilePath':'includes/images/12.png', 'iconValue':'12'});
            icons.push({'iconFilePath':'includes/images/13.png', 'iconValue':'13'});
            icons.push({'iconFilePath':'includes/images/14.png', 'iconValue':'14'});

            iconSelect.refresh(icons);
            selectedText.value = "Logo :";
            $('#logo_choisi').val(<?php echo $ajoute_modifie->getLogo_Choisi();?>);
        };


</script>


              <div class="input-field col s6">
              <br>
              <label>Choisir un Logo:</label>
              <div id="my-icon-select"></div>
              <br>
              <input type="number" id="logo_choisi" name="logo_choisi"  style="display:none;  required min="1" max="14" >
         </div><br>
        <div class="input-field col 2">
              <!-- Boutton d'envoi et de reset !-->
               <input type="submit" class="btn btn-success pull-left" value="Modifier" name="modifier" onclick="return confirm('Voulez-vous vraiment modifier ce marque-page ? ');">


               <a href=<?php echo "'mes_favoris.php?utilisateur=".$pseudo."'"; ?> class="btn btn-danger pull-left">
               <i class="glyphicon glyphicon-remove"></i> Annuler
               </a>
          </div>
              <!-- FIN Boutton d'envoi et de reset !-->

             </form>

           </div>
        </div>

    </div>

        </div>
        </div>
        </div>
             <!-- footer -->
    <footer class="container-fluid footer">
      <div class="container" style="margin-top: 25px;">
         <div class="row">
             <legend></legend>
             <p>© Copyright 2017. <i>YouMark</i>. Tous droits réservés.
               <span class="pull-right"><a href='contact_footer.php'>Contact</a></span></p>
              </div>
            </div>

    </footer>
    <!-- fin footer -->
