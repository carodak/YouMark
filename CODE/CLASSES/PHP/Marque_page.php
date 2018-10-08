<?php

interface IMarque_Page{
	public function __construct(array $donnees);
}

/**** classe dont une instance est un marque-page ****/

class Marque_Page implements IMarque_Page{
	private $id;
	private $url;
	private $titre;
	private $note;
	private $somme;

	/* constructeur paramétré : entrant l'id, l'url, le titre, la note, la somme et le logo_choisi d'un marque-page */
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

  	//public function getDate_p(){ return $this->date;}


  	public function getId(){ return $this->id;}
  	
  	public function getUrl(){ return $this->url;}

  	public function getTitre(){ return $this->titre;}

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

}

?>

