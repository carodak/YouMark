<?php

/*****************************/
/***** Interface Commente ****/
/*****************************/

interface ICommente{
	
	public function __construct(array $donnees);
	public function assigne_val_attributs(array $donnees);

	public function getID_MarquePage();
  	public function getID_Utilisateur();
  	public function getDate_Commentaire();
  	public function getNote();
  	public function getLibelle_c();

  	public function setID_MarquePage($id);
	public function setID_Utilisateur($id);
	public function setDate_Commentaire($dc);
	public function setNote($note);
	public function setLibelle_c($libelle);

}


/*************************************************************/
/****** classe dont une instance est commmente du site *******/
/*************************************************************/

class Commente implements ICommente{
	
	/** ATTRIBUTS **/

	//identifiant du marque page commenté
	private $id_marque_page;

	//identifiant de l'utilisateur qui a commenté
	private $id_utilisateur;

	//date du commentaire 
	private $date_commentaire;

	//note donnée au marque page
	private $note;

	//libellé du commentaire
	private $libelle = "";


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
  	public function getID_MarquePage(){ return $this->id_marque_page; }

  	public function getID_Utilisateur(){ return $this->id_utilisateur; }

  	public function getDate_Commentaire(){ return $this->date_commentaire; }

  	public function getNote(){ return $this->note; }

  	public function getLibelle_c(){ return $this->libelle; }


  	/** Accesseurs en écriture **/
	public function setID_MarquePage($id){
		$id = (int) $id;
		if ($id>0){
			$this->id_marque_page = $id;
		}	
	}

	public function setID_Utilisateur($id){
		if (is_int($id)){
			$this->id_utilisateur = $id;
		}	
	}

	public function setDate_Commentaire($dc){
		if (is_string($dc)){
			$this->date_commentaire = $dc;
		}	
	}

	public function setNote($note){
		if (is_int($note)){
			$this->note = $note;}	
	}

	public function setLibelle_c($libelle){
		if (is_string($libelle)){
			$this->libelle = $libelle;
		}
	}

}

?>