<?php

          /*-----INCLUDES
            Connexion à la bdd (déjà incluse dans preview_recherche_ac.php)
            Marque_Page_Manager -> méthode de recherche
            Tag_Manager -> méthode de recherche (déjà incluse dans preview_recherche_tg.php)
            Utilisateur_Manager -> méthode de recherche (déjà incluse dans preview_recherche_ac.php)
           */

          include '../CLASSES/PHP/Marque_Page_Manager.php';
          

          /*----------CAS DE LA PREMIERE RECHERCHE (simple)    */

          if (!empty ($_POST['envoi_form1']) ) {
            $contenu_recherche=htmlspecialchars($_POST["contenu_recherche"]);
            $_SESSION['contenu_recherche'] = $contenu_recherche; //Sauvegarde dans une variable de session pour conserver les résultats afin de pouvoir faire une recherche avancée

            /*
            On effectue une recherche dans la BDD parmi les titres, tag, url, pseudo
            Note: la recherche n'est pas exacte, on peut trouver un titre qui contient le mot qu'on a tapé mais qui est différent
           */

            $mp_manager = new Marque_Page_Manager($db);
            $resultat_titre = $mp_manager->rechercheTitre($contenu_recherche);

            $tag_manager = new Tag_Manager($db);
            $resultat_tag = $tag_manager->rechercheLabel($contenu_recherche);

            $utilisateur_manager = new Utilisateur_Manager($db);
            $resultat_utilisateurs = $utilisateur_manager->recherchePseudo($contenu_recherche);

            $total_nb_resultat = $resultat_titre['nombre_titre']+$resultat_tag['nombre_tag']+$resultat_utilisateurs['nombre_pseudo'];
          }

          /*-----CAS RECHERCHE AVANCEE---
          */
          else if(!empty ($_POST['envoi_form2'])) {
            $contenu_recherche=$_SESSION['contenu_recherche'];


            /*-------Si les dates ne sont pas spécifiées dans la recherche avancée alors les dates sont automatiquement mises à la date du jour actuel
            Cela pose problème car on recherche alors automatiquement un marque-page ayant été créé ou modifié entre la date actuelle et la date actuelle (jamais de résultat)
            Pour résoudre ce problème, on détecte cette erreur et on met la chaine de caractère représentant la date vide*/
            $date = new DateTime(); 
            $date_ = htmlspecialchars($_POST['date1_av']); 
            $date_sec = htmlspecialchars($_POST['date2_av']); 
            $d1 = new DateTime($date_);
            $d2 = new DateTime($date_sec);
            $interval = $date->diff($d1);
            $interval2 = $date->diff($d2);
            
            if($interval->days == 0 && $interval2->days == 0) {
              $d1 = '';
              $d2 = ''; 
            }

            /*--- Cas où l'on a cliqué sur la recherche avancée mais que l'on a rien renseigné -> recherche simple ----*/
            if (empty ($_POST['auteur_av']) && empty ($_POST['url_av']) && empty ($_POST['tag_av']) && $d1=='' && $d2=='' ){
              $mp_manager = new Marque_Page_Manager($db);
              $resultat_titre = $mp_manager->rechercheTitre($contenu_recherche);

              $tag_manager = new Tag_Manager($db);
              $resultat_tag = $tag_manager->rechercheLabel($contenu_recherche);

              $utilisateur_manager = new Utilisateur_Manager($db);
              $resultat_utilisateurs = $utilisateur_manager->recherchePseudo($contenu_recherche);

              $total_nb_resultat = $resultat_titre['nombre_titre']+$resultat_tag['nombre_tag']+$resultat_utilisateurs['nombre_pseudo'];
            }

            else{

              $titre=$contenu_recherche; 
              $pseudo=htmlspecialchars($_POST['auteur_av']);
              $url=htmlspecialchars($_POST["url_av"]);
              $label=htmlspecialchars($_POST["tag_av"]);
              $tab_tags = explode(";", $label); //On créé un tableau de tags (au cas où l'utilisateur est renseigné plusieurs tags)
              echo sizeof($tab_tags);
              if(sizeof($tab_tags)>2){
                if($tab_tags[sizeof($tab_tags)-1]==';'){
                  unset($tab_tags[sizeof($tab_tags)-1]);//On supprime le dernier ; qui est inutile
                }
                for($i=0;$i<sizeof($tab_tags);$i++){ //On va rajouter au début et à la fin de chaque mot=tag du tableau '' ->'tag1' 'tag2'... afin de pouvoir faire un FOR IN
                  $tab_tags[$i]="'".$tab_tags[$i]."'";
                }
                $tags = implode(",", $tab_tags); //On rajoute une virgule entre les tags on obtient -> 'tag1','tag2','tag3' ...    
              }

              else if (sizeof($tab_tags)==2 && $tab_tags[1]==';'){ //cas où l'on a cliqué sur un seul tag -> il faut supprimer le ";" et lancer la recherche avec un seul tag
                unset($tab_tags[sizeof($tab_tags)-1]);//On supprime le dernier ; qui est inutile
              }

              else if(sizeof($tab_tags)==2 && $tab_tags[1]!=';'){
                for($i=0;$i<sizeof($tab_tags);$i++){ //On va rajouter au début et à la fin de chaque mot=tag du tableau '' ->'tag1' 'tag2'... afin de pouvoir faire un FOR IN
                  $tab_tags[$i]="'".$tab_tags[$i]."'";
                }
                $tags = implode(",", $tab_tags); //On rajoute une virgule entre les tags on obtient -> 'tag1','tag2','tag3' ...    
              }
              
              $popularite=htmlspecialchars($_POST['options']); 

              /*---- Si un intervalle de dates n'est pas spécifié, pas besoin de convertir les dates en chaine de caractère ----*/
              if ($d1=='' && $d2==''){
                $date1=$d1;
                $date2=$d2;
              }

              else{
              

                /*----Conversion des dates en chaine de caractère afin de pouvoir faire une comparaison dans la requete sql -------*/
                
                $date1 = $d1->format('Y-m-d');
                if(!$date1) { // Problème date
                  echo "Problème dates";
                }

                $date2 = $d2->format('Y-m-d');  
                if(!$date2) { // Problème date
                  echo "Problème dates";
                }
              }
            
              /*---------Appel au méthodes de classes pour faire la recherche
                Si l'on a plusieurs tags, on appelle des méthodes différentes ---------*/

              if (sizeof($tab_tags)<=1){

                $mp_manager = new Marque_Page_Manager($db);
                $resultat_titre = $mp_manager->rechercheAvanceeTitre($contenu_recherche,$date1,$date2,$pseudo,$url,$tab_tags[0],$popularite);

                $tag_manager = new Tag_Manager($db);
                $resultat_tag = $tag_manager->rechercheAvanceeLabel($tab_tags[0],$date1,$date2,$pseudo,$url,$popularite);

                $utilisateur_manager = new Utilisateur_Manager($db);
                $resultat_utilisateurs = $utilisateur_manager->rechercheAvanceePseudo($contenu_recherche,$date1,$date2, $url,$tab_tags[0],$popularite);
              }

              else{
                $mp_manager = new Marque_Page_Manager($db);
                $resultat_titre = $mp_manager->rechercheAvanceeTitrePlusieursTags($contenu_recherche,$date1,$date2,$pseudo,$url,$tags,$popularite);

                $tag_manager = new Tag_Manager($db);
                $resultat_tag = $tag_manager->rechercheAvanceeLabelPlusieursTags($tags,$date1,$date2,$pseudo,$url,$popularite);

                $utilisateur_manager = new Utilisateur_Manager($db);
                $resultat_utilisateurs = $utilisateur_manager->rechercheAvanceePseudoPlusieursTags($contenu_recherche,$date1,$date2, $url,$tags,$popularite);
              }

              $total_nb_resultat = $resultat_titre['nombre_titre']+$resultat_tag['nombre_tag']+$resultat_utilisateurs['nombre_pseudo'];
            }

          }     




         //On affiche le nombre de résultats par catégorie de recherche

        echo"
        
              <h2 class='lead'><strong class='text-danger'>$total_nb_resultat</strong> résultats contenants <strong class='text-danger'>$contenu_recherche</strong> ont été trouvé ({$resultat_titre['nombre_titre']} titres, {$resultat_tag['nombre_tag']} tags, {$resultat_utilisateurs['nombre_pseudo']} pseudos)</h2>
        ";

