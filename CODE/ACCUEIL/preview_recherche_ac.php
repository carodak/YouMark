 <!-- Fenêtre Auteur -->
                        
                          

                          <div class = "p2">
                            <ul class="cloud">
                          <?php
                          include '../CONNEXION-BDD/connexion.php';
                          include '../CLASSES/PHP/Utilisateur_Manager.php';
                            $auteur_manager = new Utilisateur_Manager($db);
                            $auteur = $auteur_manager->trie_auteur_par_nb_Mp_Postes();
                                $max= 130;
                                $compt=0;

                                foreach ($auteur as $key => $value) {
                                     if($compt+strlen($value['pseudo'])<=$max){
                                       $pseudo = $value["pseudo"];
echo <<<EOD
                                  <li><a href="#"><input type="button" class="astext" onclick="completer_valeur_auteur('$pseudo')" name="" id="choix_auteur" value="{$pseudo}"></imput></a></li>
EOD;

                                       $compt += strlen($value['pseudo']);
                                     }
                                }
                         ?>
                           </ul>   
                        </div>
                        
<!-- Fin Fenêtre Auteur -->