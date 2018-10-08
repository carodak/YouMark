<?php

class Ajoute_Modifie_Manager
{
  private $db; // Instance de PDO

    public function __construct($db){
      $this->setDb($db);
    }

    public function ajoute(Ajoute_Modifie $ajoute_modifie){
      $query=$this->db->prepare('INSERT INTO ajoute_modifie(id_utilisateur, id_marque_page, description,  type_droit, logo_choisi) VALUES(:id_utilisateur, (SELECT MAX(id) FROM marque_page), :description,  :type_droit,  :logo_choisi)');

      $query->bindValue(':id_utilisateur', $ajoute_modifie->getId_utilisateur());
      //$query->bindValue(':id_marque_page', $ajoute_modifie->getId_marque_page()); // Remplacé par le SELECT MAX || Dans le cas où on insère pas la fonction getLastInsertID() ne marche pas. c'est pour ça que j'ai remplacé par SELECT MAX
      //$query->bindValue(':date_m', $ajoute_modifie->getDate_m()); // Doit etre gérée par mysql
      $query->bindValue(':description', $ajoute_modifie->getDescription());
      //$query->bindValue(':createur', $ajoute_modifie->getCreateur()); // Acompleter une fois le boulot lié, avec id_utilisateur
      $query->bindValue(':type_droit', $ajoute_modifie->getType_Droit());
      $query->bindValue(':logo_choisi', $ajoute_modifie->getLogo_Choisi());
      $query->execute();
    }

/******************************/

 
  //supprime la modification d'un marque page
    public function supprime($idm, $idu, $da){
      $this->db->exec('DELETE FROM ajoute_modifie WHERE date_a ="'.$da.'" AND id_utilisateur = '.$idu.' AND id_marque_page ='.$idm);
    }

      /** Modifie les attributs de la modification ou de l'ajout d'un marque page ayant pour identifiant $id_utilisateur, id_marque_page  **/
  public function update(Ajoute_Modifie $ajoute_modifie){
  $query =$this->db->prepare('UPDATE ajoute_modifie SET id_utilisateur = :idu, id_marque_page = :idm, date_m = :dm, description = :description, date_a = :date_a, type_droit= :type_droit, createur = :createur, logo_choisi = :logo_choisi WHERE id_utilisateur = :idu AND id_marque_page= :idm AND date_a = :date_a');

      $query->bindValue(':idu', $ajoute_modifie->getId_utilisateur());
      $query->bindValue(':idm', $ajoute_modifie->getId_marque_page());
      $query->bindValue(':dm', $ajoute_modifie->getDate_m());
      $query->bindValue(':date_a', $ajoute_modifie->getDate_a());
      $query->bindValue(':description', $ajoute_modifie->getDescription());
      $query->bindValue(':type_droit', $ajoute_modifie->getType_Droit());
      $query->bindValue(':createur', $ajoute_modifie->getCreateur());
      $query->bindValue(':logo_choisi', $ajoute_modifie->getLogo_Choisi());
  $query->execute();

  }

    public function get_par_Key($idu, $idm,$da){
     $query = $this->db->query('SELECT id_utilisateur, id_marque_page, date_m, description, date_a, type_droit, createur, logo_choisi FROM ajoute_modifie WHERE id_utilisateur = '.$idu.' AND id_marque_page = '.$idm.' AND date_a ="'.$da.'"');
     $donnees = $query->fetch(PDO::FETCH_ASSOC);
      
      return new Ajoute_Modifie($donnees);
  }


    public function get_by_Key($idm){ //Uniquement en passant par l'id du marque page 

     $query = $this->db->query('SELECT * FROM ajoute_modifie WHERE id_marque_page = '.$idm.' ');
     $donnees = $query->fetch(PDO::FETCH_ASSOC);

     return new Ajoute_Modifie($donnees); 
  }

  // Retourne la liste des auteurs */
public function getListAuteur(){
  $auteurs = [];

  $query = $this->db->prepare('SELECT DISTINCT id_utilisateur FROM ajoute_modifie WHERE createur = 1');
  $query->execute();

  while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
    $auteurs[] = $donnees['id_utilisateur'];
  }

  return $auteurs;
}

  public function get_createur($id_marque_page){
        $query = $this->db->query('SELECT date_a, date_m, description, id_utilisateur, note, somme, logo_choisi, id_marque_page, titre, url, createur FROM ajoute_modifie, marque_page WHERE id_marque_page = id AND id_marque_page='.$id_marque_page.' AND createur=1 ');
        $donnees = $query->fetch(PDO::FETCH_ASSOC);
        return $donnees;
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


  public function setDb(PDO $db)
  {
    $this->db = $db;
  }


   public function UpdateCreateur($id,$idmark)
  {

    $this->db->query('UPDATE ajoute_modifie SET createur=1 WHERE id_utilisateur='.$id.' AND id_marque_page = '. $idmark. '');
  }


  public function getMainDescription($id) {


     $query = $this->db->query('SELECT description FROM ajoute_modifie WHERE createur = 1 AND id_marque_page = '.$id.' ');
     $donnees = $query->fetch(PDO::FETCH_ASSOC);

     return $donnees["description"];


  }


    public function getUserDescription($id,$id_usr) {


     $query = $this->db->query('SELECT description FROM ajoute_modifie WHERE id_marque_page = '.$id.' AND id_utilisateur = ' . $id_usr. '');
     $donnees = $query->fetch(PDO::FETCH_ASSOC);

     return $donnees["description"];


  }

}