//On affiche dans un encadré bleu les différents résultats pour les titres
        echo"<div class='mine2'>
        <div class='container'>
            <div class='row'>
                <div class='row col-md-8 col-sm-12'>
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Titres</h3>
                    </div>
                    <div class='panel-body'>
        ";
  //On affiche les résultats de la recherche pour les titres
        foreach($db->query($resultat_titre['requete_titre']) as $row){
          echo"
                        <div class='col-md-6 col-sm-6 col-xs-6'>
                            <a href='../DESC-BOOKMARK/PHP/indx.php?id_marque_page=".$row['id_marque_page']."' class='thumbnail'>
                              <div class='col-md-12'>
                                <img src='includes/images/".$row['logo_choisi'].".png' alt='Photo Marque-Page' width='75' height='75' class='media-photo'>
                              </div>
                              <div class='col-md-12'>
                                <ul>
                                  <li> {$row['titre']} </li>
                                  <li> {$row['description']} </li>
                                  <li> {$row['pseudo']} </li>
                                </ul>
                              </div>
                            </a>
                        </div>

                        
                        ";
        }

  //On affiche dans un encadré bleu les différents résultats pour les tags
    echo"
                    </div>
                </div>
            </div>
        </div>

            <div class='row'>
                <div class='row col-md-8 col-sm-12'>
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Tags</h3>
                    </div>
                    <div class='panel-body'>
                      <div class='tagcloud'>
                        <ul>";


  //On affiche les résultats de la recherche pour les tags
  foreach($db->query($resultat_tag['requete_tag']) as $row){   
      echo"
           <li><a href=clic_tag.php?label_tag=".rawurlencode($row['label'])." class='btn btn-xs btn-primary'>".$row['label']."<span>{$row['label']}</span></a></li>
       ";
   }

        echo"
                          </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> ";

