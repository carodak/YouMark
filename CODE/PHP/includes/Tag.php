<?php

interface ITag{
	public function __construct(array $donnees);
}

/**** classe dont une instance est un tag ****/

class Tag implements ITag{
	private $id_utilisateur;
	private $id_marque_page;
	private $label;
	private $date_t;

	/* constructeur paramétré : entrant l'id de l'utilisateur, l'id du marque-page, le label du tag et la date tagué */
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
	
	public function getLabel(){ return $this->label;}
	
	public function getDate_t(){ return $this->date_t;}

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
	
	public function setLabel($label){
		if (is_string($label)){
			$this->label = $label;}	
	}
	
	public function setDate_t($date_t){
		if (is_string($date_t)){
			$this->date_t = $date_t;}	
	}
}

?>