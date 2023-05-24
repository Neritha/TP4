<div class="container mt-5">
    <div class="row pt-3">
        <div class="col-9"><h2>Liste des livres</h2></div>
        <div class="col-3"><a href="index.php?uc=livres&action=add" class="btn btn-success"><i class='far fa-plus-square'></i> Ajouter un livre </a></div>
    </div>

    <form action="index.php?uc=livres&action=list" method="post" class="border border-primary p-3 rounded m-3">
        <div class="row">

            <div class="col">
                <input type="text" class='form-control' id='titre' placeholder='Saisir le titre' name='titre' value="<?php if(!empty($_GET['titre'])) {echo $titre;} ?>">
            </div>

            <div class="col">
                <select type="int" class="form-control" id="lAuteur" name="lAuteur">             
                    <?php  
                    echo "<option value='0'>Choisir l'auteur</option>";
                    $lesAuteurs=Auteur::findAll();
                    foreach($lesAuteurs as $auteur)
                    {
                        echo "<option value='" . $auteur->getNum() . "'>" . $auteur->getNom() . " " . $auteur->getPrenom() . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col">
                <select type="int" class="form-control" id="leGenre" name="leGenre">             
                    <?php  
                    echo "<option value='0'>Choisir le genre</option>";
                    $lesGenres=Genre::findAll();
                    foreach($lesGenres as $genre)
                    {
                        echo "<option value='" . $genre->getNum() . "'>" . $genre->getLibelle() . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col">
                <button type="submit" class="btn btn-success btn-block ">Rechercher</button>
            </div>
        </div>
    </form>

    <table class="table table-hover table-striped">
        <thead>
            <tr class="d-flex">
                <th scope="col" class="col-md-1">Numéro</th>
                <th scope="col" class="col-md-2">ISBN</th>
                <th scope="col" class="col-md-2">Titre</th>
                <th scope="col" class="col-md-1">Prix (€)</th>
                <th scope="col" class="col-md-1">Edieur</th>
                <th scope="col" class="col-md-1">Année</th>
                <th scope="col" class="col-md-1">Langue</th>
                <th scope="col" class="col-md-1">Auteur</th>
                <th scope="col" class="col-md-1">Genre</th>
                <th scope="col" class="col-md-1">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($lesLivres as $livre){
                $auteur=Auteur::findById($livre->getNumAuteur());
                $genre=Genre::findById($livre->getNumGenre());
                echo "<tr class='d-flex'>";
                    echo "<td class='col-md-1'>" . $livre->getNum() . "</td>";
                    echo "<td class='col-md-2'>" . $livre->getIsbn() . "</td>";
                    echo "<td class='col-md-2'>" . $livre->getTitre() . "</td>";
                    echo "<td class='col-md-1'>" . $livre->getPrix() . "</td>";
                    echo "<td class='col-md-1'>" . $livre->getEditeur() . "</td>";
                    echo "<td class='col-md-1'>" . $livre->getAnnee() . "</td>";
                    echo "<td class='col-md-1'>" . $livre->getLangue() . "</td>";
                    echo "<td class='col-md-1'>" . $auteur->getNom() ." ". $auteur->getPrenom() . "</td>"; // voire pour ajouter le prénon
                    echo "<td class='col-md-1'>" . $genre->getLibelle() . "</td>"; 
                    echo "<td class='col-md-1'>
                        <a href='index.php?uc=livres&action=update&num=" . $livre->getNum() . "' class='btn btn-primary'><i class='far fa-edit'></i></a></div>
                        <a href='#modalSuppression' data-toggle='modal' data-message='Voulez-vous vraiment supprimer le livre " .  $livre->getTitre() . " ?' data-suppression='index.php?uc=livres&action=delete&num=" . $livre->getNum() . "' class='btn btn-danger'><i class='far fa-trash-alt'></i></a></div>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>