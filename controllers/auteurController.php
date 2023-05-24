<?php
$action=$_GET['action'];
switch($action){
    case 'list':
        //$lesAuteurs=Auteur::findAll();
        //include "vues/listeAuteurs.php";

        $nom="";
        $prenom="";
        $laNationalite=0;
        
        if(!empty($_POST['nom'])){
            $nom=$_POST['nom'];
        }

        if(!empty($_POST['prenom'])){
            $prenom=$_POST['prenom'];
        }
        
        if(!empty($_POST['laNationalite'])){
            $laNationalite=$_POST['laNationalite'];
        }
        
        $lesAuteurs=Auteur::findAll($nom, $prenom, $laNationalite);
        include "vues/listeAuteurs.php";



        break;
    case 'add':
        $mode='Ajouter';
        include "vues/formAuteur.php";
        break;
    case 'update':
        $mode='Modifier';
        $auteur=Auteur::findById($_GET['num']);
        include "vues/formAuteur.php";
        break;
    case 'delete':
        $auteur=Auteur::findById($_GET['num']);
        $nb=Auteur::delete($auteur);
        if($nb==1){
            $_SESSION['message']=["success text-center mt-4"=>"Nickel! L'auteur " .  $auteur->getNom() . " a bien été supprimé"];
        }else{
            $_SESSION['message']=["danger text-center mt-4"=>"L'auteur " .  $auteur->getNom() . " n'a pu être suprimmé"];
        }
        header('location: index.php?uc=auteurs&action=list');
        //exit();
        break;

    case 'valideForm':
        $auteur= new Auteur();
        if(empty($_POST['num'])){ // cas d'une création
            $auteur->setNom($_POST['nom']);
            $auteur->setPrenom($_POST['prenom']);
            $auteur->setNumNationalite($_POST['numNationalite']);
            $nb=Auteur::add($auteur);
            $message = "ajouté";
        }else{ // cas d'une modification
            $auteur->setNum($_POST['num']);
            $auteur->setNom($_POST['nom']);
            $auteur->setPrenom($_POST['prenom']);
            $auteur->setNumNationalite($_POST['numNationalite']);
            $nb=Auteur::update($auteur);
            $message = "modifié";
        }

        if($nb==1){
            $_SESSION['message']=["success text-center mt-4"=>"Super! L'auteur·e " .  $auteur->getNom() . " " . $auteur->getPrenom() .  " a bien été $message"]; //success text-center mt-4
        }else{
            $_SESSION['message']=["danger text-center mt-4"=>"Oups! L'auteur·e " .  $auteur->getNom() . " " . $auteur->getPrenom() . " n'a pas été $message"];
        }

        header('location: index.php?uc=auteurs&action=list');
        //exit();
        break;
    
}

?>