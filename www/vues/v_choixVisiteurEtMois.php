     <form action="index.php?uc=validerFrais&action=afficherFrais" 
          method="post" role="form">   
<div class="col-md-4">
   
        <div class="form-group">
            <label for="lsVisiteur" accesskey="n">Choisir le visiteur : </label>
            <select id="lsVisiteur" name="lsVisiteur" class="form-control">
                <?php
                foreach ($lesvisiteurs as $unVisiteurs) {
                    $id = $unVisiteurs['id'];
                    $nom = $unVisiteurs['nom'];
                    $prenom = $unVisiteurs['prenom'];
                    if ($id == $visiteurASelectionner) {
                        ?>
                        <option selected value="<?php echo $id ?>">
                            <?php echo $nom . ' ' . $prenom ?> </option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo $id ?>">
                            <?php echo $nom . ' ' . $prenom ?> </option>
                        <?php
                    }
                }
                ?>     

            </select>
        </div>
        <input id="ok" type="submit" value="Valider" class="btn btn-success" 
               role="button">
   
</div>



<div class="col-md-4"></div>
<div class="col-md-4">

        <div class="form-group">
            <label for="lstMois" accesskey="n">Mois : </label>
            <select id="lstMois" name="lstMois" class="form-control">
                <?php
                foreach ($mois as $unMois) {
                    $mois = $unMois['mois'];
                    $numAnnee = $unMois['numAnnee'];
                    $numMois = $unMois['numMois'];
                    if ($mois == $moisASelectionner) {
                        ?>
                        <option selected value="<?php echo $mois ?>">
                            <?php echo $numMois . '/' . $numAnnee ?> </option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo $mois ?>">
                            <?php echo $numMois . '/' . $numAnnee ?> </option>
                        <?php
                    }
                }
                ?>    

            </select>
        </div>

</div>
</div>
    </form>