<?php

include "includes/en_tete.php";
include "fil_dariane.php";
echo fildariane("../ACCUEIL/index.php");

?>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<body>

    <!-- page principal -->
        <div class="container-fluid">
            <div class="row content">
              <p>
                  <div class="container">
                    <form class="form-horizontal" action="" method="post">
                      <div class="form-group">
                        <div class="btn-group btn-group-sm" data-toggle="buttons">
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="ALL">ALL</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="A">A</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="B">B</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="C">C</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="D">D</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="E">E</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="F">F</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="G">G</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="H">H</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="I">I</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="J">J</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="K">K</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="L">L</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="M">M</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="N">N</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="O">O</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="P">P</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="Q">Q</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="R">R</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="S">S</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="T">T</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="U">U</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="V">V</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="W">W</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="X">X</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="Y">Y</label>
                          <label class="btn btn-default"><input class="radio" type="radio" name="alphabet" value="Z">Z</label>
                        </div>
                        <input class="btn btn-default" type="submit" name="selectionner" value="Sélectionner" />
                      </div>

                    </form>

                    <?php
                    $selectionner = isset($_POST['selectionner']) ? $_POST['selectionner'] : NULL;
                    if($selectionner){
                      $alphabet = isset($_POST['alphabet']) ? $_POST['alphabet'] : "ALL";
                    }
                    else{
                      $alphabet = "ALL";
                    }

                    if($alphabet == "ALL"){
                      $utilisateur = $managerUtilisateur->list_auteur();
                    }
                    else{
                      $utilisateur = $managerUtilisateur->trie_auteur_par_alphabet($alphabet);
                    }

                    if($utilisateur){

                      foreach ($utilisateur as $key => $value) {
                        $niveau = $managerUtilisateur->gestion_niveau($value['id']);
                        switch($niveau){
                          case 1 :
                            $n = "Bronze";
                          break;
                          case 2 :
                            $n = "Argent";
                          break;
                          case 3 :
                            $n = "Or";
                          break;
                        }
                       echo '<div class="col-md-6">
              <div class="well well-sm">
                  <div class="row">
                      <div class="col-xs-3 col-md-3 text-center">
                           <img src="'.$value['avatar'].'"
                              class="img-rounded img-responsive" />
                      </div>
                      <div class="col-xs-9 col-md-9 section-box">
                          <h3>
                              <a style="color:blue;"" href="auteur_list.php?auteur='.$value['pseudo'].'">'.$value['pseudo'].'</a>
                          </h3>
                          <p>
                               <h5><b>Niveau : '.$n.'</b></h5>
                               <b>Nombre de publications: '.$managerMarque_Page->getNbMarquePageParCreateur($value['id']).'</b><br>

                          <hr />
                          <div class="row rating-desc">
                              <div class="col-md-12">
                                   <a href=mailto:'.$value['mail'].'><span><i id="social-em" class="fa fa-envelope-square fa-x social">Contact</i></span></a></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>';

                      }
                      echo "</div>";
                    }
                    else{
                      echo "<h1> Aucun pseudo d'utilisateur commençant par la lettre ".$alphabet." </h1>";
                    }
                    ?>

                  </div>
                </p>
              </div>
            </div>

        </body>
