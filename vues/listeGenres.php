<div class="container mt-5">
    <div class="row pt-3">
        <div class="col-9"><h2>Liste des genres</h2></div>
        <div class="col-3"><a href="index.php?uc=genres&action=add" class="btn btn-success"><i class='far fa-plus-square'></i> Créer un genre</a></div>
    </div>

<?php
    //$texteReq="select num, libelle from genre";



    //$texteReq="select num, libelle from genre";
    /*
    if(!empty($_GET)){
        if($_GET['libelle'] != ""){$lesGenres.= " where libelle like '%" . $_GET['libelle'] . "%';";}
    }
    <!--barre de recherche-->
    <form ation="index.php?uc=genres&action=search" method="get" class="border border-primary p-3 rounded m-3">
        <div class="row">

            <div class="col">
                <input type="text" class="form-control" id="libelleG" placeholder="Saisir le libellé" name="libelleG" >
            </div>
            
            <div class="col">
                <button type="submit" class="btn btn-success btn-block">Rechercher</button>
            </div>
        </div>
    </form>

*/
?>
    <form action="index.php?uc=genres&action=list" method="post" class="border border-primary p-3 rounded m-3">
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
                <th scope="col" class="col-md-2">Numéro</th>
                <th scope="col" class="col-md-8">Libellé</th>
                <th scope="col" class="col-md-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($lesGenres as $genre){
                echo "<tr class='d-flex'>";
                    echo "<td class='col-md-2'>" . $genre->getNum() . "</td>";
                    echo "<td class='col-md-8'>" . $genre->getLibelle() . "</td>";
                    echo "<td class='col-md-2'>
                        <a href='index.php?uc=genres&action=update&num=" . $genre->getNum() . "' class='btn btn-primary'><i class='far fa-edit'></i></a></div>
                        <a href='#modalSuppression' data-toggle='modal' data-message='Voulez-vous vraiment supprimer le genre " .  $genre->getLibelle() . " ?' data-suppression='index.php?uc=genres&action=delete&num=" . $genre->getNum() . "' class='btn btn-danger'><i class='far fa-trash-alt'></i></a></div>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>