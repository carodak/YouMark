 <?php

$type_droit=array(0,1);

interface IMarque_Page{
	public function __construct(array $donnees);
}

/**** classe dont une instance est un marque-page ****/

class Marque_Page implements IMarque_Page{
	private $id;
	private $url;
	private $titre;
	private $id_createur;
	private $date_p;
	private $type_droit=1; //Punlique par défaut
	private $description_p;
	private $note;
	private $somme;
	private $logo_choisi=0;

	/* constructeur paramétré : entrant l'id, l'url, le titre, l'id du créateur, 
	la date posté, le type de droit , la note, la somme et la description d'un marque-page */
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
   		// $logo_choisi=$_POST["selected-text"];
  	}

  	//Accesseurs en lecture
  	public function getId(){ return $this->id;}
  	
  	public function getUrl(){ return $this->url;}

  	public function getTitre(){ return $this->titre;}
	
	public function getId_createur(){ return $this->id_createur;}
	
	public function getDate_p(){ return $this->date_p;}
	
	public function getType_droit(){ return $this->type_droit;}
	
	public function getDescription_p(){ return $this->description_p;}

	public function getLogo_choisi() {return $this->logo_choisi;}

	public function getNote(){return $this->note;}

	public function getSomme(){return $this->somme;}

  	//Accesseurs en écriture
	public function setId($id){
		$id = (int) $id;
		if ($id>0){
			$this->id = $id;}
	}

	public function setUrl($url){
		if (is_string($url)){
			$this->url = $url;}	
	}

	public function setTitre($titre){
		if (is_string($titre)){
			$this->titre = $titre;}	
	}
	
	public function setId_createur($id_c){
		$id_c = (int) $id_c;
		if ($id_c>0){
			$this->id_createur = $id_c;}
	}
	
	public function setDate_p($date_p){
		if (is_string($date_p)){
			$this->date_p = $date_p;}	
	}
	
	public function setType_droit($type_droit){
		if($type_droit==0 || $type_droit==1){
			$this->type_droit = $type_droit;
		}
	}
	
	public function setDescription_p($desc_p){
		if (is_string($desc_p)){
			$this->description_p = $desc_p;}	
	}

	public function setNote($n){
		$n = (int) $n;
		if ($n>=0){
			$this->note = $n;}
	}

	public function setSomme($n){
		$n = (int) $n;
		if ($n>=0){
			$this->somme = $n;}
	}

	public function setLogo_choisi($n){
		$n = (int) $n;
		if ($n>=0){
			$this->logo_choisi = $n;}
	}


}

?>

