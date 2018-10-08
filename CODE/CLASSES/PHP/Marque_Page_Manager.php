<?php

class Marque_Page_manager
{
  private $db; // Instance de PDO

    public function __construct($db){
      $this->setDb($db);
    }

  //ajoute un marque-page à la base de donnée
    public function ajoute(Marque_page $marque_page){
      $query=$this->db->prepare('INSERT INTO marque_page( url, titre) VALUES( :url, :titre)');

      $query->bindValue(':url', $marque_page->getUrl());
      $query->bindValue(':titre', $marque_page->getTitre());
      $query->execute();
    }

    
  //compte le nombre de marque-page
    public function count(){
      return $this->db->query('SELECT COUNT(*) FROM marque_page')->fetchColumn();
    }

  //supprime un marque-page
    public function supprime(Marque_page $marque_page){
      $this->db->exec('DELETE FROM marque_page WHERE id = '.$marque_page->getId());
    }

    public function existe($url)
    {
    // On veut voir si le marque-page ayant pour url $url existe
    
      return (int) ($this->db->query('SELECT COUNT(*) FROM marque_page WHERE url = "'.$url.'"')->fetchColumn());
    
    }

  //Renvoie un marque-page ayant pour id $num
  public function get_Par_Id($num)
  {
      $query = $this->db->query('SELECT * FROM marque_page WHERE id = '.$num);
      $donnees = $query->fetch(PDO::FETCH_ASSOC);

      return new Marque_page($donnees);

  }

  //renvoie un tableau de données étant le resultat de la jointure entre la table marque_page et ajoute_modifie
  public function get_Par_ID_Ajoute_M($num){
      $query = $this->db->query('SELECT date_a, date_m, description, id_utilisateur, note, somme, logo_choisi, id_marque_page, titre, url, createur FROM ajoute_modifie, marque_page WHERE id_marque_page = id AND id_marque_page ='.$num);
      $donnees = $query->fetch(PDO::FETCH_ASSOC);
      return $donnees;
  }

  // Retourne la liste des marques pages publiés par l'utilisateur avec l'id $id */
  public function getListMarquePageParCreateur($id){
    $marque_page = [];

    $query = $this->db->prepare('SELECT m.id, m.url, m.titre, m.note, m.somme FROM marque_page m, ajoute_modifie am
      WHERE m.id = am.id_marque_page AND am.id_utilisateur = :id_utilisateur AND createur = 1 ORDER BY m.titre');
    $query->execute([':id_utilisateur' => $id]);

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $marque_page[] = new Marque_page($donnees);
    }

    return $marque_page;
  }

  public function getListMarquePageParCreateurAvecDesc($id, $debut, $limit){
    $marque_page = [];

    $query = $this->db->prepare('SELECT date_a, date_m, description, id_utilisateur, m.note, somme, logo_choisi, am.id_marque_page, titre, url, createur FROM marque_page m, ajoute_modifie am
      WHERE m.id = am.id_marque_page AND am.id_utilisateur = :id_utilisateur AND createur = 1  AND type_droit = 1 ORDER BY m.titre DESC LIMIT '.$debut.' ,'.$limit);
    $query->execute([':id_utilisateur' => $id]);

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $marque_page[] = $donnees; 
    }

    return $marque_page;
  }

   public function getListMarquePageParCreateurAvecDescPrive($id, $debut, $limit){
    $marque_page = [];

    $query = $this->db->prepare('SELECT date_a, date_m, description, id_utilisateur, m.note, somme, logo_choisi, am.id_marque_page, titre, url, createur FROM marque_page m, ajoute_modifie am
      WHERE m.id = am.id_marque_page AND am.id_utilisateur = :id_utilisateur AND createur = 1 ORDER BY m.titre DESC LIMIT '.$debut.' ,'.$limit);
    $query->execute([':id_utilisateur' => $id]);

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $marque_page[] = $donnees; 
    }

    return $marque_page;
  }

