<?php

/*****************************/
/***** Interface Commente ****/
/*****************************/

interface ICommente{

	public function __construct(array $donnees);
	public function assigne_val_attributs(array $donnees);

	public function getId_marque_Page();
  	public function getId_utilisateur();
  	public function getDate_c();
  	public function getNote();
  	public function getLibelle_c();

  	public function setId_marque_page($id);
	public function setId_utilisateur($id);
	public function setDate_c($dc);
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
	private $date_c;

	//note donnée au marque page
	private $note=0; //Par défaut la note vaut 0 (pour ne pas avoir d'erreurs sql)

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
  	public function getId_marque_page(){ return $this->id_marque_page; }

  	public function getId_utilisateur(){ return $this->id_utilisateur; }

  	public function getDate_c(){ return $this->date_commentaire; }

  	public function getNote(){ return $this->note; }

  	public function getLibelle_c(){ return $this->libelle; }


  	/** Accesseurs en écriture **/
	public function setId_marque_page($id){
		$id = (int) $id;
		if ($id>0){
			$this->id_marque_page = $id;
		}
	}

	public function setId_utilisateur($id){
		$id = (int) $id;
		if ($id>0){
			$this->id_utilisateur = $id;
		}
	}

	public function setDate_c($dc){
		if (is_string($dc)){
			$this->date_commentaire = $dc;
		}
	}

	public function setNote($note){
		$note = (int) $note;
		if ($note>0){
			$this->note = $note;}
	}

	public function setLibelle_c($libelle){
		if (is_string($libelle)){
			$this->libelle = $libelle;
		}
	}



}

?>
