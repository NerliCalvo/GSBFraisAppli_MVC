<?php
/**
 * Index du projet GSB
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

require_once 'includes/fct.inc.php'; // on reste dans l'index et on fait apl à la page des fonctions sinon c'est fatal
require_once 'includes/class.pdogsb.inc.php'; 
session_start(); // fonction php qui lance la superglobale session 
$pdo = PdoGsb::getPdoGsb(); // on apl la fonction getPdoGsb() qui se trouve dans la classe Pdogsb
$estConnecte  = estConnecte();
$estConnecteV = estConnecteV(); //On affecte le résultat de la fonction estConnecte () à la variable estConnecte
$estConnecteC = estConnecteC();
require 'vues/v_entete.php'; // on fait apl à la page de vue si elle vient pas c'est pas grave 
$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_SPECIAL_CHARS); 
if ($uc && !$estConnecte) { // si y a quelque chose dans uc et estconnecte = a faux  
    $uc = 'connexion'; 
} elseif (empty($uc)) { // si uc est plein
    $uc = 'accueil';
}
switch ($uc) { // qd je test la meme variable (ici uc) si il y a plusieurs variables c'est un if
case 'connexion':
    include 'controleurs/c_connexion.php';
    break; // pour passer d'un case à l'autre
case 'accueil':
    include 'controleurs/c_accueil.php';
    break;
case 'gererFrais':
    include 'controleurs/c_gererFrais.php';
    break;
case 'etatFrais':
    include 'controleurs/c_etatFrais.php';
    break;
case 'deconnexion':
    include 'controleurs/c_deconnexion.php';
    break;
case 'validerFrais':
    include 'controleurs/c_validerFrais.php';
    break;
case 'mettreEnPaiement':
    include 'controleurs/c_mettreEnPaiement.php';
}
require 'vues/v_pied.php'; // on apl la vue pied mais on redirige pas 