   public function getListMarquePageParCreateurPagination(){
    $marque_page = [];

    $query = $this->db->prepare('SELECT date_a, date_m, description, id_utilisateur, note, somme, logo_choisi, id_marque_page, titre, url, createur FROM ajoute_modifie, marque_page WHERE id_marque_page = id AND createur=1 ORDER BY titre');
    $query->execute();

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $marque_page[] = $donnees;
    }
    return $marque_page;
  }

public function getListMarquePageParCreateurPaginationPrive(){
    $marque_page = [];

    $query = $this->db->prepare('SELECT date_a, date_m, description, id_utilisateur, note, somme, logo_choisi, id_marque_page, titre, url, createur FROM ajoute_modifie, marque_page WHERE id_marque_page = id AND createur=1 ORDER BY titre');
    $query->execute();

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $marque_page[] = $donnees;
    }
    return $marque_page;
  }


  // Retourne le nombre de marques pages publiés par l'utilisateur ayant l'id $id */
  public function getNbMarquePageParCreateur($id){
      $sql4= "SELECT * FROM ajoute_modifie WHERE id_utilisateur=$id AND createur = 1";
      $req4= $this->db->prepare($sql4);
      $req4->execute(); //On réalise la requete
      $row4 = $req4->fetchAll();
      $nbr4=count($row4); //Le nombre de résultats trouvés
      return $nbr4;
  }

  //Modifie les attributs du marque-page
  public function update(Marque_page $marque_page)
  {
    $query = $this->db->prepare('UPDATE marque_page SET (url = :url, titre = :titre, note = :note, somme =:somme) WHERE id = :id');

      $query->bindValue(':url', $marque_page->getUrl());
      $query->bindValue(':titre', $marque_page->getTitre());
      $query->bindValue(':note', $marque_page->getNote());
      $query->bindValue(':somme', $marque_page->getSomme());
      $query->execute();
  }

      //Mets à jour la somme d'un marque page 
  public function updateSomme($id,$somme)
  {
    $query = $this->db->prepare('UPDATE marque_page SET somme =:somme WHERE id = :id');
      
      $query->bindValue(':id', $id);
      $query->bindValue(':somme', $somme);
      $query->execute();
  }

    //Obtient le dernier ID inséré dans la table marque page

    public function getLatest()
  {
    $query = $this->db->query('SELECT MAX(id) FROM marque_page');
    $res = $query->fetchColumn();
    return  (int) $res;
  }

  public function setDb(PDO $db)
  {
    $this->db = $db;
  }

  //On recherche les marques pages ayant le titre $titre (createur = 1 si utilisateur a créé le marque_page)
   public function rechercheTitre($titre){
      $sql1= "SELECT * FROM marque_page,ajoute_modifie,utilisateur WHERE marque_page.id=ajoute_modifie.id_marque_page and utilisateur.id=ajoute_modifie.id_utilisateur and createur=1 and titre LIKE '%$titre%' ORDER BY titre asc";
      $req1= $this->db->prepare($sql1);
      $req1->execute(); //On réalise la requete
      $row1 = $req1->fetchAll();
      $nbr1=count($row1); //Le nombre de résultats trouvés

      return array('nombre_titre' => $nbr1,'requete_titre' => $sql1);
  }

   //On recherche les marques pages ayant l'URL...
   public function rechercheUrl($url){
      $sql3= "SELECT * FROM marque_page WHERE url LIKE '%$url%'";
      $req3= $this->db->prepare($sql3);
      $req3->execute(); //On réalise la requete
      $row3 = $req3->fetchAll();
      $nbr3=count($row3); //Le nombre de résultats trouvés

      return array('nombre_url' => $nbr3,'requete_url' => $sql3);
  }


  //Trie les marque-page par ordre descroissant de date_a
  public function trie_par_date($date_ajout){
    $marque_page = [];
    if($date_ajout==0){
      $query = $this->db->prepare('SELECT date_a, date_m, description, id_utilisateur, note, somme, logo_choisi, id_marque_page, titre, url, createur FROM ajoute_modifie, marque_page WHERE id_marque_page = id AND createur=1  ORDER BY date_a DESC');
    }else{
      $query = $this->db->prepare('SELECT date_a, date_m, description, id_utilisateur, note, somme, logo_choisi, id_marque_page, titre, url, createur FROM ajoute_modifie, marque_page WHERE id_marque_page = id AND createur=1  AND date_a >= ( CURDATE() - INTERVAL '.$date_ajout.' DAY ) ORDER BY date_a DESC');
    }
    $query->execute();

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $marque_page[] = $donnees;
    }
    return $marque_page;
  }

  //retourne l'id de l'utilisateur qui a crée le marque page
  public function get_createur($num){

    return $this->db->query('SELECT id_utilisateur FROM ajoute_modifie, marque_page WHERE id_marque_page = id AND createur=1 AND id_marque_page = '.$num)->fetchColumn();

  }

  public function trie_par_date_pagination($debut,$limit,$date_ajout){
    $marque_page = [];
    if($date_ajout==0){
      $query = $this->db->prepare('SELECT date_a, date_m, description, id_utilisateur, note, somme, logo_choisi, id_marque_page, titre, url, createur,type_droit FROM ajoute_modifie, marque_page WHERE id_marque_page = id AND type_droit = 1 AND createur=1 ORDER BY date_a DESC LIMIT '.$debut.' ,'.$limit);
    }else{
      $query = $this->db->prepare('SELECT date_a, date_m, description, id_utilisateur, note, somme, logo_choisi, id_marque_page, titre, url, createur,droit FROM ajoute_modifie, marque_page WHERE id_marque_page = id AND createur=1  AND type_droit = 1 AND date_a >= ( CURDATE() - INTERVAL '.$date_ajout.' DAY ) ORDER BY date_a DESC LIMIT '.$debut.' ,'.$limit);
    }
    $query->execute();

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $marque_page[] = $donnees;
    }
    return $marque_page;
  }

  //Trie les marque-page par note obtenu
  public function trie_par_note($date_ajout){
    $marque_page = [];
    if($date_ajout==0){
      $query = $this->db->prepare('SELECT date_a, date_m, description, id_utilisateur, note, somme, logo_choisi, id_marque_page, titre, url, createur,type_droit FROM ajoute_modifie, marque_page WHERE id_marque_page = id AND createur=1 AND type_droit = 1 ORDER BY note DESC');
    }else{
      $query = $this->db->prepare('SELECT date_a, date_m, description, id_utilisateur, note, somme, logo_choisi, id_marque_page, titre, url, createur,type_droit FROM ajoute_modifie, marque_page WHERE id_marque_page = id AND createur=1  AND type_droit = 1 AND date_a >= ( CURDATE() - INTERVAL '.$date_ajout.' DAY ) ORDER BY note DESC');
    }
    $query->execute();

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $marque_page[] = $donnees;
    }
    return $marque_page;
  }

  public function trie_par_note_pagination($debut, $limit, $date_ajout){
    $marque_page = [];
    if($date_ajout==0){
      $query = $this->db->prepare('SELECT date_a, date_m, description, id_utilisateur, note, somme, logo_choisi, id_marque_page, titre, url, createur, type_droit FROM ajoute_modifie, marque_page WHERE id_marque_page = id AND createur=1 AND type_droit = 1 ORDER BY note DESC LIMIT '.$debut.' ,'.$limit);
    }else{
      $query = $this->db->prepare('SELECT date_a, date_m, description, id_utilisateur, note, somme, logo_choisi, id_marque_page, titre, url, createur,type_droit FROM ajoute_modifie, marque_page WHERE id_marque_page = id AND createur=1 AND type_droit = 1 AND date_a >= ( CURDATE() - INTERVAL '.$date_ajout.' DAY ) ORDER BY note DESC LIMIT '.$debut.' ,'.$limit);
    }
    $query->execute();

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $marque_page[] = $donnees;
    }
    return $marque_page;
  }

  public function trie_meilleures_notes_derniers30jrs(){
    $marque_page = [];

    $query = $this->db->prepare('SELECT date_a, date_m, description, id_utilisateur, note, somme, logo_choisi, id_marque_page, titre, url, createur,type_droit FROM ajoute_modifie, marque_page WHERE id_marque_page = id AND type_droit = 1 AND createur=1 AND date_a >= ( CURDATE() - INTERVAL 30 DAY ) ORDER BY note DESC');
    $query->execute();

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $marque_page[] = $donnees;
    }
    return $marque_page;
  }

  public function trie_meilleures_notes_derniers30jrs_pagination($debut, $limit){
    $marque_page = [];

    $query = $this->db->prepare('SELECT date_a, date_m, description, id_utilisateur, note, somme, logo_choisi, id_marque_page, titre, url, createur,type_droit FROM ajoute_modifie, marque_page WHERE id_marque_page = id AND type_droit = 1 AND createur=1 AND date_a >= ( CURDATE() - INTERVAL 30 DAY ) ORDER BY note DESC LIMIT '.$debut.' ,'.$limit);
    $query->execute();

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $marque_page[] = $donnees;
    }
    return $marque_page;
  }

  public function tempsEcoule($d){
    $date = new DateTime();
    $date_mp = new DateTime($d);
    $diff = $date->diff($date_mp);
    if($diff->y>0){
      if($diff->y==1){ echo $diff->y.' année '; }
      else{ echo $diff->y.' années '; }}
    else if($diff->m>0){
      echo $diff->m.' mois ';}
    else if($diff->d>0){
      if($diff->d==1){ echo $diff->d.' jour '; }
      else{ echo $diff->d.' jours ';}}
    else if($diff->h>0){
      if($diff->h==1){ echo $diff->h.' heure '; }
      else{ echo $diff->h.' heures ';}}
    else if($diff->i>0){
        if($diff->i==1){ echo $diff->i.' minute '; }
        else{ echo $diff->i.' minutes ';}}
    else {
        if($diff->s==1){ echo $diff->s.' seconde '; }
        else{ echo $diff->s.' secondes ';}}
  }

  public function getListMarquePageParTagPagination($label, $debut, $limit){
   $marque_page = [];

   $query = $this->db->prepare("SELECT date_a, date_m, description, am.id_utilisateur, m.note, somme, logo_choisi, am.id_marque_page, titre, url, createur,type_droit FROM marque_page m, ajoute_modifie am, tag t
     WHERE m.id = am.id_marque_page AND m.id = t.id_marque_page AND type_droit = 1 AND createur = 1 AND t.label LIKE '%$label%' ORDER BY m.titre DESC LIMIT ".$debut." ,".$limit);
   $query->execute();

   while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
     $marque_page[] = $donnees;
   }

   return $marque_page;
 }

 public function getListMarquePageParTag($label){
   $marque_page = [];

   $query = $this->db->prepare("SELECT date_a, date_m, description, am.id_utilisateur, m.note, somme, logo_choisi, am.id_marque_page, titre, url, createur, type_droit FROM marque_page m, ajoute_modifie am, tag t
     WHERE m.id = am.id_marque_page AND m.id = t.id_marque_page AND type_droit = 1 AND createur = 1 AND t.label LIKE '%$label%' ORDER BY m.titre");
   $query->execute();

   while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
     $marque_page[] = $donnees;
   }

   return $marque_page;
 }

