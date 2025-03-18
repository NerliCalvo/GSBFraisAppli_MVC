<form action="index.php?uc=validerFrais&action=corrigerFraisForfait" 
      method="post" role="form"> 
    <div class="row">

        <div class="col-md-4">

            <div class="form-group">

                <label for="lsVisiteur" accesskey="n">Visiteur : </label>
                <select id="lsVisiteur" name="lsVisiteur" class="form-control">
                    <?php
                    foreach ($visiteurs as $unVisiteurs) {
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
        </div>



        <div class="col-md-4"></div>
        <div class="col-md-4">

            <div class="form-group">
                <label for="lstMois" accesskey="n">Mois : </label>
                <select id="lstMois" name="lstMois" class="form-control">
                    <?php
                    foreach ($mois2 as $unMois) {
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






    <div class="row">    
        <h2 style="color: orange">Valider la fiche de frais 
        </h2>
        <h3>Eléments forfaitisés</h3>
        <div class="col-md-4">

            <fieldset>       
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite'];
                    ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="10" maxlength="5" 
                               value="<?php echo $quantite ?>" 
                               class="form-control">
                    </div>
                    <?php
                }
                ?>
                <button class="btn btn-success" type="submit">Corriger</button>
                <button class="btn btn-danger" type="reset">Réinitialiser</button>
            </fieldset>

        </div>
    </div>
</form>

<hr>
<form action="index.php?uc=validerFrais&action=corrigerFraisHorsForfait" role="form" method="post">
    <div class="row">
        <input type="hidden" name="lsVisiteur" value="<?php echo $visiteurASelectionner ?>"/>
        <input type="hidden" name="lstMois" value="<?php echo $moisASelectionner ?>"/>
        <div class="panel panel-info"style="border-color: orange">
            <div class="panel-heading" style ="background-color: orange; color: white">Descriptif des éléments hors forfait</div> 
            <table class="table table-bordered table-responsive"style="border-color: orange">
                <thead>
                    <tr>
                        <th style="border-color: orange" class="date" > Date</th> 
                        <th style="border-color: orange" class="libelle">Libellé</th>  
                        <th style="border-color: orange" class="montant">Montant</th>  
                        <th style="border-color: orange" class="action">&nbsp;</th> 
                    </tr>
                </thead>  
                <tbody>
                    <?php
                    foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                        $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                        $date = $unFraisHorsForfait['date'];
                        $montant = $unFraisHorsForfait['montant'];
                        $id = $unFraisHorsForfait['id'];
                        ?>           
                        <tr>
                            <td style="border-color: orange"><input type="hidden" name="id" value="<?php echo $id ?>"/><input type="text" value="<?php echo $date ?>" name="date"/></td>
                            <td style="border-color: orange"><input type="text"  value="<?php echo $libelle ?>" name="libelle"/></td>
                            <td style="border-color: orange"><input type="text" value="<?php echo $montant ?>" name="montant"/></td>
                            <td style="border-color: orange">
                                <input id="corriger" name="corriger" type="submit" value="Corriger" class="btn-success"/>
                                <input id="reporter" name="reporter" type="submit" value="Reporter" class="btn-success"/>
                                <input id="supprimer" name="supprimer" type="submit" value="Supprimer" class="btn-danger"/>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>  
            </table>
        </div>
    </div>
</form>
<p>Nombres de justificatifs : <input type="text" value="<?php echo $nbjustificatifs ?>"/><p> 
<form action="index.php?uc=validerFrais&action=validerFrais" role="form" method="post">
    <input type="hidden" name="lsVisiteur" value="<?php echo $visiteurASelectionner ?>"/>
    <input type="hidden" name="lstMois" value="<?php echo $moisASelectionner ?>"/>
    <button class="btn btn-success" type="submit">Valider</button>
</form>

