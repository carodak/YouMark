<?php

class Tag_manager
{
	private $db; // Instance de PDO
  
  	public function __construct($db){
    	$this->setDb($db);
  	}

  	public function ajoute(Tag $tag){
  		$query=$this->db->prepare('INSERT INTO tag(id_utilisateur, id_marque_page, label, date_t) VALUES(:id_utilisateur, :id_marque_page, :label, :date_t)');
  		
      $query->bindValue(':id_utilisateur', $tag->getId_utilisateur());
  	  $query->bindValue(':id_marque_page', $tag->getId_marque_page());
  	  $query->bindValue(':label', $tag->getLabel());
      $query->bindValue(':date_t', $tag->getDate_t());
      $query->execute();
  	}
  
  public function setDb(PDO $db)
  {
    $this->db = $db;
  }

}