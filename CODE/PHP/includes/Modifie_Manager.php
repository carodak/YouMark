<?php

class Modifie_manager
{
	private $db; // Instance de PDO
  
  	public function __construct($db){
    	$this->setDb($db);
  	}

  	public function ajoute(Modifie $modifie){
  		$query=$this->db->prepare('INSERT INTO modifie(id_utilisateur, id_marque_page, date_m, description_m) VALUES(:id_utilisateur, :id_marque_page, :date_m, :description_m)');
  		
      $query->bindValue(':id_utilisateur', $modifie->getId_utilisateur());
  	  $query->bindValue(':id_marque_page', $modifie->getId_marque_page());
  	  $query->bindValue(':date_m', $modifie->getDate_m());
      $query->bindValue(':description_m', $modifie->getDescription_m());
      $query->execute();
  	}
  
  public function setDb(PDO $db)
  {
    $this->db = $db;
  }

}