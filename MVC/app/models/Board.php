<?php

namespace App\Model;

use App\Core\App;
use App\Controllers;

use \Exception;

class Properties extends Model
{
    public static function findCapteurbyUser($idUtilisateur){
        // Récup toutes les appartements des utilisateurs
        // Pour chaque appartement (for loop) tu récupère les les stations
        // Pour chaque station tu récupère les capteurs
        // Tu met tout dans une liste
        /*App::get('database')->select('cemac INNER JOIN piece ON piece.idPiece=cemac.idPiece INNER JOIN composants ON composants.idCemac=cemac.idCemac INNER JOIN domicile ON piece.idDomicile=domicile.idDomicile INNER JOIN abonnementproprietaire ON abonnementproproetaire.idAbonnementProprietaire=domicile.idDomicile INNER JOIN personne ON personne.idPersonne=abonnementproprietaire.idPersonne AND abonnementproprietaire.idPersonne = ' . $_SESSION['user_id'], ['piece.idPiece', 'cemac.idCemac', 'composant.Titre', 'domicile.idDomicile', 'domicile.Titre']);*/
        /*
         [
             0 => [
                 "properties" => ce que tu récupère de findAppartementsByUser (l'objet)
                 "stations" => [
                     0 => ce que tu récupère dans findCapteursByStation
                 ]
             ]
         ]
        */
    }

    public static function findAppartementsByUser(){
        return App::get('database')->select('domicile INNER JOIN abonnementproprietaire ON domicile.idDomicile = abonnementproprietaire.idDomicile AND abonnementproprietaire.idPersonne = ' . $_SESSION['user_id'], ['Titre', 'Adresse', 'code_postal', 'Ville', 'Pays']);

    }
    /*
        [
            0 => appartement objet (idAppartement)
        ]
    */

    public static function findStationsByPiece($idPiece){
        return App::get('database')->select('piece INNER JOIN cemac ON piece.idPiece=cemac.idPiece AND piece.idPiece= ' . $idPiece, ['idCemac', 'nbObjet', 'Nom', 'Disponible', 'Descriptif','idPiece',]);

    }

    public static function findPieceByAppartement($idAppartement){
        return App::get('database')->select('domicile INNER JOIN piece ON piece.idDomicile=domicile.idDomicile AND domicile.idDomicile= ' . $idAppartement, ['nom', 'idPiece', 'idDomicile']);


    }

    public static function findCapteursByStattion($idAppartement){

    }

   
}
