<?php

class Marque_Page_manager
{
	private $db; // Instance de PDO
  
  	public function __construct($db){
    	$this->setDb($db);
  	}

	//ajoute un marque-page à la base de donnée
  	public function ajoute(Marque_page $marque_page){
  		$query=$this->db->prepare('INSERT INTO marque_page(url, titre, date_p, type_droit, description_p,logo_choisi) VALUES(:url, :titre, :date_p, :type_droit, :description_p,:logo_choisi)');
  		
        $msqdate = (new \DateTime())->format('Y-m-d H:i:s');

      //$query->bindValue(':id', $marque_page->getId()); l'ID est auto incrément, donc je ne la saisi pas
  	  $query->bindValue(':url', $marque_page->getUrl());
  	  $query->bindValue(':titre', $marque_page->getTitre());
      // $query->bindValue(':id_createur', $marque_page->getId_createur()); // A rajouter lors de la fusion avec le travail de caro
  	  $query->bindValue(':date_p', $msqdate);
  	  $query->bindValue(':type_droit', $marque_page->getType_droit());
  	  $query->bindValue(':description_p', $marque_page->getDescription_p());
      $query->bindValue(':logo_choisi', $marque_page->getLogo_choisi());
      //$query->bindValue(':somme', 0); elle est par défaut à 0 (géré par MYSQL)
      //$query->bindValue(':note', NULL); // Pareil
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
	
	//Vérifie si le marque_page n'existe pas déjà
  	public function existe($num)
    {
    if (is_int($num)) // On veut voir si le marque-page ayant pour id $num existe
    {
      return (bool) $this->db->query('SELECT COUNT(*) FROM marque-page WHERE id = '.$num)->fetchColumn();
    }
    }
	
	//Renvoie un marque-page ayant pour id $num
  public function get_Par_Id($num)
  {
      $query = $this->db->query('SELECT id, url, titre, id_createur, date_p, type_droit, description_p, note, somme FROM marque_page WHERE id = '.$num);
      $donnees = $query->fetch(PDO::FETCH_ASSOC);
      
      return new Marque_page($donnees);

  }

  // Retourne la liste des marques pages publiés par l'utilisateur avec l'id $id */
  public function getListMarquePageParCreateur($id){
    $marque_page = [];

    $query = $this->db->prepare('SELECT id, url, titre, id_createur, date_p, type_droit, description_p, note, somme FROM marque_page WHERE id_createur = :id_createur ORDER BY titre');
    $query->execute([':id_createur' => $id]);

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $marque_page[] = new Marque_page($donnees);
    }

    return $marque_page;
  }
  
  //Modifie les attributs du marque-page 
  public function update(Marque_page $marque_page)
  {
    $query = $this->db->prepare('UPDATE marque_page SET (url = :url, titre = :titre, id_createur = :id_createur, date_p = :date_p, type_droit = :type_droit, description_p = :description_p, note = :note, somme =:somme) WHERE id = :id');
    
  	  $query->bindValue(':url', $marque_page->getUrl());
  	  $query->bindValue(':titre', $marque_page->getTitre());
      $query->bindValue(':id_createur', $marque_page->getId_createur());
	  $query->bindValue(':date_p', $marque_page->getDate_p());
	  $query->bindValue(':type_droit', $marque_page->getType_droit());
	  $query->bindValue(':description_p', $marque_page->getDescription_p());
    $query->bindValue(':note', $marque_page->getNote());
    $query->bindValue(':somme', $marque_page->getSomme());
	  $query->execute();
  }
  
  public function setDb(PDO $db)
  {
    $this->db = $db;
  }

}