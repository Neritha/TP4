<?php
class Nationalite {

    /**
     * numero de la nationalite
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
     * numéro du continent
     *
     * @var int
     */
    private $numContinent;


    /**
     * Get numéro du continent
     *
     * @return  int
     */ 
    public function getNumContinent()
    {
        return $this->numContinent;
    }

    /**
     * Set numéro du continent
     *
     * @param  int  $numContinent  numéro du continent
     *
     * @return  self
     */ 
    public function setNumContinent(int $numContinent)
    {
        $this->numContinent = $numContinent;

        return $this;
    }
    
    /**
     * Get the value of num
     */ 
    public function getNum()
    {
        return $this->num;
    }

    
    /**
     * Set numero de la nationalite
     *
     * @param  int  $num  numero de la nationalite
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

    //public static function libelleNumContinent(int $nb) : string
    //{
      //  $resultat=getLibelle(Continent::findById($nb));
        //return getLibelle($resultat);
    //}



    /**
     * return l'ensemble des nationalites
     * 
     * @return Nationalite[] tableau d'objets nationalites
     */
    public static function findAll(?string $libelle="", ?int $leContinent=0):array 
    {
        if($libelle != ""){
            $req=MonPdo::getInstance()->prepare("Select * from nationalite where libelle like '%" . $libelle . "%'");
        }else{
            if($leContinent != 0){
            $req=MonPdo::getInstance()->prepare("Select * from nationalite where numContinent =" . $leContinent . "");

            }else{
                $req=MonPdo::getInstance()->prepare("Select * from nationalite");
            }
        }
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Nationalite');
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
     * Permet d'ajouter un nationalite
     * 
     * @param Nationalite $nationalite nationalite à ajouter
     * @return integer (1 si l'opertion à réussi, 0 sinon)
     */
    public static function add(Nationalite $nationalite) :int
    {
        $req=MonPdo::getInstance()->prepare("insert into nationalite(libelle, numContinent) values(:libelle, :numContinent)");
        $libelle=$nationalite->getLibelle();
        $numContinent=$nationalite->getNumContinent();
        $req->bindParam(':libelle',$libelle);
        $req->bindParam(':numContinent',$numContinent);
        $nb=$req->execute();
        return $nb;
    }
 
    /**
     * permet de modifier une nationalite
     * 
     * @param Nationalite $nationalite nationalite à modifier
     * @return integer (1 si l'opertion à réussi, 0 sinon)
     */
    public static function update(Nationalite $nationalite) :int
    {
        $req=MonPdo::getInstance()->prepare("update nationalite set libelle= :libelle, numContinent= :numContinent where num= :id");
        $num=$nationalite->getNum();
        $libelle=$nationalite->getLibelle();
        $numContinent=$nationalite->getNumContinent();
        $req->bindParam(':id',$num);
        $req->bindParam(':libelle',$libelle);
        $req->bindParam(':numContinent',$numContinent);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * permet de suprimer un nationalite
     * 
     * @param Nationalite $nationalite
     * @return integer
     */
    public static function delete(Nationalite $nationalite) :int
    {
        $req=MonPdo::getInstance()->prepare("delete from nationalite where num= :id");
        $num=$nationalite->getNum();
        $req->bindParam(':id',$num);
        $nb=$req->execute();
        return $nb;
    }

}

?>