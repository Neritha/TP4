<?php
class Nationalite {

    /**
     * numero de la nationalité
     * 
     * @var int
     */
    private $num;

    /**
     * libelle de la nationalite
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
     * Set numero de la nationalité
     *
     * @param  int  $num  numero de la nationalité
     *
     * @return  self
     */ 
    public function setNum(int $num)
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
     * num continent (clef étrangère) relier à num de Continent
     * 
     * @var int
     */
    private $numContinent;

    /**
     * renvoi l'objet continent associé
     * 
     * @return Continent
     */ 
    public function getNumContinent() : Continent
    {
        return Continent::findById($this->numContinent);
    }

    /**
     * Set the value of numContinent
     *
     * @return  self
     */ 
    public function setNumContinent(Continent $continent) : self
    {
        $this->numContinent = $continent->getNum();

        return $this;
    }


    /**
     * return l'ensemble des nationalités
     * 
     * @return Nationalite[] tableau d'objets nationalites
     */
    public static function findAll() :array 
    {
        $req=MonPdo::getInstance()->prepare("select n.num, n.libelle as 'libNation', c.libelle as 'libContinent' from nationalite n, continent c where n.numContinent=c.num");
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $LesResultats=$req->fetchAll();
        return $LesResultats;
    }

    /**
     * trouve une nationalite par son num
     * 
     * @param integer $id
     * @return Nationalite
     */

    public static function findById (int $id) :Nationalite
    {
        $req=MonPdo::getInstance()->prepare("Select * from nationalite where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Nationalite');
        $req->bindParam(':id',$id);
        $req->execute();
        $LeResultat=$req->fetch();
        return $LeResultat;
    }

    /**
     * Permet d'ajouter une nationalite
     * 
     * @param Nationalite $nationalite cnationalite à ajouter
     * @return integer (1 si l'opertion à réussi, 0 sinon)
     */
    public static function add(Nationalite $nationalite) :int
    {
        $req=MonPdo::getInstance()->prepare("insert into nationalite(libelle,numContinent) values(:libelle, :numContinent)");
        $req->bindParam(':libelle',$nationalite->getLibelle());
        $req->bindParam(':numContinent',$nationalite->getNumContinent());
        $nb=$req->execute();
        return $nb;
    }

    /**
     * permet de modifier une nationalité
     * 
     * @param Nationalite $nationalite nationalite à modifier
     * @return integer (1 si l'opertion à réussi, 0 sinon)
     */
    public static function update(Nationalite $nationalite) :int
    {
        $req=MonPdo::getInstance()->prepare("update nationalite set libelle= :libelle, numContinent= :numContinent where num= :id");
        $req->bindParam(':id',$nationalite->getNum());
        $req->bindParam(':libelle',$nationalite->getLibelle());
        $req->bindParam(':numContinent',$nationalite->getNumContinent());
        $nb=$req->execute();
        return $nb;
    }

    /**
     * permet de suprimer une nationalite
     * 
     * @param Nationalite $nationalite
     * @return integer
     */
    public static function delete(Nationalite $nationalite) :int
    {
        $req=MonPdo::getInstance()->prepare("delete from nationalite where num= :id");
        $req->bindParam(':id',$nationalite->getNum());
        $nb=$req->execute();
        return $nb;
    }



}

?>