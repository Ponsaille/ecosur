<?php

namespace App\Model;

use App\Core\App;
use App\Model\Board;

use \Exception;


class Composant extends Model
{
    public static function getById($id) {
        return App::get('database')->select('composants', ['*'], ["idComposant=$id"]);
    }

    public static function activate($id) {
        try {
            $logs =  App::get('database')->select('log', ['*'], ["idComposant=$id ORDER BY date DESC"]);
            if(count($logs) == 0 || (count($logs) != 0 && $logs[0]->active == 0)) {
                App::get('database')->insert('log', [
                    "idComposant" => $id,
                    "active" => 1
                ]);
                return true;
            } else {
                return false;
            }
        }catch (Exception $e){
            die($e->getMessage());
        }
    }
    public static function desactivate($id){
        try{
            $logs =  App::get('database')->select('log', ['*'], ["idComposant=$id ORDER BY date DESC"]);
            if(count($logs) == 0 || (count($logs) != 0 && $logs[0]->active == 1)) {
                App::get('database')->insert('log', [
                    "idComposant" => $id,
                    "active" => 0
                ]);
                return true;
            } else {
                return false;
            }
        }catch (Exception $e){
            die($e->getMessage());
        }
    }
    public static function orderedByTypes($idDomicile) {
        try {
            $componants = [];
            
            $pieces = Board::findPieceByAppartement($idDomicile);

            foreach ($pieces as $piece) {
                $stations = Board::findStationsByPiece($piece->idPiece);

                foreach ($stations as $station) {
                    $composantsTemp = Board::findCapteursByStation($station->idCemac);
                    foreach ($composantsTemp as $composant) {
                        $componants[$composant->idtypeComposant][] = (array) $composant;
                    }
                }
            }

            return $componants;

        } catch (Exception $e) {

            die($e->getMessage());

        }
    }

    public static function getLogs($idComposant) {
        try {

            return App::get('database')->select('log', ['*'], ['idComposant = '.$idComposant. ' ORDER BY date DESC']);

        } catch (Exception $e) {

            die($e->getMessage());

        }
    }

    public static function getLogsByTypes($idDomicile) {
        $result = static::orderedByTypes($idDomicile);

        $result = array_map(function($type) {
            return array_map(function($componant) {
                $logs = static::getLogs($componant['idComposant']);
                $componant['logs'] = $logs;
                return $componant;
            }, $type);
        }, $result);

        return $result;
    }
}