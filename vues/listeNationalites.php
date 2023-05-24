<div class="container mt-5">
    <div class="row pt-3">
        <div class="col-9"><h2>Liste des Nationalités</h2></div>
        <div class="col-3"><a href="index.php?uc=nationalites&action=add" class="btn btn-success"><i class='far fa-plus-square'></i> Créer une nationalité </a></div>
    </div>

    <form action="index.php?uc=nationalites&action=list" method="post" class="border border-primary p-3 rounded m-3">
        <div class="row">

            <div class="col">
                <input type="text" class='form-control' id='libelle' placeholder='Saisir le libelle' name='libelle' value="<?php if(!empty($_GET['libelle'])) {echo $libelle;} ?>">
            </div>

            <div class="col">
                <select type="int" class="form-control" id="leContinent" name="leContinent">             
                    <?php  
                    echo "<option value='0'>Choisir le continent</option>";
                    $lesContinents=Continent::findAll();
                    foreach($lesContinents as $continent)
                    {
                        echo "<option value=" . $continent->getNum() . ">" . $continent->getLibelle() .  "</option>";
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
                <th scope="col" class="col-md-3">Numéro</th>
                <th scope="col" class="col-md-3">Libellé</th>
                <th scope="col" class="col-md-3">Continent</th>
                <th scope="col" class="col-md-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($lesNationalites as $nationalite){
                $continent=Continent::findById($nationalite->getNumContinent());
                echo "<tr class='d-flex'>";
                    echo "<td class='col-md-3'>" . $nationalite->getNum() . "</td>";
                    echo "<td class='col-md-3'>" . $nationalite->getLibelle() . "</td>";
                    echo "<td class='col-md-3'>" . $continent->getLibelle() . "</td>";//foreach($lesContinents as $leContinent{$leContinent->findById($nationalite->getNumContinent())}$leContinent=Continent::findById($nationalite->getNumContinent());$leContinent->getLibelle()$leContinent->getLibelle($nationalite->getNumContinent())"à rajouter"
                    echo "<td class='col-md-3'>
                        <a href='index.php?uc=nationalites&action=update&num=" . $nationalite->getNum() . "' class='btn btn-primary'><i class='far fa-edit'></i></a></div>
                        <a href='#modalSuppression' data-toggle='modal' data-message='Voulez-vous vraiment supprimer la nationalités " .  $nationalite->getLibelle() . " ?' data-suppression='index.php?uc=nationalites&action=delete&num=" . $nationalite->getNum() . "' class='btn btn-danger'><i class='far fa-trash-alt'></i></a></div>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div> 


