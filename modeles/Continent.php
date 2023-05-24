<?php
class Continent {

    /**
     * numero du continent
     * 
     * @var int
     */
    private $num;

    /**
     * libelle du continent
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
     * Set numero du continent
     *
     * @param  int  $num  numero du continent
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
     * return l'ensemble des continents
     * 
     * @return Continent[] tableau d'objets continents
     */
    public static function findAll(?string $libelle="") :array 
    {
        if($libelle != ""){
            $req=MonPdo::getInstance()->prepare("Select * from continent where libelle like '%" . $libelle . "%'");
        }else{
            $req=MonPdo::getInstance()->prepare("Select * from continent");
        }
        //$req=MonPdo::getInstance()->prepare("Select * from continent");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Continent');
        $req->execute();
        $LesResultats=$req->fetchAll();
        return $LesResultats;
    }

    /**
     * trouve un continent par son num
     * 
     * @param integer $id
     * @return Continent
     */

    public static function findById (int $id) :Continent
    {
        $req=MonPdo::getInstance()->prepare("Select * from continent where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Continent');
        $req->bindParam(':id',$id);
        $req->execute();
        $LeResultat=$req->fetch();
        return $LeResultat;
    }

    /**
     * Permet d'ajouter un continent
     * 
     * @param Continent $continent continent à ajouter
     * @return integer (1 si l'opertion à réussi, 0 sinon)
     */
    public static function add(Continent $continent) :int
    {
        $req=MonPdo::getInstance()->prepare("insert into continent(libelle) values(:libelle)");
        $libelle=$continent->getLibelle();
        $req->bindParam(':libelle',$libelle);
        $nb=$req->execute();
        return $nb;
    }
 
    /**
     * permet de modifier un continent
     * 
     * @param Continent $continent continent à modifier
     * @return integer (1 si l'opertion à réussi, 0 sinon)
     */
    public static function update(Continent $continent) :int
    {
        $req=MonPdo::getInstance()->prepare("update continent set libelle= :libelle where num= :id");
        $num=$continent->getNum();
        $libelle=$continent->getLibelle();
        $req->bindParam(':id',$num);
        $req->bindParam(':libelle',$libelle);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * permet de suprimer un continent
     * 
     * @param Continent $continent
     * @return integer
     */
    public static function delete(Continent $continent) :int
    {
        $req=MonPdo::getInstance()->prepare("delete from continent where num= :id");
        $num=$continent->getNum();
        $req->bindParam(':id',$num);
        $nb=$req->execute();
        return $nb;
    }





}

?>