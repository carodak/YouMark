<?php

/************************************/
/*** Interface UtilisateurManager ***/
/************************************/

interface IUtilisateur_Manager{

	public function __construct(array $donnees);
	public function ajoute(Utilisateur $utilisateur);
	public function count();
	public function supprime(Utilisateur $utilisateur);
	public function existeMail($mail);
	public function existePseudo($pseudo);
	public function get_par_Id($id);
	public function get_par_Pseudo($pseudo);
	public function getListPseudo($nom);
	public function getListNiveau($nom);
	public function getListAdmin();
	public function update(Utilisateur $utilisateur);
	public function setDb(PDO $db);
	public function getIdByPseudo($pseudo);
	public function getAvatarById($id);

}

/*************************************************************/
/**** classe en lien avec la table Utilisateur de la base ****/
/*************************************************************/

class Utilisateur_Manager{

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

		/* Renvoie un utilisateur ayant pour identifiant $id */
	public function getPseudo_par_Id($id){
	  return  $this->db->query('SELECT pseudo FROM utilisateur WHERE id = '.$id)->fetchColumn();
	}

	/* Vérifie si le pseudo de l'utilisateur n'existe pas déjà */
	public function existePseudo($pseudo){
		if (is_string($pseudo)){ 
			return (bool) $this->db->query('SELECT COUNT(*) FROM utilisateur WHERE pseudo = '.$pseudo)->fetchColumn();
		}
	}


	public function getCreator($id_markp) { //l'id de la personne ayant créer le marque page

			  return  (int) $this->db->query('SELECT id_utilisateur FROM marque_page,ajoute_modifie WHERE id=id_marque_page AND createur = 1  AND id_marque_page = ' . $id_markp)->fetchColumn();


	}


	/* Renvoie un utilisateur ayant pour identifiant $id */
	public function get_par_Id($id){
	  $query = $this->db->query('SELECT id, mail, pseudo, niveau, avatar, admin FROM utilisateur WHERE id = '.$id);
	  $donnees = $query->fetch(PDO::FETCH_ASSOC);
	  return new Utilisateur($donnees);
	}

		/* Renvoie un utilisateur ayant pour identifiant $pseudo */
	public function get_par_Pseudo($pseudo){
	  $query = $this->db->query('SELECT id, mail, pseudo, niveau, avatar, admin FROM utilisateur WHERE pseudo = "'.$pseudo.'"');
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
	$query =$this->db->prepare('UPDATE utilisateur SET mail = :mail, mot_de_passe = :mot_de_passe, niveau = :niveau, pseudo = :pseudo, avatar = :avatar, admin = :admin WHERE id = :id');


	$query->bindValue(':mail', $utilisateur->getMail());
	$query->bindValue(':pseudo', $utilisateur->getPseudo());
	$query->bindValue(':niveau', $utilisateur->getNiveau());
	$query->bindValue(':avatar', $utilisateur->getAvatar());
    $query->bindValue(':admin', $utilisateur->getAdmin());
	$query->bindValue(':mot_de_passe', md5($utilisateur->getMotDePasse()));
	$query->bindValue(':id', $utilisateur->getID());

	$query->execute();

	}

	
	//On recherche les utilisateurs qui ont un pseudo qui contienne $pseudo (ce n'est pas une recherche exacte sur le pseudo donc on n'utilise pas get_par_Pseudo)
   public function recherchePseudo($pseudo){
      $sql4= "SELECT * FROM utilisateur WHERE pseudo LIKE '%$pseudo%' ORDER BY pseudo asc";
      $req4= $this->db->prepare($sql4); 
      $req4->execute(); //On réalise la requete 
      $row4 = $req4->fetchAll();
      $nbr4=count($row4); //Le nombre de résultats trouvés

      return array('nombre_pseudo' => $nbr4,'requete_pseudo' => $sql4);
  }


