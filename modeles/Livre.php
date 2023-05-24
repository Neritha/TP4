<?php
class Livre {

    /**
     * ISBN
     *
     * @var string
     */
    private $isbn;

    /**
     * titre du livre
     *
     * @var string
     */
     private $titre;

    /**
     * prix du livre
     *
     * @var int
     */
    private $prix;

    /**
     * editeur du livre
     *
     * @var string
     */
    private $editeur;

    /**
     * année de publication du livre
     *
     * @var int
     */
     private $annee;

    /**
    * langue du livre 
    *
    * @var string
    */
    private $langue;

    /**
     * numéro du livre
     *
     * @var int
     */
    private $num;


    /**
     * numéro correspondant à l'auteur
     *
     * @var int
     */
    private $numAuteur;

    /**
     * numéro correspondant au genre
     *
     * @var int
     */
    private $numGenre;


    /**
     * Get iSBN
     *
     * @return  string
     */ 
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set iSBN
     *
     * @param  string  $isbn  ISBN
     *
     * @return  self
     */ 
    public function setIsbn(string $isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }


    /**
     * Get titre du livre
    *
    * @return  string
    */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set titre du livre
     *
     * @param  string  $titre  titre du livre
     *
     * @return  self
     */ 
    public function setTitre(string $titre)
    {
        $this->titre = $titre;

        return $this;
    }


    /**
     * Get prix du livre
     *
     * @return  int
     */ 
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set prix du livre
     *
     * @param  int  $prix  prix du livre
     *
     * @return  self
     */ 
    public function setPrix(int $prix)
    {
        $this->prix = $prix;

        return $this;
    }


    /**
     * Get editeur du livre
     *
     * @return  string
     */ 
    public function getEditeur()
    {
        return $this->editeur;
    }

    /**
     * Set editeur du livre
     *
     * @param  string  $editeur  editeur du livre
     *
     * @return  self
     */ 
    public function setEditeur(string $editeur)
    {
        $this->editeur = $editeur;

        return $this;
    }

     /**
      * Get année de publication du livre
      *
      * @return  int
      */ 
      public function getAnnee()
      {
           return $this->annee;
      }
 
      /**
       * Set année de publication du livre
       *
       * @param  int  $annee  année de publication du livre
       *
       * @return  self
       */ 
      public function setAnnee(int $annee)
      {
           $this->annee = $annee;
 
           return $this;
      }
 


    /**
     * Get langue du livre
     *
     * @return  string
     */ 
    public function getLangue()
    {
        return $this->langue;
    }

    /**
     * Set langue du livre
     *
     * @param  string  $langue  langue du livre
     *
     * @return  self
     */ 
    public function setLangue(string $langue)
    {
        $this->langue = $langue;

        return $this;
    }


    /**
     * Get numéro du livre
     *
     * @return  int
     */ 
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set numéro du livre
     *
     * @param  int  $num  numéro du livre
     *
     * @return  self
     */ 
    public function setNum(int $num)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get numéro correspondant à l'auteur
     *
     * @return  int
     */ 
    public function getNumAuteur()
    {
        return $this->numAuteur;
    }

    /**
     * Set numéro correspondant à l'auteur
     *
     * @param  int  $numAuteur  numéro correspondant à l'auteur
     *
     * @return  self
     */ 
    public function setNumAuteur(int $numAuteur)
    {
        $this->numAuteur = $numAuteur;

        return $this;
    }

        /**
     * Get numéro correspondant au genre
     *
     * @return  int
     */ 
    public function getNumGenre()
    {
        return $this->numGenre;
    }

    /**
     * Set numéro correspondant au genre
     *
     * @param  int  $numGenre  numéro correspondant au genre
     *
     * @return  self
     */ 
    public function setNumGenre(int $numGenre)
    {
        $this->numGenre = $numGenre;

        return $this;
    }

