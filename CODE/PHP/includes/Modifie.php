<?php

interface IModifie{
	public function __construct(array $donnees);
}

/**** classe dont une instance est la modification d'un marque-page ****/

class Modifie implements IModifie{
	private $id_utilisateur;
	private $id_marque_page;
	private $date_m;
	private $description_m;

	/* constructeur paramétré : entrant l'id de l'utilisateur, l'id du marque-page, la date de modification et la description modifié */
	public function __construct(array $donnees){
		$this->assigne_val_attributs($donnees);
	} 

	//hydratation
	public function assigne_val_attributs(array $donnees)
 	 {
    	foreach ($donnees as $key => $value)
    	{
      		$method = 'set'.ucfirst($key);
      
      		if (method_exists($this, $method))
      		{
        		$this->$method($value);
      		}
   		 }
  	}

  	//Accesseurs en lecture
  	public function getId_utilisateur(){ return $this->id_utilisateur;}
	
	public function getId_marque_page(){ return $this->id_marque_page;}
	
	public function getDate_m(){ return $this->date_m;}
	
	public function getDescription_m(){ return $this->description_m;}

  	//Accesseurs en écriture
	public function setId_utilisateur($id_u){
		$id_u = (int) $id_u;
		if ($id_u>0){
			$this->id_utilisateur = $id_u;}
	}
	
	public function setId_marque_page($id_mp){
		$id_mp = (int) $id_mp;
		if ($id_mp>0){
			$this->id_marque_page = $id_mp;}
	}
	
	public function setDate_t($date_t){
		if (is_string($date_t)){
			$this->date_t = $date_t;}	
	}
	
	public function setDescription_m($desc_m){
		if (is_string($desc_m)){
			$this->description_m = $desc_m;}	
	}
}

?>