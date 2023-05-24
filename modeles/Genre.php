<?php
class Genre {

    /**
     * numero du genre
     * 
     * @var int
     */
    private $num;

    /**
     * libelle du genre
     * 
     * 
     * @var string
     */
    private $libelle;


    /**
     * Get the value of num
     */ 
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set numero du genre
     *
     * @param  int  $num  numero du genre
     *
     * @return  self
     */ 
    public function setNum(int $num) :self
    {
        $this->num = $num;

        return $this;
    }

    /**
     * lit le libellé
     * 
     * @return string
     */ 
    public function getLibelle() : string
    {
        return $this->libelle;
    }

    /**
     * écrit dans le libellé
     * 
     * @param string $libelle
     * @return self
     */
    public function setLibelle(string $libelle) : self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * return l'ensemble des genres
     * 
     * @return Genre[] tableau d'objets genre
     */
    public static function findAll(?string $libelle="") :array 
    {
        if($libelle != ""){
            $req=MonPdo::getInstance()->prepare("Select * from genre where libelle like '%" . $libelle . "%'");//select num, libelle from genre
        }else{
            $req=MonPdo::getInstance()->prepare("Select * from genre");
        }
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Genre');
        $req->execute();
        $LesResultats=$req->fetchAll();
        return $LesResultats;
    }

    /**
     * trouve un genre par son num
     * 
     * @param integer $id
     * @return Genre
     */

    public static function findById (int $id) :Genre
    {
        $req=MonPdo::getInstance()->prepare("Select * from genre where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Genre');
        $req->bindParam(':id',$id);
        $req->execute();
        $LeResultat=$req->fetch();
        return $LeResultat;
    }

    /**
     * Permet d'ajouter un genre
     * 
     * @param Genre $genre genre à ajouter
     * @return integer (1 si l'opertion à réussi, 0 sinon)
     */
    public static function add(Genre $genre) :int
    {
        $req=MonPdo::getInstance()->prepare("insert into genre(libelle) values(:libelle)");
        $libelle=$genre->getLibelle();
        $req->bindParam(':libelle',$libelle);
        $nb=$req->execute();
        return $nb;
    }
 
    /**
     * permet de modifier un genre
     * 
     * @param Genre $genre genre à modifier
     * @return integer (1 si l'opertion à réussi, 0 sinon)
     */
    public static function update(Genre $genre) :int
    {
        $req=MonPdo::getInstance()->prepare("update genre set libelle= :libelle where num= :id");
        $num=$genre->getNum();
        $libelle=$genre->getLibelle();
        $req->bindParam(':id',$num);
        $req->bindParam(':libelle',$libelle);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * permet de suprimer un genre
     * 
     * @param Genre $genre
     * @return integer
     */
    public static function delete(Genre $genre) :int
    {
        $req=MonPdo::getInstance()->prepare("delete from genre where num= :id");
        $num=$genre->getNum();
        $req->bindParam(':id',$num);
        $nb=$req->execute();
        return $nb;
    }



}

?>