    /**
     * return l'ensemble des livres
     * 
     * @return Livre[] tableau d'objets livres
     */
    public static function findAll(?string $titre="", ?int $lAuteur=0, ?int $leGenre=0) :array 
    {
        if($titre != ""){
            $req=MonPdo::getInstance()->prepare("Select * from livre where titre like '%" . $titre . "%'");
        }else{
            if($lAuteur != 0){
                $req=MonPdo::getInstance()->prepare("Select * from livre where numAuteur =" . $lAuteur . "");
            }else{
                if($leGenre != 0){
                    $req=MonPdo::getInstance()->prepare("Select * from livre where numGenre =" . $leGenre . "");
                }else{
                    $req=MonPdo::getInstance()->prepare("Select * from livre");
                }
            }
        }
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'livre');
        $req->execute();
        $LesResultats=$req->fetchAll();
        return $LesResultats;

        /*$req=MonPdo::getInstance()->prepare("Select * from livre");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'livre');
        $req->execute();
        $LesResultats=$req->fetchAll();
        return $LesResultats;
        */
    }

    /**
     * trouve un livre par son num
     * 
     * @param integer $id
     * @return Livre
     */

    public static function findById (int $id) :Livre
    {
        $req=MonPdo::getInstance()->prepare("Select * from livre where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Livre');
        $req->bindParam(':id',$id);
        $req->execute();
        $LeResultat=$req->fetch();
        return $LeResultat;
    }

    /**
     * Permet d'ajouter un livre
     * 
     * @param Livre $livre livre à ajouter
     * @return integer (1 si l'opertion à réussi, 0 sinon)
     */
    public static function add(Livre $livre) :int
    {
        $req=MonPdo::getInstance()->prepare("insert into livre(isbn, titre, prix, editeur, annee, langue, numGenre, numAuteur) values(:isbn, :titre, :prix, :editeur, :annee, :langue, :numGenre, :numAuteur)");
        $isbn=$livre->getIsbn();
        $titre=$livre->getTitre();
        $prix=$livre->getPrix();
        $editeur=$livre->getEditeur();
        $annee=$livre->getAnnee();
        $langue=$livre->getLangue();
        $numGenre=$livre->getNumGenre();
        $numAuteur=$livre->getNumAuteur();
        $req->bindParam(':isbn',$isbn);
        $req->bindParam(':titre',$titre);
        $req->bindParam(':prix',$prix);
        $req->bindParam(':editeur',$editeur);
        $req->bindParam(':annee',$annee);
        $req->bindParam(':langue',$langue);
        $req->bindParam(':numGenre',$numGenre);
        $req->bindParam(':numAuteur',$numAuteur);
        $nb=$req->execute();
        return $nb;
    }
  
    /**
     * permet de modifier un livre
     * 
     * @param Livre $livre livre à modifier
     * @return integer (1 si l'opertion à réussi, 0 sinon)
     */
    public static function update(Livre $livre) :int
    {
        $req=MonPdo::getInstance()->prepare("update livre set isbn= :isbn, titre= :titre, prix= :prix, editeur= :editeur, annee= :annee, langue= :langue, numGenre= :numGenre, numAuteur= :numAuteur where num= :id");
        $num=$livre->getNum();
        $isbn=$livre->getIsbn();
        $titre=$livre->getTitre();
        $prix=$livre->getPrix();
        $editeur=$livre->getEditeur();
        $annee=$livre->getAnnee();
        $langue=$livre->getLangue();
        $numGenre=$livre->getNumGenre();
        $numAuteur=$livre->getNumAuteur();
        $req->bindParam(':id',$num);
        $req->bindParam(':isbn',$isbn);
        $req->bindParam(':titre',$titre);
        $req->bindParam(':prix',$prix);
        $req->bindParam(':editeur',$editeur);
        $req->bindParam(':annee',$annee);
        $req->bindParam(':langue',$langue);
        $req->bindParam(':numGenre',$numGenre);
        $req->bindParam(':numAuteur',$numAuteur);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * permet de suprimer un livre
     * 
     * @param Livre $livre
     * @return integer
     */
    public static function delete(Livre $livre) :int
    {
        $req=MonPdo::getInstance()->prepare("delete from livre where num= :id");
        $num=$livre->getNum();
        $req->bindParam(':id',$num);
        $nb=$req->execute();
        return $nb;
    }

    public static function livreParGenre() :array
    {
        $texteReq="select ";

        $req=MonPdo::getInstance()->prepare($texteReq);
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'livre');
        $req->execute();
        $LesResultats=$req->fetchAll();
        return $LesResultats;

    }

}


?>