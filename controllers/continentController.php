<?php
$action=$_GET['action'];
switch($action){
    case 'list':
        
        $libelle="";
        if(!empty($_POST['libelle'])){
            $libelle=$_POST['libelle'];
        }
        $lesContinents=Continent::findAll($libelle);

        include "vues/listeContinents.php";
        break;
    case 'add':
        $mode='Ajouter';
        include "vues/formContinent.php";
        break;
    case 'update':
        $mode='Modifier';
        $continent=Continent::findById($_GET['num']);
        include "vues/formContinent.php";
        break;
    case 'delete':
        $continent=Continent::findById($_GET['num']);
        $nb=Continent::delete($continent);
        if($nb==1){
            $_SESSION['message']=["success text-center mt-4"=>"Nickel! Le continent " .  $continent->getLibelle() . " a bien été supprimé"];
        }else{
            $_SESSION['message']=["danger text-center mt-4"=>"Le continent " .  $continent->getLibelle() . " n'a pu être suprimmé"];
        }
        header('location: index.php?uc=continents&action=list');
        //exit();
        break;

    case 'valideForm':
        $continent= new Continent();
        if(empty($_POST['num'])){ // cas d'une création
            $continent->setLibelle($_POST['libelle']);
            $nb=Continent::add($continent);
            $message = "ajouté";
        }else{ // cas d'une modification
            $continent->setNum($_POST['num']);
            $continent->setLibelle($_POST['libelle']);
            $nb=Continent::update($continent);
            $message = "modifié";
        }

        if($nb==1){
            $_SESSION['message']=["success text-center mt-4"=>"Super! Le continent " .  $continent->getLibelle() . " a bien été $message"]; //success text-center mt-4
        }else{
            $_SESSION['message']=["danger text-center mt-4"=>"Oups! Le continent " .  $continent->getLibelle() . " n'a pas été $message"];
        }

        header('location: index.php?uc=continents&action=list');
        //exit();
        break;
    
}

?>