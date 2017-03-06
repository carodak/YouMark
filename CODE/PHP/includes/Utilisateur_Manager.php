<?php

/************************************/
/*** Interface UtilisateurManager ***/
/************************************/

interface IUtilisateurManager{

	public function __construct(array $donnees);
	public function ajoute(Utilisateur $utilisateur);
	public function count();
	public function supprime(Utilisateur $utilisateur);
	public function existeMail($mail);
	public function existePseudo($pseudo);
	public function get_par_Id($id);
	public function getListPseudo($nom);
	public function getListNiveau($nom);
	public function getListAdmin();
	public function update(Utilisateur $utilisateur);
	public function setDb(PDO $db);

}

/*************************************************************/
/**** classe en lien avec la table Utilisateur de la base ****/
/*************************************************************/

class UtilisateurManager{

	/** ATTRIBUTS **/

	private $db; // Instance de PDO

	/** METHODES **/

	/* Constructeur */
	public function __construct($db){
		$this->setDb($db);
	}

	/** ajoute un utilisateur à la base**/
	public function ajoute(Utilisateur $utilisateur){
		$query=$this->db->prepare('INSERT INTO utilisateur(mail, pseudo, mot_de_passe, avatar, niveau, admin) VALUES(:mail, :pseudo, :mot_de_passe, :avatar, :niveau, :admin)');

      	$query->bindValue(':pseudo', $utilisateur->getPseudo());
  		$query->bindValue(':mail', $utilisateur->getMail());
  	  	$query->bindValue(':mot_de_passe', $utilisateur->getMotDePasse());
      	$query->bindValue(':avatar', $utilisateur->getAvatar());
      	$query->bindValue(':admin', $utilisateur->getAdmin());
      	$query->bindValue(':niveau', $utilisateur->getNiveau());
  		$query->execute();

  		$utilisateur->assigne_val_attributs([
  			'id' => $this->db->lastInsertId(),
  			]);
	}

	/* compte le nombre d'utilisateurs */
	public function count(){
		return $this->db->query('SELECT COUNT(*) FROM utilisateur')->fetchColumn();
	}

	/* supprime un utilisateur */
	public function supprime(Utilisateur $utilisateur){	
		$this->db->exec('DELETE FROM utilisateur WHERE mail = '.$utilisateur->getMail());
	}

	/* Vérifie si l'adresse mail de l'utilisateur n'existe pas déjà */
	public function existeMail($mail){
		if (is_string($mail)){ 
			return (bool) $this->db->query('SELECT COUNT(*) FROM utilisateur WHERE mail = '.$mail)->fetchColumn();
		}
	}

	/* Vérifie si le pseudo de l'utilisateur n'existe pas déjà */
	public function existePseudo($pseudo){
		if (is_string($pseudo)){ 
			return (bool) $this->db->query('SELECT COUNT(*) FROM utilisateur WHERE pseudo = '.$pseudo)->fetchColumn();
		}
	}


	/* Renvoie un utilisateur ayant pour identifiant $id */
	public function get_par_Id($id){
	  $query = $this->db->query('SELECT id, mail, pseudo, niveau, avatar FROM utilisateur WHERE id = '.$id);
	  $donnees = $query->fetch(PDO::FETCH_ASSOC);
	  return new Utilisateur($donnees);

	}

	/* Retourne la liste des utilisateurs dont le pseudo est différent de $pseudo */
	public function getListPseudo($nom){
		$utilisateurs = [];

		$query = $this->db->prepare('SELECT id, mail, pseudo, niveau, avatar, admin FROM utilisateur WHERE pseudo <> :pseudo ORDER BY pseudo');
		$query->execute([':pseudo' => $pseudo]);

		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
		  $utilisateurs[] = new Utilisateur($donnees);
		}

		return $utilisateurs;
	}

	/* Retourne la liste des utilisateurs qui sont administrateurs */
	public function getListAdmin(){
		$utilisateurs = [];

		$query = $this->db->prepare('SELECT id, mail, pseudo, niveau, avatar, admin FROM utilisateur WHERE admin = 1 ORDER BY pseudo');
		$query->execute();

		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
		  $utilisateurs[] = new Utilisateur($donnees);
		}

		return $utilisateurs;
	}

	/* Retourne la liste des utilisateurs dont le niveau est égal à $niveau */
	public function getListNiveau($nom){
		$utilisateurs = [];

		$query = $this->db->prepare('SELECT id, mail, pseudo, niveau, avatar, admin FROM utilisateur WHERE niveau <> :niveau ORDER BY pseudo');
		$query->execute([':niveau' => $niveau]);

		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
		  $utilisateurs[] = new Utilisateur($donnees);
		}

		return $utilisateurs;
	}

	/** Modifie les attributs de l'utilisateur ayant pour identifiant $id **/
	public function update(Utilisateur $utilisateur){
	$query =$this->db->prepare('UPDATE utilisateur SET (mail = :mail, mot_de_passe = :mot_de_passe, niveau = :niveau, pseudo = :pseudo, avatar = :avatar, admin = :admin) WHERE id = :id');

	$query->bindValue(':mail', $utilisateur->getMail(), PDO::PARAM_STR);
	$query->bindValue(':pseudo', $utilisateur->getPseudo(), PDO::PARAM_STR);
	$query->bindValue(':niveau', $utilisateur->getNiveau(), PDO::PARAM_INT);
	$query->bindValue(':avatar', $utilisateur->getAvatar(), PDO::PARAM_STR);
    $query->bindValue(':admin', $utilisateur->getAdmin(), PDO::PARAM_INT);
	$query->bindValue(':mot_de_passe', $utilisateur->getMotDePasse(), PDO::PARAM_STR);
	$query->bindValue(':id', $utilisateur->getID(), PDO::PARAM_INT);

	$query->execute();

	}

	public function setDb(PDO $db){
		$this->db = $db;
	}

}

?>