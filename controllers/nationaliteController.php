<?php
$action=$_GET['action'];
switch($action){
    case 'list':
        $libelle="";
        $leContinent=0;
        
        if(!empty($_POST['libelle'])){
            $libelle=$_POST['libelle'];
        }
        
        if(!empty($_POST['leContinent'])){
            $leContinent=$_POST['leContinent'];
        }
        
        $lesNationalites=Nationalite::findAll($libelle, $leContinent);
        include "vues/listeNationalites.php";

        break;
    case 'add':
        $mode='Ajouter';
        include "vues/formNationalite.php";
        break;
    case 'update':
        $mode='Modifier';
        $nationalite=nationalite::findById($_GET['num']);
        include "vues/formNationalite.php";
        break;
    case 'delete':
        $nationalite=Nationalite::findById($_GET['num']);
        $nb=Nationalite::delete($nationalite);
        if($nb==1){
            $_SESSION['message']=["success text-center mt-4"=>"Nickel! La nationalite " .  $nationalite->getLibelle() . " a bien été supprimé"];
        }else{
            $_SESSION['message']=["danger text-center mt-4"=>"La nationalite " .  $nationalite->getLibelle() . " n'a pu être suprimmé"];
        }
        header('location: index.php?uc=nationalites&action=list');
        //exit();
        break;

    case 'valideForm':
        $nationalite= new Nationalite();
        if(empty($_POST['num'])){ // cas d'une création
            $nationalite->setLibelle($_POST['libelle']);
            $nationalite->setNumContinent($_POST['numContinent']);
            $nb=Nationalite::add($nationalite);
            $message = "ajouté";
        }else{ // cas d'une modification
            $nationalite->setNum($_POST['num']);
            $nationalite->setLibelle($_POST['libelle']);
            $nationalite->setNumContinent($_POST['numContinent']);
            $nb=Nationalite::update($nationalite);
            $message = "modifié";
        }

        if($nb==1){
            $_SESSION['message']=["success text-center mt-4"=>"Super! La nationalite " .  $nationalite->getLibelle() . " a bien été $message"]; //success text-center mt-4
        }else{
            $_SESSION['message']=["danger text-center mt-4"=>"Oups! La nationalite " .  $nationalite->getLibelle() . " n'a pas été $message"];
        }

        header('location: index.php?uc=nationalites&action=list');
        //exit();
        break;
    
}

?>