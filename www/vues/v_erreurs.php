<?php
/**
 * Vue Erreurs
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>
<div class="alert alert-danger" role="alert">
    <?php
    foreach ($_REQUEST['erreurs'] as $erreur) { //foreach veut dire pour chaque ligne du tableau ici request a la colonne erreur
        echo '<p>' . htmlspecialchars($erreur) . '</p>'; // on affiche les lignes du tableau request a la collone erreur 
    }
    ?>
</div>