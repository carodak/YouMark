<?php

/************************************/
/**** Interface CommenteManager *****/
/************************************/

interface ICommente_Manager{

	public function __construct(array $donnees);

	public function ajoute(Commente $commente);
	public function count();
	public function countCommentaireParAuteur($id);
	public function countCommentaireParMarquePage($id);
	public function supprime(Commente $commente);
	public function get_par_Cle($id);
	public function getListMarquePage($nom);
	public function update(Commente $commente);
	public function setDb(PDO $db);

	//Autre : 

	public function getPseudo_par_Id($id);

}

/*************************************************************/
/**** classe en lien avec la table Commente de la base ****/
/*************************************************************/

class Commente_Manager{

	/** ATTRIBUTS **/

	private $db; // Instance de PDO

	/** METHODES **/

	/* Constructeur */
	public function __construct($db){
		$this->setDb($db);
	}

	/** ajoute le commentaire d'un marque page à la base**/
	public function ajoute(Commente $commente){
		$query=$this->db->prepare('INSERT INTO commente(id_utilisateur, id_marque_page, note, libelle_c) VALUES(:id_utilisateur, :id_marque_page, :note, :libelle_c)');

      	$query->bindValue(':id_marque_page', $commente->getId_marque_page());
  		$query->bindValue(':id_utilisateur', $commente->getId_utilisateur());
  	  	//$query->bindValue(':date_c', $commente->getDate_c()); gérer par un trigger !
      	$query->bindValue(':note', $commente->getNote());
      	$query->bindValue(':libelle_c', $commente->getLibelle_c());
  		$query->execute();
	}

	/* compte le nombre de commentaires */
	public function count(){
		return $this->db->query('SELECT COUNT(*) FROM commente')->fetchColumn();
	}

    /* compte le nombre de commentaires en fonction du marque page */
	public function countCommentaireParMarquePage($id){
		return $this->db->query('SELECT COUNT(*) FROM commente WHERE id_marque_page = '.$id)->fetchColumn();
	}

	/* compte le nombre de commentaires fait par un auteur */
	public function countCommentaireParAuteur($id){
		return $this->db->query('SELECT COUNT(*) FROM commente WHERE id_utilisateur = '.$id)->fetchColumn();
	}

	/* supprime un commentaire */
	public function supprime(Commente $commente){
		$this->db->exec('DELETE FROM commente WHERE id_utilisateur = '.$commente->getID_Utilisateur().' AND id_marque_page = '.$commente->getID_MarquePage().' AND date_commentaire = '.$commente->getDate_c());
	}

	/* Renvoie un commentaire ayant pour identifiant $id_A, $id_M, $dc */
	public function get_par_Cle($id_A, $id_M, $dc){
	  $query = $this->db->query('SELECT id_utilisateur, id_marque_page, date_c, note, libelle_c FROM commente WHERE id_utilisateur = '.$id_A.' AND id_marque_page = '.$id_M.' AND date_c ='.$dc);
	  $donnees = $query->fetch(PDO::FETCH_ASSOC);
	  return new Commente($donnees);

	}

	/* Retourne la liste des commentaires dont le marque page est $id_M */
	public function getListeCommentaireParMarque($id_M){
		$commentaires = [];

		$query = $this->db->prepare('SELECT id_utilisateur, id_marque_page, date_c, note, libelle_c FROM commente WHERE id_marque_page = :id_marque_page');
		$query->execute([':id_marque_page' => $id_M]);

		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
		  $commentaires[] = new Commente($donnees);
		}

		return $commentaires;
	}

	/** Modifie les attributs du commentaire ayant pour identifiants auteur, le marque page , et la date du commantaire **/
	public function update(Commente $commente){
	$query =$this->db->prepare('UPDATE commente SET (id_utilisateur = :id_A, id_marque_page = :id_M, date_c = :dc, libelle_c = :libelle, note = :note) WHERE id_utilisateur = :id_A AND id_marque_page= :id_M AND date_commentaire = :dc');

	$query->bindValue(':id_utilisateur', $commente->getID_Utilisateur(), PDO::PARAM_INT);
	$query->bindValue(':id_marque_page', $commente->getID_MarquePage(), PDO::PARAM_INT);
	$query->bindValue(':date_c', $commente->getDate_c(), PDO::PARAM_STR);
	$query->bindValue(':note', $commente->getNote(), PDO::PARAM_INT);
	$query->bindValue(':libelle_c', $commente->getLibelle_c(), PDO::PARAM_STR);

	$query->execute();

	}

	public function trie_plus_commentes($date_commentaire){
		$commente = [];

		if($date_commentaire==0){
			$query = $this->db->prepare('SELECT id_marque_page, COUNT(*) AS nbreCommentaire FROM commente GROUP BY id_marque_page ORDER BY nbreCommentaire DESC');
		}else{
			$query = $this->db->prepare('SELECT id_marque_page, COUNT(*) AS nbreCommentaire FROM commente WHERE date_c >= ( CURDATE() - INTERVAL '.$date_commentaire.' DAY ) GROUP BY id_marque_page ORDER BY nbreCommentaire DESC');
		}
		$query->execute();

	while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
		$commente[] = $donnees;
	}

	return $commente;
	}

	public function trie_plus_commentes_pagination($debut, $limit,$date_commentaire){
    $marque_page = [];

		if($date_commentaire==0){
    	$query = $this->db->prepare('SELECT c.id_marque_page, m.url, m.titre, m.note, m.somme, COUNT(*) AS nbreCommentaire FROM commente c, marque_page m WHERE m.id = c.id_marque_page GROUP BY id_marque_page ORDER BY nbreCommentaire DESC LIMIT '.$debut.' ,'.$limit);
		}else{
			$query = $this->db->prepare('SELECT c.id_marque_page, m.url, m.titre, m.note, m.somme, COUNT(*) AS nbreCommentaire FROM commente c, marque_page m WHERE m.id = c.id_marque_page AND date_c >= ( CURDATE() - INTERVAL '.$date_commentaire.' DAY ) GROUP BY id_marque_page ORDER BY nbreCommentaire DESC LIMIT '.$debut.' ,'.$limit);
		}
    $query->execute();

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $marque_page[] = $donnees;
    }
    return $marque_page;
  }

	public function setDb(PDO $db){
		$this->db = $db;
	}

	public function getPseudo_par_Id($id){
	  $query = $this->db->query('SELECT pseudo FROM utilisateur WHERE id = '.$id);
	  $donnees = $query->fetch(PDO::FETCH_ASSOC);
	  return $donnees['pseudo'];
	}

}

?>
