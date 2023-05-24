<?php
class Auteur {

    /**
     * numero de l'auteur
     * 
     * @var int
     */
    private $num;

    /**
     * nom de l'auteur
     * 
     * 
     * @var string
     */
    private $nom;

    /**
     * prenom de l'auteur
     * 
     * 
     * @var string
     */
    private $prenom;

    /**
     * numéro de la nationalite associé
     *
     * @var int
     */
    private $numNationalite;


    /**
     * Get the value of num
     */ 
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set numero de l'auteur
     *
     * @param  int  $num  numero de l'auteur
     *
     * @return  self
     */ 
    public function setNum(int $num) :self
    {
        $this->num = $num;

        return $this;
    }

    /**
     * lit le nom
     * 
     * @return string
     */ 
    public function getNom() : string
    {
        return $this->nom;
    }

    /**
     * écrit dans le nom
     * 
     * @param string $nom
     * @return self
     */
    public function setNom(string $nom) : self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get prenom de l'auteur
     *
     * @return  string
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set prenom de l'auteur
     *
     * @param  string  $prenom  prenom de l'auteur
     *
     * @return  self
     */ 
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    
    /**
     * Get numéro de la nationalite associé
     *
     * @return  int
     */ 
    public function getNumNationalite()
    {
        return $this->numNationalite;
    }

    /**
     * Set numéro de la nationalite associé
     *
     * @param  int  $numNationalite  numéro de la nationalite associé
     *
     * @return  self
     */ 
    public function setNumNationalite(int $numNationalite)
    {
        $this->numNationalite = $numNationalite;

        return $this;
    }



    /**
     * return l'ensemble des auteurs
     * 
     * @return Auteur[] tableau d'objets auteur
     */
    
    public static function findAll(?string $nom="", ?string $prenom="", ?int $laNationalite=0) :array 
    {

        if($nom != ""){
            $req=MonPdo::getInstance()->prepare("Select * from auteur where nom like '%" . $nom . "%'");
        }else{
            if($prenom != ""){
                $req=MonPdo::getInstance()->prepare("Select * from auteur where prenom like '%" . $prenom . "%'");
            }else{
                if($laNationalite != 0){
                    $req=MonPdo::getInstance()->prepare("Select * from auteur where numNationalite =" . $laNationalite . "");
                }else{
                    $req=MonPdo::getInstance()->prepare("Select * from auteur");
                }
            }
        }
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Auteur');
        $req->execute();
        $LesResultats=$req->fetchAll();
        return $LesResultats;
    }

    /**
     * trouve un auteur par son num
     * 
     * @param integer $id
     * @return Auteur
     */

    public static function findById (int $id) :Auteur
    {
        $req=MonPdo::getInstance()->prepare("Select * from auteur where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Auteur');
        $req->bindParam(':id',$id);
        $req->execute();
        $LeResultat=$req->fetch();
        return $LeResultat;
    }

    /**
     * Permet d'ajouter un auteur
     * 
     * @param Auteur $auteur auteur à ajouter
     * @return integer (1 si l'opertion à réussi, 0 sinon)
     */
    public static function add(Auteur $auteur) :int
    {
        $req=MonPdo::getInstance()->prepare("insert into auteur(nom,prenom,numNationalite) values(:nom, :prenom, :numNationalite)");
        $nom=$auteur->getNom();
        $prenom=$auteur->getPrenom();
        $numNationalite=$auteur->getNumNationalite();
        $req->bindParam(':nom',$nom);
        $req->bindParam(':prenom',$prenom);
        $req->bindParam(':numNationalite',$numNationalite);
        $nb=$req->execute();
        return $nb;
    }
 
    /**
     * permet de modifier un auteur
     * 
     * @param Auteur $auteur auteur à modifier
     * @return integer (1 si l'opertion à réussi, 0 sinon)
     */
    public static function update(Auteur $auteur) :int
    {
        $req=MonPdo::getInstance()->prepare("update auteur set nom= :nom, prenom= :prenom, numNationalite= :numNationalite where num= :id");
        $num=$auteur->getNum();
        $nom=$auteur->getNom();
        $prenom=$auteur->getPrenom();
        $numNationalite=$auteur->getNumNationalite();
        $req->bindParam(':id',$num);
        $req->bindParam(':nom',$nom);
        $req->bindParam(':prenom',$prenom);
        $req->bindParam(':numNationalite',$numNationalite);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * permet de suprimer un auteur
     * 
     * @param Auteur $auteur
     * @return integer
     */
    public static function delete(Auteur $auteur) :int
    {
        $req=MonPdo::getInstance()->prepare("delete from auteur where num= :id");
        $num=$auteur->getNum();
        $req->bindParam(':id',$num);
        $nb=$req->execute();
        return $nb;
    }






}

?>