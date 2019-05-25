<?php

namespace App\Model;

use App\Core\App;

use \Exception;

class IdTemporaire extends Model
{
    public static function generate($idPersonne) {
        $idTemporaire = bin2hex(random_bytes(5));
        $data = [
            "idPersonne" => $idPersonne,
            "value" => $idTemporaire
        ];
        App::get('database')->insert('idtemporaire', $data);
        
        return $idTemporaire;
    }

    public static function useKey($idPersonne, $key) {
        $keys = App::get('database')->select('idtemporaire', ['*'], ["idPersonne = $idPersonne", "value = '$key'", "used = 0"]);
        if(count($keys) > 0) {
            App::get('database')->update('idtemporaire', ["used" => '1'], ["idTemporaire = " . $keys[0]->idTemporaire]);
            return true;
        } else {
            return false;
        }
    }
}
