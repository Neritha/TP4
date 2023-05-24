<?php
$action=$_GET['action'];
switch($action){
    case 'list':
        //traitement du fortmulaire de recherche
        $libelle="";
        if(!empty($_POST['libelle'])){
            $libelle=$_POST['libelle'];
        }
        $lesGenres=Genre::findAll($libelle);

        //$lesGenres=Genre::findAll();
        include "vues/listeGenres.php";
        break;
    case 'add':
        $mode='Ajouter';
        include "vues/formGenre.php";
        break;
    case 'update':
        $mode='Modifier';
        $genre=Genre::findById($_GET['num']);
        include "vues/formGenre.php";
        break;
    case 'delete':
        $genre=Genre::findById($_GET['num']);
        $nb=Genre::delete($genre);
        if($nb==1){
            $_SESSION['message']=["success text-center mt-4"=>"Nickel! Le genre " .  $genre->getLibelle() . " a bien été supprimé"];
        }else{
            $_SESSION['message']=["danger text-center mt-4"=>"Le genre " .  $genre->getLibelle() . " n'a pu être suprimmé"];
        }
        header('location: index.php?uc=genres&action=list');
        //exit();
        break;

    case 'valideForm':
        $genre= new Genre();
        if(empty($_POST['num'])){ // cas d'une création
            $genre->setLibelle($_POST['libelle']);
            $nb=Genre::add($genre);
            $message = "ajouté";
        }else{ // cas d'une modification
            $genre->setNum($_POST['num']);
            $genre->setLibelle($_POST['libelle']);
            $nb=Genre::update($genre);
            $message = "modifié";
        }

        if($nb==1){
            $_SESSION['message']=["success text-center mt-4"=>"Super! Le genre " .  $genre->getLibelle() . " a bien été $message"]; //success text-center mt-4
        }else{
            $_SESSION['message']=["danger text-center mt-4"=>"Oups! Le genre " .  $genre->getLibelle() . " n'a pas été $message"];
        }

        header('location: index.php?uc=genres&action=list');
        //exit();
        break;
    /*case 'search':
        $lesGenres=Genre::findAll();
        $lesGenres.=" where libelle like '%" . $_GET['libelle'] . "%';";
        include "vues/listeGenres.php";
        break;
    */
}

?>