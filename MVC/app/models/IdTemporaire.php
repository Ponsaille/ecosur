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
}
