<div class="container mt-5">
    <div class="row pt-3">
        <div class="col-9"><h2>Liste des continents</h2></div>
        <div class="col-3"><a href="index.php?uc=continents&action=add" class="btn btn-success"><i class='far fa-plus-square'></i> Créer un continent</a></div>
    </div>

    <form action="index.php?uc=continents&action=list" method="post" class="border border-primary p-3 rounded m-3">
        <div class="row">

            <div class="col">
                <input type="text" class='form-control' id='libelle' placeholder='Saisir le libelle' name='libelle' value="<?php if(!empty($_GET['libelle'])) {echo $libelle;} ?>">
            </div>

            <div class="col">
                <button type="submit" class="btn btn-success btn-block ">Rechercher</button>
            </div>
        </div>
    </form>


    <table class="table table-hover table-striped">
        <thead>
            <tr class="d-flex">
                <th scope="col" class="col-md-4">Numéro</th>
                <th scope="col" class="col-md-5">Libellé</th>
                <th scope="col" class="col-md-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($lesContinents as $continent){
                echo "<tr class='d-flex'>";
                    echo "<td class='col-md-4'>" . $continent->getNum() . "</td>";
                    echo "<td class='col-md-5'>" . $continent->getLibelle() . "</td>";
                    echo "<td class='col-md-3'>
                        <a href='index.php?uc=continents&action=update&num=" . $continent->getNum() . "' class='btn btn-primary'><i class='far fa-edit'></i></a></div>
                        <a href='#modalSuppression' data-toggle='modal' data-message='Voulez-vous vraiment supprimer le continent " .  $continent->getLibelle() . " ?' data-suppression='index.php?uc=continents&action=delete&num=" . $continent->getNum() . "' class='btn btn-danger'><i class='far fa-trash-alt'></i></a></div>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>