<?php

/**
 * Gestion de la connexion
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
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS); //on filtre action pour verifier sa valeur et récupérer 
if (!$uc) {
    $uc = 'demandeconnexion';
}

switch ($action) {
    case 'demandeConnexion':
        include 'vues/v_connexion.php';
        break;
    case 'valideConnexion':
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_SPECIAL_CHARS);
        $visiteur = $pdo->getInfosVisiteur($login, $mdp); // contient le resultat de la fonction getInfosVisiteur cad (id, nom, prenom)dans un tableau
        $comptable = $pdo->getInfosComptable($login, $mdp);
        if (!is_array($visiteur) && !is_array($comptable)) {//is_arraye c'est dans un tableau
            echo'1';
            ajouterErreur('Login ou mot de passe incorrect'); //fonction qui renvoi un message
            include 'vues/v_erreurs.php'; //redirection vers vue erreurs et connexion 
            include 'vues/v_connexion.php';
        } elseif (is_array($visiteur)) {
            echo '2';
            $id = $visiteur['id'];
            $nom = $visiteur['nom'];
            $prenom = $visiteur['prenom'];
            $statut= 'visiteur';
            connecter($id, $nom, $prenom, $statut);
            header('Location: index.php'); // fonction qui renvoie le système vers l'index
        } elseif (is_array($comptable)) {
            echo '3';
            $id = $comptable['id'];
            $nom = $comptable['nom'];
            $prenom = $comptable['prenom'];
            $statut= 'comptable';
            connecter($id, $nom, $prenom, $statut);
            header('Location: index.php');// fonction qui renvoie le système vers l'index}
        }

        break;
    default: //si il est entré dans aucun case il renvoie vers vue connexion
        include 'vues/v_connexion.php';
        break;
}
