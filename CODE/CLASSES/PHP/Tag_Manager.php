<?php

class Tag_manager
{
	private $db; // Instance de PDO
  
  	public function __construct($db){
    	$this->setDb($db);
  	}

    public function ajoute(Tag $tag){

            //A completer avec l'id utilisateur une fois le boulot lié
      $query=$this->db->prepare('INSERT INTO tag(id_utilisateur, id_marque_page, label) VALUES( :id_utilisateur, (SELECT MAX(id) FROM marque_page), :label)');
 


      $query->bindValue(':id_utilisateur', 5);
      //$query->bindValue(':id_marque_page', $tag->getId_marque_page());
      $query->bindValue(':label', $tag->getLabel());
      $query->execute();
    }

    public function count_occurrence(){
      $tag = [];

      $query = $this->db->prepare('SELECT label, COUNT(*) AS occurrence FROM tag GROUP BY label ORDER BY occurrence DESC');
      $query->execute();

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $tag[] = $donnees;
    }

    return $tag;
    }

     public function count_occurrence_tag($label){
      return $this->db->query("SELECT COUNT(*) FROM tag t, ajoute_modifie a WHERE a.id_marque_page = t.id_marque_page AND type_droit=1 AND label LIKE '".$label."'")->fetchColumn();
    }

    public function nombre_fixed(){
      $tag = [];

      $query = $this->db->prepare('SELECT label, COUNT(*) AS occurrence FROM tag GROUP BY label ORDER BY occurrence DESC LIMIT 12');
      $query->execute();

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $tag[] = $donnees;
    }
      return $tag;
    }

   //On recherche les tags ayant le label
   public function rechercheLabel($label){
      $sql2= "SELECT DISTINCT label FROM tag WHERE label LIKE '%$label%' ORDER BY label asc";
      $req2= $this->db->prepare($sql2); 
      $req2->execute(); //On réalise la requete 
      $row2 = $req2->fetchAll();
      $nbr2=count($row2); //Le nombre de résultats trouvés

      return array('nombre_tag' => $nbr2,'requete_tag' => $sql2);
  }

  public function rechercheAvanceeLabel($contenu_recherche,$date1,$date2,$pseudo,$url,$popularite){
    /*
     On utilise les LEFT JOIN qui permettent de lister les enregistrements de table1 même s’il n’y a pas de correspondance avec table2

     Recherche parmi les tags précedemment sélectionnés par la recherche simple ceux :
      - qui ont été créé / utilisé par un utilisateur ayant le pseudo $pseudo
      - qui ont été taggué sur un marque_page ayant une url ressemblant à $url
      - qui ont été utilisé sur un marque_page ayant une note >= $popularite
      - qui ont été créé à une date comprise entre $date1 et $date2

      Il faut également traiter le cas où l'on a pas renseigné de date
    */

     if($date1=='' && $date2==''){
      $sql = "SELECT distinct label from tag

        LEFT JOIN utilisateur ON tag.id_utilisateur = utilisateur.id
        LEFT JOIN ajoute_modifie ON utilisateur.id = ajoute_modifie.id_utilisateur 
        LEFT JOIN marque_page ON marque_page.id=tag.id_marque_page
        

        WHERE tag.label LIKE '%$contenu_recherche%' and utilisateur.pseudo LIKE '%$pseudo%' and marque_page.url LIKE '%$url%' AND marque_page.note>=$popularite

     
      ORDER BY
        label asc

       ";

     }

     else{
        $sql = "SELECT distinct label from tag

        LEFT JOIN utilisateur ON tag.id_utilisateur = utilisateur.id
        LEFT JOIN ajoute_modifie ON utilisateur.id = ajoute_modifie.id_utilisateur 
        LEFT JOIN marque_page ON marque_page.id=tag.id_marque_page
        

        WHERE tag.label LIKE '%$contenu_recherche%' and utilisateur.pseudo LIKE '%$pseudo%' and marque_page.url LIKE '%$url%' AND marque_page.note>=$popularite AND date_t>='$date1' and date_t<='$date2'

     
      ORDER BY
        label asc

       ";
    }

    $req= $this->db->prepare($sql); 
    $req->execute(); //On réalise la requete 

    $row = $req->fetchAll();
    $nbr=count($row); //Le nombre de résultats trouvés
    return array('nombre_tag' => $nbr,'requete_tag' => $sql);
  }

  public function rechercheAvanceeLabelPlusieursTags($contenu_recherche,$date1,$date2,$pseudo,$url,$popularite){
    /*
     On utilise les LEFT JOIN qui permettent de lister les enregistrements de table1 même s’il n’y a pas de correspondance avec table2

     Recherche parmi les tags précedemment sélectionnés par la recherche simple ceux :
      - qui ont été créé / utilisé par un utilisateur ayant le pseudo $pseudo
      - qui ont été taggué sur un marque_page ayant une url ressemblant à $url
      - qui ont été utilisé sur un marque_page ayant une note >= $popularite
      - qui ont été créé à une date comprise entre $date1 et $date2

      On traite le cas où l'on a plusieurs tags
    */

     if($date1=='' && $date2==''){
      

      $sql = "SELECT distinct label from tag

        LEFT JOIN utilisateur ON tag.id_utilisateur = utilisateur.id
        LEFT JOIN ajoute_modifie ON utilisateur.id = ajoute_modifie.id_utilisateur 
        LEFT JOIN marque_page ON marque_page.id=tag.id_marque_page
        

        WHERE tag.label IN ($contenu_recherche) and utilisateur.pseudo LIKE '%$pseudo%' and marque_page.url LIKE '%$url%' AND marque_page.note>=$popularite

     
      ORDER BY
        label asc

       ";

     }

     else{
        $sql = "SELECT distinct label from tag

        LEFT JOIN utilisateur ON tag.id_utilisateur = utilisateur.id
        LEFT JOIN ajoute_modifie ON utilisateur.id = ajoute_modifie.id_utilisateur 
        LEFT JOIN marque_page ON marque_page.id=tag.id_marque_page
        

        WHERE tag.label IN ($contenu_recherche) and utilisateur.pseudo LIKE '%$pseudo%' and marque_page.url LIKE '%$url%' AND marque_page.note>=$popularite AND date_t>='$date1' and date_t<='$date2'

     
      ORDER BY
        label asc

       ";
    }

    $req= $this->db->prepare($sql); 
    $req->execute(); //On réalise la requete 

    $row = $req->fetchAll();
    $nbr=count($row); //Le nombre de résultats trouvés
    return array('nombre_tag' => $nbr,'requete_tag' => $sql);
  }


    public function list_tag(){
      $tag = [];

      $query = $this->db->prepare('SELECT DISTINCT label FROM tag ORDER BY label ASC');
      $query->execute();

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $tag[] = $donnees;
    }

    return $tag;
    }

    public function trie_tag_par_alphabet($alphabet){
      $tag = [];
      $query = $this->db->prepare("SELECT DISTINCT label FROM tag t, ajoute_modifie a WHERE a.id_marque_page = t.id_marque_page AND type_droit=1 AND label LIKE '$alphabet%' ORDER BY label ASC");
      $query->execute();

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $tag[] = $donnees;
    }

    return $tag;
    }

    public function setDb(PDO $db)
  {
    $this->db = $db;
  }


        //Renvoie les tags ayant pour id_marque_page $num
  public function get_Par_Id($num)
  {
      $query = $this->db->query('SELECT label FROM `tag` WHERE  id_marque_page= '. $num .'');
      $tags=array();    

      while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $tags[] = $donnees;
      }


      return $tags;

  }

      public function tag_Par_Marque_Page($id_marque_page){
     $tag = [];
     $query = $this->db->prepare("SELECT DISTINCT label FROM tag WHERE id_marque_page=".$id_marque_page." LIMIT 7");
     $query->execute();

     while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $tag[] = $donnees;
    }

     return $tag;
  }


}