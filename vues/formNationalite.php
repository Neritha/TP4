<div class="container mt-5">
    <h2 class="pt-3 text-center"><?php echo $mode;?> une nationalité</h2>
    <form action="index.php?uc=nationalites&action=valideForm" method="post" class="col-md-6 offset-md-3 border border-primary p-3 rounded">
        
        <div class="form-group">
            <label for="libelle"> Libelle </label>
            <input type="text" class="form-control" id="libelle" placeholder="Saisir le libelle" name="libelle" value="<?php if($mode == "Modifier"){echo $nationalite->getLibelle();}?>">
        </div>

        <div class="form-group">
            <label for="libelle"> Continent </label>
            <select type="int" class="form-control" id="numContinent" name="numContinent">             
                <?php  
                $lesContinents=Continent::findAll();
                if ($mode == "Ajouter")
                {
                    foreach($lesContinents as $continent)
                    {
                        echo "<option value='" . $continent->getNum() . "'>" . $continent->getLibelle() . "</option>";
                    }
                }else{
                    foreach($lesContinents as $continent)
                    {
                        $selection = $nationalite->getNumContinent() == $continent->getNum() ? 'selected': '';
                        echo "<option value='" . $continent->getNum() . "'$selection>" . $continent->getLibelle() . "</option>";
                    }
                }
                ?>
            </select>
        </div>

        <input type="hidden" id="num" name="num" value="<?php if($mode == "Modifier"){echo $nationalite->getNum();}?>">
        <div class="row">
            <div class="col"><a href="index.php?uc=nationalites&action=list" class="btn btn-danger btn-block">Revenir à la liste <i class="fas fa-sign-out-alt"></i></a></div>
            <div class="col"><button type="submit" class="btn btn-success btn-block"><?php echo $mode;?> <i class="fas fa-check"></i></button></div>
        </div>

    </form>   
</div>
