<div class="container mt-5">
    <h2 class="pt-3 text-center"><?php echo $mode;?> un auteur</h2>
    <form action="index.php?uc=auteurs&action=valideForm" method="post" class="col-md-6 offset-md-3 border border-primary p-3 rounded">
        
        <div class="form-group">
            <label for="libelle"> Nom </label>
            <input type="text" class="form-control" id="nom" placeholder="Saisir le nom" name="nom" value="<?php if($mode == "Modifier"){echo $auteur->getNom();}?>">
        </div>

        <div class="form-group">
            <label for="libelle"> Prénom </label>
            <input type="text" class="form-control" id="prenom" placeholder="Saisir le prénom" name="prenom" value="<?php if($mode == "Modifier"){echo $auteur->getPrenom();}?>">
        </div>

        <div class="form-group">
            <label for="libelle"> Nationalité </label>
            <select type="int" class="form-control" id="numNationalite" name="numNationalite">             
                <?php  
                $lesNationalites=Nationalite::findAll();
                if ($mode == "Ajouter")
                {
                    foreach($lesNationalites as $nationalite)
                    {
                        echo "<option value='" . $nationalite->getNum() . "'>" . $nationalite->getLibelle() . "</option>";
                    }
                }else{
                    foreach($lesNationalites as $nationalite)
                    {
                        $selection = $auteur->getNumNationalite() == $nationalite->getNum() ? 'selected': '';
                        echo "<option value='" . $nationalite->getNum() . "'$selection>" . $nationalite->getLibelle() . "</option>";
                    }
                }
                ?>
            </select>
        </div>


        <input type="hidden" id="num" name="num" value="<?php if($mode == "Modifier"){echo $auteur->getNum();}?>">
        <div class="row">
            <div class="col"><a href="index.php?uc=auteurs&action=list" class="btn btn-danger btn-block">Revenir à la liste <i class="fas fa-sign-out-alt"></i></a></div>
            <div class="col"><button type="submit" class="btn btn-success btn-block"><?php echo $mode;?> <i class="fas fa-check"></i></button></div>
        </div>

    </form>   
</div>
