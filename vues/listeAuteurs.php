<div class="container mt-5">
    <div class="row pt-3">
        <div class="col-9"><h2>Liste des auteurs</h2></div>
        <div class="col-3"><a href="index.php?uc=auteurs&action=add" class="btn btn-success"><i class='far fa-plus-square'></i> Créer un auteur</a></div>
    </div>


    <form action="index.php?uc=auteurs&action=list" method="post" class="border border-primary p-3 rounded m-3">
        <div class="row">

            <div class="col">
                <input type="text" class='form-control' id='nom' placeholder='Saisir le nom' name='nom' value="<?php if(!empty($_GET['nom'])) {echo $nom;} ?>">
            </div>

            <div class="col">
                <input type="text" class='form-control' id='prenom' placeholder='Saisir le prenom' name='prenom' value="<?php if(!empty($_GET['prenom'])) {echo $prenom;} ?>">
            </div>

            <div class="col">
                <select type="int" class="form-control" id="laNationalite" name="laNationalite">             
                    <?php  
                    echo "<option value='0'>Choisir la nationalite</option>";
                    $lesNationalites=Nationalite::findAll();
                    foreach($lesNationalites as $nationalite)
                    {
                        echo "<option value='" . $nationalite->getNum() . "'>" . $nationalite->getLibelle() . "</option>";
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
                <th scope="col" class="col-md-3">Nom</th>
                <th scope="col" class="col-md-3">Prénom</th>
                <th scope="col" class="col-md-3">Nationalité</th>
                <th scope="col" class="col-md-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($lesAuteurs as $auteur){
                $nationalite=Nationalite::findById($auteur->getNumNationalite());
                echo "<tr class='d-flex'>";
                    echo "<td class='col-md-1'>" . $auteur->getNum() . "</td>";
                    echo "<td class='col-md-3'>" . $auteur->getNom() . "</td>";
                    echo "<td class='col-md-3'>" . $auteur->getPrenom() . "</td>";
                    echo "<td class='col-md-3'>" . $nationalite->getLibelle() . "</td>"; 
                    echo "<td class='col-md-2'>
                        <a href='index.php?uc=auteurs&action=update&num=" . $auteur->getNum() . "' class='btn btn-primary'><i class='far fa-edit'></i></a></div>
                        <a href='#modalSuppression' data-toggle='modal' data-message='Voulez-vous vraiment supprimer " .  $auteur->getNom() . " " . $auteur->getPrenom() .   " de la liste des auteurs ?' data-suppression='index.php?uc=auteurs&action=delete&num=" . $auteur->getNum() . "' class='btn btn-danger'><i class='far fa-trash-alt'></i></a></div>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>


