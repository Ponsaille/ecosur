<?php

namespace App\Model;

use App\Core\App;
use App\Controllers;

use \Exception;

class Board extends Model
{


    public static function findAppartementsByUser(){
        return App::get('database')->select('domicile INNER JOIN abonnementproprietaire ON domicile.idDomicile = abonnementproprietaire.idDomicile AND abonnementproprietaire.idPersonne = ' . $_SESSION['user_id'], ['domicile.idDomicile' ,'Titre', 'Adresse', 'code_postal', 'Ville', 'Pays']);

    }

    public static function findPieceByAppartement($idAppartement){
        return App::get('database')->select('domicile INNER JOIN piece ON piece.idDomicile=domicile.idDomicile AND domicile.idDomicile= ' . $idAppartement, ['nom', 'idPiece', 'piece.idDomicile']);


    }

    public static function findStationsByPiece($idPiece){
        return App::get('database')->select('piece INNER JOIN cemac ON piece.idPiece=cemac.idPiece AND piece.idPiece= ' . $idPiece, ['idCemac', 'nbObjet', 'cemac.Nom', 'Disponible', 'Descriptif','cemac.idPiece']);

    }
    public static function findCapteursByStation($idStation){
        return App::get('database')->select('cemac INNER JOIN composants ON composants.idCemac=cemac.idCemac AND cemac.idCemac= '.$idStation,['idComposant','idtypeComposant','composants.idCemac']);
        
    }
    

    public static function findTypeComposantByCapteur($capteur){
        return App::get('database')->select('composants INNER JOIN typeComposant ON composants.idtypeComposant=typeComposant.idtypeComposant AND composants.idComposant='.$capteur,['typeComposant.idtypeComposant','nom','type','icone']);
    }

    

   public static function RessourceAppartementByUser(){

    $registre=[];
    
    $appartement=Board::findAppartementsByUser();
    foreach ($appartement as $i => $value1){
        $piece=Board::findPieceByAppartement($appartement[$i]->idDomicile);
        foreach ($piece as $j => $value2){
            $station=Board::findStationsByPiece($piece[$j]->idPiece);
            foreach ($station as $k => $value3){
                $capteur=Board::findCapteursByStation($station[$k]->idCemac);
                foreach ($capteur as $l => $value4){
                    $typeComposant=Board::findTypeComposantByCapteur($capteur[$l]->idtypeComposant);
                    foreach ($typeComposant as $m => $value5){
            
                        $registre+=[$appartement[$i]->idDomicile =>["appartement" => $appartement[$i] , 
                                                                    "piece" =>[
                                                                                $piece[$j]->idPiece=>[
                                                                                                        "piece" => $piece[$j] ,
                                                                                                        "cemac" =>[
                                                                                                                    $station[$k]->idCemac=>[
                                                                                                                                                "camec" => $station[$k], 
                                                                                                                                                "capteur"=>[$capteur[$l]->idComposant=> [
                                                                                                                                                                                        "capteur"=>$capteur[$l],
                                                                                                                                                                                        "typeComposant"=>[
                                                                                                                                                                                                            $typeComposant[$m]]]]]]]]]];

                    }
                }       
            }
        }


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
                            "cemacs" => [
                                idcemacs => [

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
