<?php
$action=$_GET['action'];
switch($action){
    case 'list':
        //$lesLivres=Livre::findAll();
        //include "vues/listeLivres.php";

        $titre="";
        $lAuteur=0;
        $leGenre=0;
        
        if(!empty($_POST['titre'])){
            $titre=$_POST['titre'];
        }

        if(!empty($_POST['lAuteur'])){
            $lAuteur=$_POST['lAuteur'];
        }
        
        if(!empty($_POST['leGenre'])){
            $leGenre=$_POST['leGenre'];
        }
        
        $lesLivres=Livre::findAll($titre, $lAuteur, $leGenre);
        include "vues/listeLivres.php";


        break;
    case 'add':
        $mode='Ajouter';
        include "vues/formLivre.php";
        break;
    case 'update':
        $mode='Modifier';
        $livre=Livre::findById($_GET['num']);
        include "vues/formLivre.php";
        break;
    case 'delete':
        $livre=Livre::findById($_GET['num']);
        $nb=Livre::delete($livre);
        if($nb==1){
            $_SESSION['message']=["success text-center mt-4"=>"Nickel! Le livre " .  $livre->getTitre() . " a bien été supprimé"];
        }else{
            $_SESSION['message']=["danger text-center mt-4"=>"Le livre " .  $livre->getTitre() . " n'a pu être suprimmé"];
        }
        header('location: index.php?uc=livres&action=list');
        //exit();
        break;

    case 'valideForm':
        $livre= new Livre();
        if(empty($_POST['num'])){ // cas d'une création
            $livre->setIsbn($_POST['isbn']);
            $livre->setTitre($_POST['titre']);
            $livre->setPrix($_POST['prix']);
            $livre->setEditeur($_POST['editeur']);
            $livre->setAnnee($_POST['annee']);
            $livre->setLangue($_POST['langue']);
            $livre->setNumGenre($_POST['numGenre']);
            $livre->setNumAuteur($_POST['numAuteur']);
            $nb=Livre::add($livre);
            $message = "ajouté";
        }else{ // cas d'une modification
            $livre->setNum($_POST['num']);
            $livre->setIsbn($_POST['isbn']);
            $livre->setTitre($_POST['titre']);
            $livre->setPrix($_POST['prix']);
            $livre->setEditeur($_POST['editeur']);
            $livre->setAnnee($_POST['annee']);
            $livre->setLangue($_POST['langue']);
            $livre->setNumGenre($_POST['numGenre']);
            $livre->setNumAuteur($_POST['numAuteur']);
            $nb=Livre::update($livre);
            $message = "modifié";
        }

        if($nb==1){
            $_SESSION['message']=["success text-center mt-4"=>"Super! Le livre " .  $livre->getTitre() . " a bien été $message"]; //success text-center mt-4
        }else{
            $_SESSION['message']=["danger text-center mt-4"=>"Oups! Le livre " .  $livre->getTitre() . " n'a pas été $message"];
        }

        header('location: index.php?uc=livres&action=list');
        //exit();
        break;
    
}

?>