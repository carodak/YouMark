<?php

/*****************************/
/*** Interface Utilisateur ***/
/*****************************/

interface IUtilisateur{

	public function __construct(array $donnees);
	public function assigne_val_attributs(array $donnees);

	public function getID();
  	public function getMail();
  	public function getPseudo();
  	public function getMotDePasse();
  	public function getAvatar();
  	public function getNiveau();
  	public function getAdmin();

  	public function setID($id);
	public function setMail($mail);
	public function setMotDePasse($mdp);
	public function setPseudo($pseudo);
	public function setAvatar($avatar);
	public function setNiveau($niveau);
	public function setAdmin($admin);

}


/*************************************************************/
/**** classe dont une instance est un utilisateur du site ****/
/*************************************************************/

class Utilisateur implements IUtilisateur{
	
	/** ATTRIBUTS **/

	//identifiant de l'utilisateur
	private $id;

	//adressse mail de l'utilisateur
	private $mail = "";

	//mot de passe de l'utilisateur
	private $mot_de_passe = "";

	//pseudo de l'utilisateur
	private $pseudo = "";

	//avatar de l'utilisateur
	private $avatar = "";

	//niveau d'implication de l'utilisateur (Novice, Modéré, Pro, Expert,...)
	private $niveau;

	//booleen signifiant si l'utilisateur fait parti des administrateurs du site
	private $admin;


	/** METHODES **/

	/* constructeurs */
	public function __construct(array $donnees){
		$this->assigne_val_attributs($donnees);
	} 


	public function assigne_val_attributs(array $donnees){
    	foreach ($donnees as $key => $value){
      		$method = 'set'.ucfirst($key);
      
      		if (method_exists($this, $method)){
        		$this->$method($value);
      		}
   		 }
  	}


  	/** Accesseurs en lecture **/
  	public function getID(){ return $this->id; }

  	public function getMail(){ return $this->mail; }

  	public function getMotDePasse(){ return $this->mot_de_passe; }

  	public function getPseudo(){ return $this->pseudo; }

  	public function getAvatar(){ return $this->avatar; }

  	public function getNiveau(){ return $this->niveau; }

  	public function getAdmin(){ return $this->admin; }

  	/** Accesseurs en écriture **/
	public function setID($id){
		$id = (int) $id;
		if ($id>0){
			$this->id = $id;
		}	
	}

	public function setMail($mail){
		if (is_string($mail)){
			$this->mail = $mail;
		}	
	}

	public function setMotDePasse($mdp){
		if (is_string($mdp)){
			$this->mot_de_passe = $mdp;
		}	
	}

	public function setPseudo($pseudo){
		if (is_string($pseudo)){
			$this->pseudo = $pseudo;}	
	}

	public function setAvatar($avatar){
		if (is_string($avatar)){
			$this->avatar = $avatar;
		}
	}

	public function setNiveau($niveau){
		if (is_string($niveau)){
			$this->niveau = $niveau;
		}	
	}

	public function setAdmin($admin){
		if($admin == 0 || $admin == 1){
			$this->admin = $admin;
		}
	}

}

?>