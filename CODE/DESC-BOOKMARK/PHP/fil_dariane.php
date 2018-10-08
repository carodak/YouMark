<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

function fildariane($chemin){

$cheminFilDariane = array(
    'accueil' => array('index.php', 'ACCUEIL', ''),
    'parametres' => array('parametres.php', 'Mes informations', 'accueil'),
    'contact_footer' => array('contact_footer.php', 'Contactez-Nous!', 'accueil'),
    'liste_tags' => array('tags_list.php', 'La liste des tags', 'accueil'),
    'tag' => array('clic_tag.php', 'Nom Tag', 'liste_tags'),
    'liste_utilisateurs' => array('utilisateur_list.php', 'La liste des utilisateurs', 'accueil'),
    'auteur_mp' => array('auteur_list.php', 'Marque-page Auteur', 'liste_utilisateurs'),
    'mes_favoris' => array('mes_favoris.php', 'Mes Favoris', 'accueil'),
    'resultats_recherche' => array('resultats_recherche.php', 'Resultats Recherche', 'accueil'),
    'add' => array('add.php', 'Ajout Marque-Page', 'accueil'),
    'marque-page' => array('indx.php', 'Marque-Page', 'accueil'),
    'inscription' => array('inscription.php', 'Inscription', 'accueil'),
    'modifier_marque_page' => array('modifier_marque_page.php', 'Modifier Marque-Page', 'accueil'),
    'commentaires' => array('commentaires.php', 'Commentaires', 'marque-page'),
    'contact' => array('contact.php', 'Signaler', 'marque-page'),
);

?>
 <div class="container-full">
 <div class="scp-breadcrumb">
         <ol class="breadcrumb breadcrumb-arrow">
             <li><a href=<?php echo $chemin ?>><i class="glyphicon glyphicon-home" style="width:30px; height:1px;"> </i></a></li>

 <?php
 	$filDariane = $_SERVER['PHP_SELF'];
 	if($filDariane != '') {
 		$toks = explode('/', $filDariane);
    $chemin = array();
    foreach($cheminFilDariane as $key => $value){
      if($toks[count($toks)-1] == $value[0]){
          array_push($chemin,$key);
          $parcours = $value[2];
          while($parcours != 'accueil'){
            array_push($chemin,$parcours);
            $parcours = $cheminFilDariane[$parcours][2];
          }
      }
    }

    while(count($chemin)!=1){
      $val = array_pop($chemin);
      echo "<li><a href=".$cheminFilDariane[$val][0].">".$cheminFilDariane[$val][1]."</a></li>";
    }
    $valcourant = array_pop($chemin);
    switch ($valcourant) {
      case 'tag':
        echo "<li class='active'><span>".$_GET['label_tag']."</span></li>";
        break;

      case 'auteur_mp':
        echo "<li class='active'><span>".$_GET['auteur']."</span></li>";
        break;

      case 'resultats_recherche':
        echo "<li class='active'><span>Resultats recherche pour << ".$_POST['contenu_recherche'].">></span></li>";
        break;

      default:
        echo "<li class='active'><span>".$cheminFilDariane[$valcourant][1]."</span></li>";
        break;
    }
  }
?>
</ol>
</div>
</div>
<?php
}
?>