public function rechercheAvanceeTitre($contenu_recherche,$date1,$date2,$pseudo,$url,$label,$popularite){
    /*
     On utilise les LEFT JOIN qui permettent de lister les enregistrements de table1 même s’il n’y a pas de correspondance avec table2

     Recherche parmi les titres précedemment sélectionnés par la recherche simple ceux :
      - qui ont été créé / modifié par un utilisateur ayant le pseudo $pseudo
      - qui ont été créé / modifié à une date comprise entre $date1 et $date2
      - qui ont une url ressemblant à $url
      - qui ont un label contenant $label
      - qui ont une note >= $popularite

    */

    if($date1=='' && $date2==''){
     $sql = "SELECT distinct titre, marque_page.id, description, pseudo, logo_choisi, ajoute_modifie.id_marque_page from marque_page

          LEFT JOIN ajoute_modifie ON marque_page.id = ajoute_modifie.id_marque_page
          LEFT JOIN utilisateur ON ajoute_modifie.id_utilisateur = utilisateur.id
          LEFT JOIN tag ON utilisateur.id=tag.id_utilisateur 
          

          WHERE marque_page.titre LIKE '%$contenu_recherche%' and utilisateur.pseudo LIKE '%$pseudo%' and marque_page.url LIKE '%$url%'  and tag.label LIKE '%$label%' AND marque_page.note>=$popularite AND createur=1

          ORDER BY
          titre asc

           ";
    }

    else{

     $sql = "SELECT distinct titre, marque_page.id, description, pseudo, logo_choisi, ajoute_modifie.id_marque_page from marque_page

      LEFT JOIN ajoute_modifie ON marque_page.id = ajoute_modifie.id_marque_page
      LEFT JOIN utilisateur ON ajoute_modifie.id_utilisateur = utilisateur.id
      LEFT JOIN tag ON utilisateur.id=tag.id_utilisateur 
      

      WHERE date_a>='$date1' and date_a<='$date2' and marque_page.titre LIKE '%$contenu_recherche%' and utilisateur.pseudo LIKE '%$pseudo%' and marque_page.url LIKE '%$url%'  and tag.label LIKE '%$label%' AND marque_page.note>=$popularite AND createur=1

      ORDER BY
      titre asc

       ";
    }   

    $req= $this->db->prepare($sql); 
    $req->execute(); //On réalise la requete 

    $row = $req->fetchAll();
    $nbr=count($row); //Le nombre de résultats trouvés
    return array('nombre_titre' => $nbr,'requete_titre' => $sql);
  }

  public function rechercheAvanceeTitrePlusieursTags($contenu_recherche,$date1,$date2,$pseudo,$url,$label,$popularite){
    /*
     On utilise les LEFT JOIN qui permettent de lister les enregistrements de table1 même s’il n’y a pas de correspondance avec table2

     Recherche parmi les titres précedemment sélectionnés par la recherche simple ceux :
      - qui ont été créé / modifié par un utilisateur ayant le pseudo $pseudo
      - qui ont été créé / modifié à une date comprise entre $date1 et $date2
      - qui ont une url ressemblant à $url
      - qui ont un label contenant $label
      - qui ont une note >= $popularite

    */

    if($date1=='' && $date2==''){
     $sql = "SELECT distinct titre, marque_page.id, description, pseudo, logo_choisi, ajoute_modifie.id_marque_page from marque_page

          LEFT JOIN ajoute_modifie ON marque_page.id = ajoute_modifie.id_marque_page
          LEFT JOIN utilisateur ON ajoute_modifie.id_utilisateur = utilisateur.id
          LEFT JOIN tag ON utilisateur.id=tag.id_utilisateur 
          

          WHERE marque_page.titre LIKE '%$contenu_recherche%' and utilisateur.pseudo LIKE '%$pseudo%' and marque_page.url LIKE '%$url%'  and tag.label IN ($label) AND marque_page.note>=$popularite AND createur=1

          ORDER BY
          titre asc

           ";
    }

    else{

     $sql = "SELECT distinct titre, marque_page.id, description, pseudo, logo_choisi, ajoute_modifie.id_marque_page from marque_page

      LEFT JOIN ajoute_modifie ON marque_page.id = ajoute_modifie.id_marque_page
      LEFT JOIN utilisateur ON ajoute_modifie.id_utilisateur = utilisateur.id
      LEFT JOIN tag ON utilisateur.id=tag.id_utilisateur 
      

      WHERE date_a>='$date1' and date_a<='$date2' and marque_page.titre LIKE '%$contenu_recherche%' and utilisateur.pseudo LIKE '%$pseudo%' and marque_page.url LIKE '%$url%'  and tag.label IN ($label) AND marque_page.note>=$popularite AND createur=1

      ORDER BY
      titre asc

       ";
    }   

    $req= $this->db->prepare($sql); 
    $req->execute(); //On réalise la requete 

    $row = $req->fetchAll();
    $nbr=count($row); //Le nombre de résultats trouvés
    return array('nombre_titre' => $nbr,'requete_titre' => $sql);
  }


}
