<?php
	include "includes/en_tete.php";
?>

<!-- bannière -->
<section class="container-fluid banner">
    <div class="ban">
        <img src="image_accueil/banner.png" alt="bannière du site" />
    </div>
    <div class="inner-banner">
        <h1> Bienvenue sur <i>YouMark</i> </h1>
    </div>
</section>
<!-- fin bannière -->
 <div class="container-fluid">
            <div class="row content">
                <div class="col-md-8 col-sm-12">
		<ul id="main-nav">
			<li class="nouveaute"><a href="index.php">Nouveautés</a></li>
			<li class="populaire"><a href="populaire.php">Populaires</a></li>
			<li class="mieux_commente"><a href="mieux_commente.php">Plus<br>Commentés</a></li>
			<li class="current"><a href="mieux_note.php">Mieux Notés</a></li>
		</ul>
		<div class="clear"></div>
		<div id="featured">
			<div id="featured-content">
 <table class="table table-striped custab">

                                <!-- Dropdown -->
                                <div class="dropdown">
                                  <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Date d'ajout
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
																			<li><a href="mieux_note.php?date_ajout=0">Tous</a></li>
                                      <li><a href="mieux_note.php?date_ajout=1">Aujourd'hui</a></li>
                                      <li><a href="mieux_note.php?date_ajout=7">Cette semaine</a></li>
                                      <li><a href="mieux_note.php?date_ajout=30">Ce mois-ci</a></li>
                                      <li><a href="mieux_note.php?date_ajout=365">Cette année</a></li>
                                    </ul>
                                  </div>
                                  <!-- Fin Dropdown -->
                                  <table class="table table-filter">
                                            <tbody>
                                            <?php
																						if (isset($_GET["date_ajout"])) { $date_ajout  = $_GET["date_ajout"]; } else { $date_ajout=0; };

																						$limit=7;
                                            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
                                            $debut = ($page-1) * $limit;
																						$cmpt = $debut+1;
                                            $marque_page = $managerMarque_Page ->trie_par_note_pagination($debut,$limit,$date_ajout);
																						?>
																						
																							<?php
                                            foreach ($marque_page as $key => $value) {
                                              $createur_infos = $managerAjoute_Modifie->get_createur($value['id_marque_page']);
                                              echo "
                                              <tr>
                                                  <td>
                                                       <h3>". $cmpt ."</h3>
                                                  </td>

                                                  <td>
                                                       <div class='media'>
                                                       <a href='#' class='pull-left'>
                                                       <img src='includes/images/".$createur_infos['logo_choisi'].".png' alt='Photo Marque-Page' width='75' height='75' class='media-photo'>
                                                       </a>
                                                       <div class='media-body'>
                                                       <h4 class='title'><a style='color:blue;' href=".$value['url'].">".$value['titre']."</a> </h4>
                                                        <p class='description'>".$value['description']."</p>
                                                       <h5 style='font-style:italic;'> Soumis il y a ";

                                                       $managerMarque_Page->tempsEcoule($value['date_a']);

                                                       if($value['id_utilisateur'] != NULL ){
                                                         $auteur=$managerUtilisateur->get_par_Id($value['id_utilisateur']);
                                                         echo "par <a  style='color:blue;' href='auteur_list.php?auteur=".$auteur->getPseudo()."'>".$auteur->getPseudo().'</a>';
                                                       }
                                                       else{
                                                         echo " par anonyme";
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
                                            }
                                            ?>
																					
                                        </tbody>
                               </table>
                                </table>
																							<?php
																							$marque_pages_mieux_notes_en_entier = $managerMarque_Page->trie_par_note($date_ajout);
																							$total = count($marque_pages_mieux_notes_en_entier);
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
																									echo "<li class=\"$c\"><a href='mieux_note.php?page=".$i."'>".$i."</a></li>";
																								}
																								echo "</ul></nav>";

																							}
																							else{
																								echo "<nav><ul class='pagination'>";

																								if($page > 1){
																									echo "<li><a href='mieux_note.php?page=1'>Première</a></li>";
																									echo "<li><a href='mieux_note.php?page=".($page - 1)."'><<</a></li>";
																								}

																								for($i=$start_loop; $i<=$end_loop; $i++)
																								{
																									if($page==$i){$c="active";}else{$c="";}
																									echo "<li class=\"$c\"><a href='mieux_note.php?page=".$i."'>".$i."</a></li>";
																								}
																								if($page <= $end_loop)
																								{
																									echo "<li><a href='mieux_note.php?page=".($page + 1)."'>>></a></li>";
																									echo "<li><a href='mieux_note.php?page=".$total_pages."'>Suivant</a></li>";
																								}
																								echo "</ul></nav>";
																							}

																							?>


                                         </tbody>

                                </table>
                                </table>
			</div>
		</div>
		</div>


                      <?php
                      include "includes/partie_droite.php";
                      include "tags.php";
                      ?>