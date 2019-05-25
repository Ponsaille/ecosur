<?php

namespace App\Model;

use App\Core\App;
use App\Controllers;
use App\Model\Users;

use \Exception;

class Board extends Model
{


    public static function findAppartementsByUser($userId)
    {
        return App::get('database')->select('domicile INNER JOIN abonnementproprietaire ON domicile.idDomicile = abonnementproprietaire.idDomicile AND abonnementproprietaire.idPersonne = ' . $userId, ['domicile.idDomicile', 'Titre', 'Adresse', 'code_postal', 'Ville', 'Pays']);

    }

    public static function findPieceByAppartement($idAppartement)
    {
        return App::get('database')->select('domicile INNER JOIN piece ON piece.idDomicile=domicile.idDomicile AND domicile.idDomicile= ' . $idAppartement, ['nom', 'idPiece', 'piece.idDomicile']);


    }

    public static function findStationsByPiece($idPiece)
    {
        return App::get('database')->select('piece INNER JOIN cemac ON piece.idPiece=cemac.idPiece AND piece.idPiece= ' . $idPiece, ['idCemac', 'nbObjet', 'cemac.Nom', 'Disponible', 'Descriptif', 'cemac.idPiece']);

    }

    public static function findCapteursByStation($idStation)
    {
        return App::get('database')->select('cemac INNER JOIN composants ON composants.idCemac=cemac.idCemac AND cemac.idCemac= ' . $idStation, ['idComposant', 'idtypeComposant', 'composants.idCemac']);

    }

    public static function findTypeComposantByCapteur($capteur)
    {
        return App::get('database')->select('composants INNER JOIN typeComposant ON composants.idtypeComposant=typeComposant.idtypeComposant AND composants.idComposant=' . $capteur, ['typeComposant.idtypeComposant', 'nom', 'type', 'icone']);
    }

    public static function RessourceAppartementByUser($userId)
    {
        $registre = [];
        $appartements = Board::findAppartementsByUser($userId);

        foreach ($appartements as $appartement) {
            $piecesFromBDD = Board::findPieceByAppartement($appartement->idDomicile);

            $pieces = [];
            foreach ($piecesFromBDD as $piece) {
                $stationsFromBDD = Board::findStationsByPiece($piece->idPiece);

                $stations = [];
                foreach ($stationsFromBDD as $station) {
                    $capteursFromBDD = Board::findCapteursByStation($station->idCemac);

                    $capteurs = [];
                    foreach ($capteursFromBDD as $capteur) {
                        $typeComposant = Board::findTypeComposantByCapteur($capteur->idComposant)[0];

                        $capteurs[$capteur->idComposant] = [
                            "capteur" => $capteur,
                            "typeComposant" => $typeComposant

                        ];
                    }
                    $stations[$station->idCemac] = [
                        "cemac" => $station,
                        "capteurs" => $capteurs
                    ];
                }
                $pieces[$piece->idPiece] = [
                    "piece" => $piece,
                    "cemac" => $stations
                ];
            }
            $registre[$appartement->idDomicile] = [
                "appartement" => $appartement,
                "pieces" => $pieces
            ];
        }
        $appartements = Users::getSecondaryHouses($userId);

        foreach ($appartements as $appartement) {
            $allowedTypes = Users::getAllowedTypes($userId, $appartement->idDomicile);
            $piecesFromBDD = Board::findPieceByAppartement($appartement->idDomicile);

            $pieces = [];
            foreach ($piecesFromBDD as $piece) {
                $stationsFromBDD = Board::findStationsByPiece($piece->idPiece);

                $stations = [];
                foreach ($stationsFromBDD as $station) {
                    $capteursFromBDD = Board::findCapteursByStation($station->idCemac);

                    $capteurs = [];
                    foreach ($capteursFromBDD as $capteur) {
                        $typeComposant = Board::findTypeComposantByCapteur($capteur->idComposant)[0];

                        if (in_array($typeComposant->idtypeComposant, $allowedTypes)) {
                            $capteurs[$capteur->idComposant] = ["capteur" => $capteur,
                                "typeComposant" => $typeComposant];
                        }
                    }
                    $stations[$station->idCemac] = [
                        "cemac" => $station,
                        "capteurs" => $capteurs
                    ];
                }
                $pieces[$piece->idPiece] = [
                    "piece" => $piece,
                    "cemac" => $stations
                ];
            }
            $registre[$appartement->idDomicile] = [
                "appartement" => $appartement,
                "pieces" => $pieces
            ];
        }
        return $registre;

    }




/// QU EST CE QUE RENVOIE LA FONCTION  RessourceAppartementByUser()  7
/// données[idappart]["pieces"][idpiece]["cemac"][idcemac]

    /*
    [
     idAppartement=> [
          "appartement" => Objet appartement avec ce que tu veux,
          "pieces" => [
                 idpièces => [
                     "pice" => Objet de la piece
                     "cemac" => [
                         idcemacs => [
                             "cemac"=>
                             "composant"=>

                         ]
                     ]
                 ]
                 "idPiece"=> [
                     "nbObjet" => Objet cemac choisis avec ce que tu veux,
                     "idCemac" => [
                         "NumeroCapteur"=>Objet compsants choisis avec ce que tu veux,
                         "idCapteur =>[
                             Objet typeComposant choisis avec ce que tu veux
                         ]

                     ]
                 ]
         ]
      ]
    ]
    */


/// QU EST CE QUE RENVOIE LA FONCTION  RessourceAppartementByUser()  7
/// données[idappart]["pieces"][idpiece]["cemac"][idcemac]

    /*
    [
     idAppartement=> [
          "appartement" => Objet appartement avec ce que tu veux,
          "pieces" => [
                 idpièces => [
                     "pice" => Objet de la piece
                     "cemac" => [
                         idcemacs => [
                             "cemac"=>
                             "composant"=>

                         ]
                     ]
                 ]
                 "idPiece"=> [
                     "nbObjet" => Objet cemac choisis avec ce que tu veux,
                     "idCemac" => [
                         "NumeroCapteur"=>Objet compsants choisis avec ce que tu veux,
                         "idCapteur =>[
                             Objet typeComposant choisis avec ce que tu veux
                         ]
                     ]
                 ]
         ]
      ]
    ]
    */


}
