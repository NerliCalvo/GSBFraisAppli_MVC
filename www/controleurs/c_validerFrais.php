<?php

/**
 * Gestion de la validation de la fiche de frais
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

switch ($action) {
    case 'choixVisiteur':
        $visiteurs = $pdo->getVisiteurs();
        $lesCles[] = array_keys($visiteurs);
        $visiteurASelectionner = $lesCles[0];
        $mois2 = getLesDouzeDerniersMois();
        include 'vues/v_choixVisiteurEtMois.php';
        break;
    case 'afficherFrais':
        $lesvisiteurs = filter_input(INPUT_POST, 'lsVisiteur', FILTER_SANITIZE_SPECIAL_CHARS);
        $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
        //var_dump($mois, $lesvisiteurs);
        $visiteurs = $pdo->getVisiteurs();
        $visiteurASelectionner = $lesvisiteurs;
        $mois2 = getLesDouzeDerniersMois();
        $moisASelectionner = $mois;
        $lesFraisForfait = $pdo->getLesFraisForfait($lesvisiteurs, $mois);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($lesvisiteurs, $mois);
        
          if (empty($lesFraisForfait)&& empty($lesFraisHorsForfait)){
            ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
            include 'vues/v_erreurs.php';
            include 'vues/v_choixVisiteurEtMois.php';
            } else {
            
            $nbjustificatifs = $pdo->getNbjustificatifs($lesvisiteurs, $mois);
            include 'vues/v_validerFrais.php';
        }
        //var_dump($nbjustificatifs);
        break;
    case 'corrigerFraisForfait':
        // il recup les frais met a jours la bdd et reaffiche tt 
        $lesFraisF = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY); //récupère les frais
        //var_dump($lesFraisForfait);
        $lesvisiteurs = filter_input(INPUT_POST, 'lsVisiteur', FILTER_SANITIZE_SPECIAL_CHARS);
        $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
        $pdo->majFraisForfait($lesvisiteurs, $mois, $lesFraisF);
        //var_dump($mois);
        $mois2 = getLesDouzeDerniersMois();
        
        $lesFraisForfait = $pdo->getLesFraisForfait($lesvisiteurs, $mois);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($lesvisiteurs, $mois);
        $visiteurs = $pdo->getVisiteurs();
        $visiteurASelectionner = $lesvisiteurs;
        $moisASelectionner = $mois;
        $nbjustificatifs = $pdo->getNbjustificatifs($lesvisiteurs, $mois);
        include 'vues/v_validerFrais.php';
        break;
    case 'corrigerFraisHorsForfait':
        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS); // récupère les date des frais hors forfait
        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_SPECIAL_CHARS); // récupère les libelle des frais hors forfait
        $montant = filter_input(INPUT_POST, 'montant', FILTER_SANITIZE_SPECIAL_CHARS); // récupère les montant des frais hors forfait
        //var_dump($date,$libelle,$montant);
        $lesvisiteurs = filter_input(INPUT_POST, 'lsVisiteur', FILTER_SANITIZE_SPECIAL_CHARS);
        $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
        $idFrais = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
        var_dump($idFrais);
        //var_dump($lesvisiteurs, $mois);
        $nbjustificatifs = $pdo->getNbjustificatifs($lesvisiteurs, $mois);
        if (isset($_POST["corriger"])) {
            $mois2 = getLesDouzeDerniersMois();
            $moisASelectionner = $mois;
            $pdo->majFraisHorsForfait($lesvisiteurs, $mois, $libelle, $date, $montant);
            $lesFraisForfait = $pdo->getLesFraisForfait($lesvisiteurs, $mois);
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($lesvisiteurs, $mois);
            $visiteurs = $pdo->getVisiteurs();
            $visiteurASelectionner = $lesvisiteurs;
        }
        if (isset($_POST["reporter"])) {
            $mois2 = getLesDouzeDerniersMois();
            $moisASelectionner = $mois;
            $lesFraisForfait = $pdo->getLesFraisForfait($lesvisiteurs, $mois);
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($lesvisiteurs, $mois);
            $visiteurs = $pdo->getVisiteurs();
            $visiteurASelectionner = $lesvisiteurs;
            $libelle = "REPORTE " . $libelle;
            $pdo->majFraisHorsForfait($lesvisiteurs, $mois, $libelle, $date, $montant);
            $mois = $mois + 1;
            //var_dump($mois);
            $pdo->creeNouveauFraisHorsForfait($lesvisiteurs, $mois, $libelle, $date, $montant);
        }
        if (isset($_POST["supprimer"])) {
            $mois2 = getLesDouzeDerniersMois();
            $moisASelectionner = $mois;
            $lesFraisForfait = $pdo->getLesFraisForfait($lesvisiteurs, $mois);
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($lesvisiteurs, $mois);
            $visiteurs = $pdo->getVisiteurs();
            $visiteurASelectionner = $lesvisiteurs;
            //$pdo->supprimerFraisHorsForfait($idFrais);
        }
        include 'vues/v_validerFrais.php';
        break;
    case 'validerFrais':
        $lesvisiteurs = filter_input(INPUT_POST, 'lsVisiteur', FILTER_SANITIZE_SPECIAL_CHARS);
        $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
        var_dump($lesvisiteurs, $mois);
        $totalFraisHorsForfait = $pdo->getTotalFraisHorsForfait($lesvisiteurs, $mois);
        var_dump($totalFraisHorsForfait);
        $TotalFraisForfait = $pdo->getTotalFraisForfait($lesvisiteurs, $mois);
        var_dump($TotalFraisForfait);
        $TotalFrais = $totalFraisHorsForfait[0][0] + $TotalFraisForfait[0][0];
        var_dump($TotalFrais) ;
        $montantValide = $pdo->majMontantValide($lesvisiteurs, $mois, $TotalFrais);
        $idetat = $pdo->majEtatFicheFrais($lesvisiteurs, $mois, 'VA');
        $VisiteurFicheValide = $pdo->getLeVisiteur($lesvisiteurs);
        $nom =  $VisiteurFicheValide['nom'];
        $prenom =  $VisiteurFicheValide['prenom'];
        var_dump($VisiteurFicheValide);
        include 'vues/v_validerAvecSucces.php';
        break;
}



        

