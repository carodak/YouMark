<?php

include "includes/en_tete.php";
include "fil_dariane.php";
echo fildariane("../ACCUEIL/index.php");
$utilisateur = $managerUtilisateur->get_par_Pseudo($_GET['auteur']);
								$id_utilisateur = $utilisateur->getID();

?>
<!-- contenu du site -->

<body>
 				<div class="col-md-4 col-sm-12 sidenav">
                      <!-- Fenêtre de compte de l'auteur -->
                      <div id="accountbox" style="margin-top:50px;" class="mainbox col-md-9 col-md-offset-2 col-sm-9 col-sm-offset-2">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">Profil de <?php echo  $utilisateur->getPseudo(); ?></div>
                                </div>
                                 <div style="padding-top:30px" class="panel-body">
                                  <img src=<?php echo "'".$utilisateur->getAvatar()."'"; ?> width=100 height=100 align="right"/>
                                  <b>Nombre de publications: <?php echo $managerMarque_Page->getNbMarquePageParCreateur($id_utilisateur); ?></b><br><br>
                                    <a href=mailto:<?php echo $utilisateur->getMail(); ?>><span><i id="social-em" class="fa fa-envelope-square fa-2x social">Contact</i></span></a><br>
                                  </div>
                           </div>
                      </div>


                        <!-- Fin Fenêtre de compte de l'auteur -->
                        <div id="levelbox" style="margin-top:10px;" class="mainbox col-md-9 col-md-offset-2 col-sm-9 col-sm-offset-2">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">Niveaux</div>
                                </div>
                                 <div style="padding-top:5px" class="panel-body">
                                 <?php $niveau = $managerUtilisateur->gestion_niveau($id_utilisateur);
                                 for($i = 1; $i <=$niveau; $i++){ ?>
                                  	<img src=<?php echo "includes/niveaux/".$i.".png"; ?> width=64 height=72 />
                                 <?php } ?>
                                  </div>
                           </div>
                      </div>
                    </div>
                </div>
            </div>
    <!-- page principale -->
        <div class="container-fluid">

         <div class="col-md-8">
		<div class="clear"></div>


	<table class="table table-striped custab">
 					<table class="table table-filter">



					    	<h2>Marques-Pages publiés par <?php echo $_GET['auteur']; ?></h2><br><br>
                              <?php
								$limit=7;

								if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
								$debut = ($page-1) * $limit;
								$cmpt = $debut+1;
								$marque_page = $managerMarque_Page->getListMarquePageParCreateurAvecDesc($id_utilisateur,$debut, $limit);


				                if(empty($marque_page)){

				                  ?>
								  <div class="alert alert-warning">
								  		<a href="index.php" class="btn btn-xs btn-warning pull-right">Retour à l'accueil</a>
								        <strong>ATTENTION:</strong> Aucun marque-page n'a été publié par cet auteur !
								    </div>
				                  <?php

				                }


                              foreach ($marque_page as $key => $value) {
                                echo "
                                <tr>
						                          <td>
						                               <h3>". $cmpt ."</h3>
					                            </td>

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
                                                       	echo "<a href=clic_tag.php?label_tag=".rawurlencode($value2['label'])." class='btn btn-xs btn-primary'>".$value2['label']."</a>  ";
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
                              </div>
                            </td>
				                        </tr>";
                                $cmpt += 1;
                              };
                              ?>
										</table>
												<?php
												$marque_pages_en_entier = $managerMarque_Page->getListMarquePageParCreateurPagination();
												$total = count($marque_pages_en_entier);
									$total_pages = ceil($total / $limit);

									$start_loop = $page;
									$difference = $total_pages - $page;
									if($difference <= 5)
    							{
     								$start_loop = $total_pages - 5;
    							}
									$end_loop = $start_loop + 4;

									$c="active";
									if($total_pages <= 5){
										echo "<nav><ul class='pagination'>";

										for($i=1; $i<=$total_pages; $i++){
											if($page==$i){$c="active";}else{$c="";}
											echo "<li class=\"$c\"><a href='auteur_list.php?page=".$i."'>".$i."</a></li>";
										}
										echo "</ul></nav>";

									}
									else{
										echo "<nav><ul class='pagination'>";

										if($page > 1){
											echo "<li><a href='auteur_list.php.php?page=1'>Première</a></li>";
											echo "<li><a href='auteur_list.php.php?page=".($page - 1)."'><<</a></li>";
										}

										for($i=$start_loop; $i<=$end_loop; $i++)
										{
											if($page==$i){$c="active";}else{$c="";}
											echo "<li class=\"$c\"><a href='auteur_list.php.php?page=".$i."'>".$i."</a></li>";
										}
										if($page <= $end_loop)
										{
											echo "<li><a href='auteur_list.php.php?page=".($page + 1)."'>>></a></li>";
											echo "<li><a href='auteur_list.php.php?page=".$total_pages."'>Suivant</a></li>";
										}
										echo "</ul></nav>";
									}
									?>


					</table>

					</table>
					</div>
					</div>
					</div>





            <!-- footer -->
    <footer class="container-fluid footer">
      <div class="container" style="margin-top: 25px;">
         <div class="row">
             <legend></legend>
             <p>© Copyright 2017. <i>YouMark</i>. Tous droits réservés.
               <span class="pull-right"><a href="contact_footer.php">Contact</a></span></p>
              </div>


    </footer>
    <!-- fin footer -->
