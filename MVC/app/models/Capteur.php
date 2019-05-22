<?php
/**
 * Created by PhpStorm.
 * User: Jalef
 * Date: 22/05/2019
 * Time: 10:14
 */

namespace App\Model;

use App\Core\App;

use \Exception;


class Capteur extends Model
{
    public static function getById($id) {
        return App::get('database')->select('composants', ['*'], ["idComposant=$id"]);
    }

    public static function activate($id) {
        try {
            $parametre = [
                "idComposant" => $id,
                "active" => 1
            ];
            return App::get('database')->insert('log', $parametre);
        }catch (Exception $e){
            die($e->getMessage());
        }
    }
    public static function desactivate($id){
        try{
            return App::get('database')->delete('log',["idlog=$id"]);
        }catch (Exception $e){
            die($e->getMessage());
        }
    }

}