//On affiche dans un encadré bleu les différents résultats pour les pseudos

        echo"
            <div class='row'>
                <div class='row col-md-8 col-sm-12'>
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Pseudos</h3>
                    </div>
                    <div class='panel-body'>";


  //On affiche les résultats de la recherche pour les pseudos

  foreach($db->query($resultat_utilisateurs['requete_pseudo']) as $row){           
        echo"
                        <div class='col-md-6 col-sm-6 col-xs-6'>
                            <a href='auteur_list.php?auteur=".$row['pseudo']."' data-toggle='popover' data-title='<center><b>".$row['pseudo']."</b></center>' data-content='<b>Niveau:</b> {$row['niveau']}' class='thumbnail'>
                              <div class='col-md-12'>
                                <img class='img-rounded zoom' src= '".$row['avatar']."'alt='Photo de Profil' height='60' width='60' zoom/>
                              </div>
                              <div class='col-md-12'>
                                <ul>
                                  <li> {$row['pseudo']} </li>
                                  <li> Niveau: {$row['niveau']} </li>
                                  <li> Marque-pages postés: {$utilisateur_manager->nbMarquePage($row['id'])} </li>
                                </ul>
                              </div>
                            </a>
                        </div>";
  }

                        
        echo"           
                    </div>
                </div>
            </div>
        </div>
        </div></div>
        </body>
        </html>";
    

?>