    public function rechercheAvanceePseudo($contenu_recherche,$date1,$date2, $url,$label,$popularite){
    /*
     On utilise les LEFT JOIN qui permettent de lister les enregistrements de table1 même s’il n’y a pas de correspondance avec table2

     Recherche parmi les utilisateurs précedemment sélectionnés par la recherche simple ceux :
     	- qui ont modifié / créé un marque_page entre $date1 et $date2
     	- qui ont modifié / créé un marque_page ayant l'url $url
     	- qui ont au moins un marque page modifié ou créé qui a une note supérieure ou égale à $popularité
     	- qui ont utilisés / créés le label $label

     	Attention: va afficher les pseudos qui ont forcement posté quelque chose, à cause du LEFT JOIN entre utilisateur.id et ajoute_modifie.id_utilisateur
    */
     if($date1=='' && $date2==''){
	     $sql = "SELECT DISTINCT pseudo, niveau, avatar, utilisateur.id from utilisateur

	      LEFT JOIN ajoute_modifie ON utilisateur.id = ajoute_modifie.id_utilisateur
	      LEFT JOIN marque_page ON marque_page.id = ajoute_modifie.id_marque_page
	      LEFT JOIN tag ON marque_page.id=tag.id_marque_page
	      

	      WHERE pseudo LIKE '%$contenu_recherche%' and marque_page.url LIKE '%$url%' and tag.label LIKE '%$label%' AND marque_page.note>=$popularite
			
	   
	    ORDER BY
	      pseudo asc

	     ";
	 }
	 else{
	     $sql = "SELECT DISTINCT pseudo, niveau, avatar, utilisateur.id from utilisateur

	      LEFT JOIN ajoute_modifie ON utilisateur.id = ajoute_modifie.id_utilisateur
	      LEFT JOIN marque_page ON marque_page.id = ajoute_modifie.id_marque_page
	      LEFT JOIN tag ON marque_page.id=tag.id_marque_page
	      

	      WHERE date_a>='$date1' and date_a<='$date2' AND utilisateur.pseudo LIKE '%$contenu_recherche%' and marque_page.url LIKE '%$url%' and tag.label LIKE '%$label%' AND marque_page.note>=$popularite
			
	   
	    ORDER BY
	      pseudo asc

	     ";
	}

    $req= $this->db->prepare($sql); 
    $req->execute(); //On réalise la requete 

    $row = $req->fetchAll();
    $nbr=count($row); //Le nombre de résultats trouvés
    return array('nombre_pseudo' => $nbr,'requete_pseudo' => $sql);
  }

   public function rechercheAvanceePseudoPlusieursTags($contenu_recherche,$date1,$date2, $url,$label,$popularite){
    /*
     On utilise les LEFT JOIN qui permettent de lister les enregistrements de table1 même s’il n’y a pas de correspondance avec table2

     Recherche parmi les utilisateurs précedemment sélectionnés par la recherche simple ceux :
     	- qui ont modifié / créé un marque_page entre $date1 et $date2
     	- qui ont modifié / créé un marque_page ayant l'url $url
     	- qui ont au moins un marque page modifié ou créé qui a une note supérieure ou égale à $popularité
     	- qui ont utilisés / créés le label $label

     	Attention: va afficher les pseudos qui ont forcement posté quelque chose, à cause du LEFT JOIN entre utilisateur.id et ajoute_modifie.id_utilisateur
    */
     if($date1=='' && $date2==''){
	     $sql = "SELECT DISTINCT pseudo, niveau, avatar, utilisateur.id from utilisateur

	      LEFT JOIN ajoute_modifie ON utilisateur.id = ajoute_modifie.id_utilisateur
	      LEFT JOIN marque_page ON marque_page.id = ajoute_modifie.id_marque_page
	      LEFT JOIN tag ON marque_page.id=tag.id_marque_page
	      

	      WHERE pseudo LIKE '%$contenu_recherche%' and marque_page.url LIKE '%$url%' and tag.label IN ($label) AND marque_page.note>=$popularite
			
	   
	    ORDER BY
	      pseudo asc

	     ";
	 }
	 else{
	     $sql = "SELECT DISTINCT pseudo, niveau, avatar, utilisateur.id from utilisateur

	      LEFT JOIN ajoute_modifie ON utilisateur.id = ajoute_modifie.id_utilisateur
	      LEFT JOIN marque_page ON marque_page.id = ajoute_modifie.id_marque_page
	      LEFT JOIN tag ON marque_page.id=tag.id_marque_page
	      

	      WHERE date_a>='$date1' and date_a<='$date2' AND utilisateur.pseudo LIKE '%$contenu_recherche%' and marque_page.url LIKE '%$url%' and tag.label IN ($label) AND marque_page.note>=$popularite
			
	   
	    ORDER BY
	      pseudo asc

	     ";
	}

    $req= $this->db->prepare($sql); 
    $req->execute(); //On réalise la requete 

    $row = $req->fetchAll();
    $nbr=count($row); //Le nombre de résultats trouvés
    return array('nombre_pseudo' => $nbr,'requete_pseudo' => $sql);
  }

  

