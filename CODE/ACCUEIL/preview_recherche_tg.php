 <!-- Fenêtre Tag -->
                        
                          

                          <div class = "p2">
                            <ul class="cloud">
                          <?php
                          include '../CLASSES/PHP/Tag_Manager.php';
                            $tag_manager1 = new Tag_Manager($db);
                            $tag = $tag_manager1->count_occurrence();
                                $max= 130;
                                $compt=0;
                                
                                foreach ($tag as $key => $value) {
                                     if($compt+strlen($value['label'])<=$max){
                                      $label = $value["label"];
echo <<<EOD
                                  <li><a href="#"><input type="button" class="astext" onclick="completer_valeur_tag('$label')" name="" id="choix_tag" value="{$label}"></imput></a></li>
EOD;
$compt += strlen($value['label']);

                                     }
                                }
                         ?>
                           </ul>   
                        </div>
                        
<!-- Fin Fenêtre Tag -->

