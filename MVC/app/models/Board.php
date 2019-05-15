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
        return App::get('database')->select('cemac INNER JOIN composants ON composants.idCemac=cemac.idCemac AND cemac.idCemac= '.$idStation,['idComposants','NumeroCapteur','idtypeComposant','composants.idCemac']);
        
    }
    

    public static function findTypeComposantByCapteur($capteur){
        return App::get('database')->select('composants INNER JOIN typeComposant ON composants.idtypeComposant=typeComposant.idtypeComposant AND composants.idComposants='.$capteur,['typeComposant.idtypeComposant','nom','type','icone']);
    }

    

   public static function RessourceAppartementByUser(){

    $registre=[];
    
    $appartement=Board::findAppartementsByUser();
    $tailleAppartement= sizeof($appartement);
    for($i=0;$i<$tailleAppartement;$i++){
        $piece=Board::findPieceByAppartement($appartement[$i]->idDomicile);
        $taillePiece = sizeof($piece);
        for ($j=0;$j<$taillePiece;$j++){
            $station=Board::findStationsByPiece($piece[$j]->idPiece);
            $tailleStation = sizeof($station);
            for ($k=0;$k<$tailleStation;$k++){
                $capteur=Board::findCapteursByStation($station[$k]->idCemac);
                $tailleCapteur = sizeof($capteur);
                for ($l=0;$l<$tailleCapteur;$l++){
                    $typeComposant=Board::findTypeComposantByCapteur($capteur[$l]->idtypeComposant);
                    $tailleTypeComposant = sizeof( $typeComposant);
                    for ($m=0;$m<$tailleTypeComposant;$m++){
            
                        $registre+=[$appartement[$i]->idDomicile =>[$appartement[$i] ,$appartement[$i]->idDomicile  =>[$piece[$j] , $piece[$j]->idPiece =>[$station[$k]->nbObjet=>$station[$k], $station[$k]->idCemac=>[$capteur[$l]->NumeroCapteur=> $capteur[$l], $capteur[$l]->idtypeComposant=>[$typeComposant[$m]]]]]]];

                    }
                }       
            }
        }


    }

    return $registre;

   }
   /// QU EST CE QUE RENVOIE LA FONCTION  RessourceAppartementByUser()  

           /*
         [
            idAppartement=> [
                 Objet appartement avec ce que tu veux,
                 "idAppartement" => [
                                    Objet piece avec ce que tu veux,
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
