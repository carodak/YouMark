<script>
$(document).ready(function() {
$('[data-toggle="popover"]').popover({
container: 'body',
html: true,
placement: 'auto',
trigger: 'hover',
});
});
</script>

 <div class="col-md-4 col-sm-12 sidenav">

                    <?php

                      if(!isset($_COOKIE['pseudo_utilisateur'])){

                      ?>
                          <!-- Fenêtre de connexion -->
                    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-9 col-md-offset-2 col-sm-9 col-sm-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">Connexion</div>
                            </div>
                            <div style="padding-top:30px" class="panel-body">
                            <?php
                            if(isset($_GET['connexion'])){
                              ?>
                                  <div class="alert alert-danger">
                                    <strong>Connexion impossible:</strong><br>Login ou mot de passe incorrect!
                                  </div>
                              <?php
                              }
                              ?>

                                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                                <form id="loginform" class="form-horizontal" role="form" action="authentification.php" method="post">
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="pseudo" value="" placeholder="pseudo">
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="mot_de_passe" placeholder="mot de passe">
                                    </div>

                                    <div class="input-group">
                                        <div class="checkbox">
                                            <label>
                                <input id="login-remember" type="checkbox" name="se_souvenir_de_moi" value="1"> Se souvenir de moi
                            </label>
                                        </div>
                                    </div>
                                    <br>
                                    <div style="margin-top:10px" class="form-group">
                                        <div class="col-sm-12">
                                            <input type="submit" class="btn btn-success" value="S'authentifier" name="auth">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12 control">
                                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                                Pas de compte!
                                                <a href="inscription.php" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                    S'enregistrer ici!
                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                               </div>
                               </div>
                          <?php
                            }
                            else{
                              $pseudo = $_COOKIE['pseudo_utilisateur'];
                              $managerUtilisateur = new Utilisateur_Manager($db);
                              /***Recuperation des informations de l'utilisateur par le biai du cookie stockant le pseudo de l'utilisateur***/
                              $utilisateur = $managerUtilisateur->get_par_Pseudo($pseudo);
                              $id_utilisateur = $utilisateur->getID();

                             ?>




                           <!-- Fenêtre de compte utilisateur -->
                      <div id="accountbox" style="margin-top:50px;" class="mainbox col-md-10 col-md-offset-2 col-sm-9 col-sm-offset-2">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                    <a href='deconnexion.php' class="btn btn-danger pull-right">
                                      <span class="glyphicon glyphicon-off"></span>
                                      </a>
                                      <a href=<?php echo "'../ESPACES/parametres.php?utilisateur=".$pseudo."'";?> class="btn btn-warning pull-right">
                                      <span class="glyphicon glyphicon-cog"></span>
                                      </a>

                             <!---<form action="deconnexion.php" method="post">
                                     <div class="form-group">
                                      <input type=submit value="Déconnexion" class='btn btn-xs btn-danger pull-right'>
                                      </div>
                                      </form>
                              -->


                                 <div class="panel-title">Mon Compte </div>
                                </div>
                                 <div style="padding-top:30px" class="panel-body">

                                  <img src=<?php echo "'".$utilisateur->getAvatar()."'"; ?> width=100 height=100 align="right"/><br>
                                  <b>Pseudo :</b> <?php echo $utilisateur->getPseudo(); ?><br>
                                  <b>Adresse Mail:</b> <?php echo $utilisateur->getMail(); ?><br>
                                  <b>Niveau :</b> <?php  $niveau = $managerUtilisateur->gestion_niveau($id_utilisateur);
                                  switch($niveau){
                                    case 1 :
                                      echo "Bronze";
                                    break;
                                    case 2 :
                                      echo "Argent";
                                    break;
                                    case 3 :
                                      echo  "Or";
                                    break;
                                  } ?><br>

                                   <div class="col-xs-12 divider text-center">

                                    <div class="col-xs-12 col-sm-4">
                                        <a href=<?php echo "'../ESPACES/mes_favoris.php?utilisateur=".$pseudo."'";?>  class="btn btn-primary"><span class="glyphicon glyphicon-star"></span>Favoris</a>
                                    </div>

                                    <div class="col-xs-12 col-sm-4">
                                         <a href="../AJOUTER-MARQUE-PAGE/HTML-CSS/add.php" class="btn btn-xl btn-info"><span class="glyphicon glyphicon-plus-sign"></span>Ajouter un Bookmark</a>
                                    </div>
                                  </div>




                                      </div>
                            </div>

                          <?php
                            }
                          ?>
                        <!-- Fin Fenêtre de connexion -->



                        <!-- Fenêtre Tag -->


                         <!-- Fenêtre Tag -->
                        <div class = "panel panel-default">
                          <div class = "panel-heading">
                            <h1 class = "panel-title">Tags Cloud</h1>
                          </div>

                          <div class = "panel-body">
                            <ul class="cloud">
                          <?php
                          
                                   include ("tags.php");

                         ?>
                           </ul>
                           <div class="voir_plus">
                           <a href="tags_list.php" class="btn btn-xs btn-success pull-right"><span class="glyphicon glyphicon-plus-sign"></span> Voir plus</a>
                          </div>
                        </div>
                        </div>
                        <!-- Fin Fenêtre Tag -->

                        <!-- Fin Fenêtre Tag -->




                        <!-- Debut Fenêtre de top utilisateur -->
                        <div class = "panel panel-default">
                          <div class = "panel-heading">
                            <h1 class = "panel-title">Top Utilisateurs</h1>
                          </div>

                          <div class = "panel-body">

                            <div id="nb_utilisateurs">
                               <img src="image_accueil/users.png"/>
                                <?php
                                $nbreUtilisateur = $managerUtilisateur->count();
                               echo "<h4>". $nbreUtilisateur ." abonnés </h4>";
                                ?>
                            </div>

                            <?php
                               $utilisateur = $managerUtilisateur->utilisateur_top_niveau();
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
                                 echo "
                                   <div class='col-md-4 col-sm-6 col-xs-6 thumbnail'>
                                     <a href='auteur_list.php?auteur=".$value['pseudo']."' data-toggle='popover' data-title='<center><b>".$value['pseudo']."</b></center>' data-content='<b>Niveau:</b> ".$n."'><img class='img-rounded zoom' src= '".$value['avatar']."'alt='Photo de Profil' height='60' width='60' zoom/>
                                     </a></li>
                                   </div>";
                               }
                               ?>
                               <a href="utilisateur_list.php" class="btn btn-xs btn-success pull-right"><span class="glyphicon glyphicon-plus-sign"></span> Voir plus</a>

                          </div>
                        </div>
                        </div>
                        </div>
                      <!-- Fin Fenêtre de top utilisateur -->
                    </div>
                </div>
            </div>
            </section>
            <!-- footer -->
    <footer class="container-fluid footer">
      <div class="container" style="margin-top: 25px;">
         <div class="row">
             <legend></legend>
             <p>© Copyright 2017. <i>YouMark</i>. Tous droits réservés.
               <span class="pull-right"><a href="contact_footer.php">Contact</a></span></p>
              </div>
            </div>

    </footer>
    <!-- fin footer -->
