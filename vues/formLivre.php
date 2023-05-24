<div class="container mt-5">
    <h2 class="pt-3 text-center"><?php echo $mode;?> un livre</h2>
    <form action="index.php?uc=livres&action=valideForm" method="post" class="col-md-6 offset-md-3 border border-primary p-3 rounded">
        
        <div class="form-group">
            <label for="libelle"> ISBN </label>
            <input type="text" class="form-control" id="isbn" placeholder="Saisir le code ISBN" name="isbn" value="<?php if($mode == "Modifier"){echo $livre->getIsbn();}?>">
        </div>

        <div class="form-group">
            <label for="libelle"> Titre </label>
            <input type="text" class="form-control" id="titre" placeholder="Saisir le titre" name="titre" value="<?php if($mode == "Modifier"){echo $livre->getTitre();}?>">
        </div>

        <div class="form-group">
            <label for="libelle"> prix </label>
            <input type="number" class="form-control" id="prix" placeholder="Saisir le prix" name="prix" value="<?php if($mode == "Modifier"){echo $livre->getPrix();}?>">
        </div>

        <div class="form-group">
            <label for="libelle"> Editeur </label>
            <input type="text" class="form-control" id="editeur" placeholder="Saisir le nom de l'éditeur" name="editeur" value="<?php if($mode == "Modifier"){echo $livre->getEditeur();}?>">
        </div>
        <div class="form-group">
            <label for="libelle"> Année </label>
            <input type="number" class="form-control" id="annee" placeholder="Saisir l'année" name="annee" value="<?php if($mode == "Modifier"){echo $livre->getAnnee();}?>">
        </div>

        <div class="form-group">
            <label for="libelle"> Langue </label>
            <input type="text" class="form-control" id="langue" placeholder="Saisir la langue" name="langue" value="<?php if($mode == "Modifier"){echo $livre->getLangue();}?>">
        </div>


        <div class="form-group">
            <label for="libelle"> Auteur </label>
            <select type="int" class="form-control" id="numAuteur" name="numAuteur">             
                <?php  
                $lesAuteurs=Auteur::findAll();
                if ($mode == "Ajouter")
                {
                    foreach($lesAuteurs as $auteur)
                    {
                        echo "<option value='" . $auteur->getNum() . "'>" . $auteur->getNom() . " " .$auteur->getPrenom() . "</option>";
                    }
                }else{
                    foreach($lesAuteurs as $auteur)
                    {
                        $selection = $livre->getNumAuteur() == $auteur->getNum() ? 'selected': '';
                        echo "<option value='" . $auteur->getNum() . "'$selection>" . $auteur->getNom() . " " . $auteur->getPrenom() . "</option>";
                    }
                }
                ?>
            </select>
        </div>


        <div class="form-group">
            <label for="libelle"> Genre </label>
            <select type="int" class="form-control" id="numGenre" name="numGenre">             
                <?php  
                $lesGenres=Genre::findAll();
                if ($mode == "Ajouter")
                {
                    foreach($lesGenres as $genre)
                    {
                        echo "<option value='" . $genre->getNum() . "'>" . $genre->getLibelle() . "</option>";
                    }
                }else{
                    foreach($lesGenres as $genre)
                    {
                        $selection = $livre->getNumGenre() == $genre->getNum() ? 'selected': '';
                        echo "<option value='" . $genre->getNum() . "'$selection>" . $genre->getLibelle() . "</option>";
                    }
                }
                ?>
            </select>
        </div>

 


        <input type="hidden" id="num" name="num" value="<?php if($mode == "Modifier"){echo $auteur->getNum();}?>">
        <div class="row">
            <div class="col"><a href="index.php?uc=livres&action=list" class="btn btn-danger btn-block">Revenir à la liste <i class="fas fa-sign-out-alt"></i></a></div>
            <div class="col"><button type="submit" class="btn btn-success btn-block"><?php echo $mode;?> <i class="fas fa-check"></i></button></div>
        </div>

    </form>   
</div>
