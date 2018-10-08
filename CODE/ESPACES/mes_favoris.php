
<!DOCTYPE html>
<html>

<head>
    <meta <charset="utf-8">
    <title> Mes Favoris </title>

    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/accueil_bootstrap.css" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
      <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<!-- contenu du site -->

<body>

<?php

  include "includes/en_tete.php";
  include "../ACCUEIL/fil_dariane.php";
  echo fildariane("../ACCUEIL/index.php");

$pseudo = $_GET['utilisateur'];
  /***Recuperation des informations de l'utilisateur par le biai du cookie stockant le pseudo de l'utilisateur***/
$utilisateur = $managerUtilisateur->get_par_Pseudo($pseudo);
$id_utilisateur = $utilisateur->getID();

?>

<!-- contenu du site -->

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
                    <li><a href="../AJOUTER-MARQUE-PAGE/HTML-CSS/add.html">Ajouter un bookmark</a></li>
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

                <h2>Mes Favoris</h2><br><br>

                <?php
                if(isset($_GET['modification'])){ ?>
                	<div class="alert alert-success">
                     <strong>Modifications confirmées : </strong>Le marque-page a bien été modifié !
                    </div>
                <?php }
                $limit=7;
                if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
                $debut = ($page-1) * $limit;
                $cmpt = $debut+1;
                $utilisateur = $managerUtilisateur->get_par_Pseudo($_GET['utilisateur']);
                $id_utilisateur = $utilisateur->getID();
                $marque_page = $managerMarque_Page->getListMarquePageParCreateurAvecDesc($id_utilisateur,$debut, $limit);

                if(empty($marque_page)){

                  ?>
  <div class="alert alert-warning">
        <a href="../AJOUTER-MARQUE-PAGE/HTML-CSS/add.php" class="btn btn-xs btn-warning pull-right">Ajouter un Bookmark</a>
        <strong>ATTENTION:</strong> Vous n'avez aucun favoris.
    </div>
                  <?php

                }

                else{
                  if(isset($_GET ['supprimer'])){
                    $id_utilisateur = $_GET['id_utilisateur'];
                    $id_marque_page = $_GET['id_marque_page'];
                    $date_a = $_GET['date_a'];

                    $managerAjoute_Modifie->supprime($id_marque_page, $id_utilisateur, $_GET['date_a']);

                    ?>
                      <div class="alert alert-success">
                        <strong>Confirmation:</strong> Le marque-page a été supprimé de vos favoris !
                      </div>

                    <?php

                  }

                  echo '<table class="table table-filter">';
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
                              <a href='modifier_marque_page.php?id_marque_page=".$value['id_marque_page']."&id_utilisateur=".$value['id_utilisateur']."&date_a=".$value['date_a']."&utilisateur=".$pseudo."' class='btn btn-primary' ><span class='glyphicon glyphicon-pencil pull-right'alt='Modifier'></span></a>



                              <a href='mes_favoris.php?supprimer=OK&id_marque_page=".$value['id_marque_page']."&date_a=".$value['date_a']."&id_utilisateur=".$value['id_utilisateur']."&utilisateur=".$pseudo."' class='btn btn-danger'><span class='glyphicon glyphicon-remove pull-right' alt='Supprimer'></span></a>
                              </div>
                            </td>
                                </tr>";
                                $cmpt += 1;
                              }
                              echo "</table>";
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
                      echo "<li><a href='mes_favoris.php?page=1'>Première</a></li>";
                      echo "<li><a href='mes_favoris.php?page=".($page - 1)."'><<</a></li>";
                    }

                    for($i=$start_loop; $i<=$end_loop; $i++)
                    {
                      if($page==$i){$c="active";}else{$c="";}
                      echo "<li class=\"$c\"><a href='mes_favoris.php?page=".$i."'>".$i."</a></li>";
                    }
                    if($page <= $end_loop)
                    {
                      echo "<li><a href='mes_favoris.php?page=".($page + 1)."'>>></a></li>";
                      echo "<li><a href='mes_favoris.php?page=".$total_pages."'>Suivant</a></li>";
                    }
                    echo "</ul></nav>";
                  }
                }
                  ?>

</tbody>
          </table>

          </table>
          </div>
          </div>
          </div>

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
               <span class="pull-right"><a href="contact_footer.php">Contact</a></span></p>
              </div>
            </div>

    </footer>
    <!-- fin footer -->