  //Compte le nombre de marques pages créés ou modifiés (ajout d'une description à un marque-page existant) par l'utilisateur ayant l'id = $id
  public function nbMarquePage($id){
  	  $sql = "SELECT * FROM ajoute_modifie WHERE id_utilisateur=$id";
      $req = $this->db->prepare($sql); 
      $req->execute(); //On réalise la requete 
      $row = $req->fetchAll();
      $nbr = count($row); //Le nombre de résultats trouvés

      return $nbr;
  }

  	public function utilisateur_top_niveau(){
		$utilisateur = [];

		$query = $this->db->prepare('SELECT id, mail, pseudo, niveau, avatar, admin FROM utilisateur ORDER BY niveau  DESC LIMIT 6');
		$query->execute();

		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
			$utilisateur[] = $donnees;
		}
		return $utilisateur;
	}

	public function list_auteur(){
      $utilisateur = [];

      $query = $this->db->prepare('SELECT id, mail, pseudo, niveau, avatar, admin FROM utilisateur ORDER BY pseudo ASC');
      $query->execute();

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $utilisateur[] = $donnees;
    }

    return $utilisateur;
    }

    public function trie_auteur_par_alphabet($alphabet){
      $utilisateur = [];
      $query = $this->db->prepare("SELECT id, mail, pseudo, niveau, avatar, admin FROM utilisateur WHERE pseudo LIKE '$alphabet%' ORDER BY pseudo ASC");
      $query->execute();

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $utilisateur[] = $donnees;
    }

    return $utilisateur;
    }

    public function trie_auteur_par_nb_Mp_Postes(){
      $utilisateur = [];
      $query = $this->db->prepare("SELECT count(*), utilisateur.id, mail, pseudo, niveau, avatar, admin FROM utilisateur,ajoute_modifie WHERE utilisateur.id=ajoute_modifie.id_utilisateur AND createur=1 GROUP BY utilisateur.id ORDER BY COUNT(*) DESC");
      $query->execute();

    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
      $utilisateur[] = $donnees;
    }

    return $utilisateur;
    }


    public function getIdByPseudo($pseudo) { //Les pseudos sont uniques.

  	 $query = $this->db->prepare('SELECT id FROM utilisateur WHERE pseudo = "'.$pseudo.'" ');
  	 $query->execute();
  	 $res=$query->fetch(PDO::FETCH_ASSOC);

  	 return (int)$res;


    }


     public function getAvatarById($id) {


     	 $query = $this->db->prepare('SELECT avatar FROM utilisateur WHERE id = "'.$id.'" ');
     	 $query->execute();
  	 	 $res=$query->fetch(PDO::FETCH_ASSOC);

  	 	return $res;

     }



	public function setDb(PDO $db){
		$this->db = $db;
	}

	public function gestion_niveau($id){
		//il y a 3 niveaux : le premier niveau est bronze, le deuxieme niveau est argent, la 3eme niveau est or
		$niveau = $this->db->query('SELECT niveau FROM utilisateur WHERE id = '.$id)->fetchColumn();
		if($niveau <= 100){
			return 1;
		}
		else{
			if($niveau > 100 && $niveau <= 500){
				return 2;
			}
			else{
				return 3;
			}
		} 
	}

}

?>