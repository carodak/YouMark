<?php

interface IAjoute_Modifie{
	public function __construct(array $donnees);
}

/**** classe dont une instance est un ajout ou une modification d'un marque page ****/

class Ajoute_Modifie implements IAjoute_Modifie{

	private $id_utilisateur;
	private $id_marque_page;
	private $date_a;
	private $description;
	private $type_droit = 1; //public par défaut
	private $date_m;
	private $createur;
	private $logo_choisi;

	/* constructeur paramétré : entrant l'id de l'utilisateur, l'id du marque-page, la date d'ajout, la description, le type de droit et s'il s'agit d'une creation*/
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

	public function getDate_a(){ return $this->date_a;}

	public function getType_Droit(){ return $this->type_droit;}

	public function getDescription(){ return $this->description;}

	public function getCreateur(){ return $this->createur;}

	public function getLogo_Choisi(){ return $this->logo_choisi;}

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

	public function setType_Droit($d){
		$d = (int) $d;
		if ($d ==0 || $d==1){
			$this->type_droit = $d;}
	}

	public function setDate_m($date_t){
			$this->date_m = $date_t;
	}

    public function setDate_a($date_t){
			$this->date_a = $date_t;
	}


	public function setDescription($desc){
		if (is_string($desc)){
			$this->description = $desc;}
	}

	public function setLogo_Choisi($lc){
		if (is_string($lc)){
			$this->logo_choisi = $lc;}
	}	

	public function setCreateur($c){
		$c = (int) $c;
		if ($c ==0 || $c==1){
			$this->createur = $c;}
	}
}

?>
