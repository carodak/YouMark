<?php

/************************************/
/**** Interface CommenteManager *****/
/************************************/

interface ICommenteManager{

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

}

/*************************************************************/
/**** classe en lien avec la table Commente de la base ****/
/*************************************************************/

class CommenteManager{

	/** ATTRIBUTS **/

	private $db; // Instance de PDO

	/** METHODES **/

	/* Constructeur */
	public function __construct($db){
		$this->setDb($db);
	}

	/** ajoute le commentaire d'un marque page à la base**/
	public function ajoute(Commente $commente){
		$query=$this->db->prepare('INSERT INTO commente(id_utilisateur, id_marque_page, date_commentaire, note, libelle_c) VALUES(:id_utilisateur, :id_marque_page, :date_commentaire, :libelle_c)');

      	$query->bindValue(':id_marque_page', $commente->getID_MarquePage());
  		$query->bindValue(':id_utilisateur', $commente->getID_Utilisateur());
  	  	$query->bindValue(':date_commentaire', $commente->getDate_Commentaire());
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
		$this->db->exec('DELETE FROM commente WHERE id_utilisateur = '.$commente->getID_Utilisateur().' AND id_marque_page = '.$commente->getID_MarquePage().' AND date_commentaire = '.$commente->getDate_Commentaire());
	}

	/* Renvoie un commentaire ayant pour identifiant $id_A, $id_M, $dc */
	public function get_par_Cle($id_A, $id_M, $dc){
	  $query = $this->db->query('SELECT id_utilisateur, id_marque_page, date_commentaire, note, libelle_c FROM commente WHERE id_utilisateur = '.$id_A.' AND id_marque_page = '.$id_M.' AND date_commentaire ='.$dc);
	  $donnees = $query->fetch(PDO::FETCH_ASSOC);
	  return new Commente($donnees);

	}

	/* Retourne la liste des commentaires dont le marque page est $id_M */
	public function getListeCommentaireParMarque($id_M){
		$commentaires = [];

		$query = $this->db->prepare('SELECT id_utilisateur, id_marque_page, date_commentaire, note, libelle_c FROM commente WHERE id_marque_page = :id_marque_page');
		$query->execute([':id_marque_page' => $id_M]);

		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
		  $commentaires[] = new Commente($donnees);
		}

		return $commentaires;
	}

	/** Modifie les attributs du commentaire ayant pour identifiants auteur, le marque page , et la date du commantaire **/
	public function update(Commente $commente){
	$query =$this->db->prepare('UPDATE commente SET (id_utilisateur = :id_A, id_marque_page = :id_M, date_commentaire = :dc, libelle_c = :libelle, note = :note) WHERE id_utilisateur = :id_A AND id_marque_page= :id_M AND date_commentaire = :dc');

	$query->bindValue(':id_utilisateur', $commente->getID_Utilisateur(), PDO::PARAM_INT);
	$query->bindValue(':id_marque_page', $commente->getID_MarquePage(), PDO::PARAM_INT);
	$query->bindValue(':date_commentaire', $commente->getDate_Commentaire(), PDO::PARAM_STR);
	$query->bindValue(':note', $commente->getNote(), PDO::PARAM_INT);
	$query->bindValue(':libelle_c', $commente->getLibelle_c(), PDO::PARAM_STR);

	$query->execute();

	}

	public function setDb(PDO $db){
		$this->db = $db;
	}

}

?>