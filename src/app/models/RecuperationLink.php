<?php

namespace App\Model;

use App\Core\App;

use \Exception;

class RecuperationLink extends Model
{
    public static function generate($idPersonne) {
        $token = bin2hex(random_bytes(5));
        $data = [
            "idPersonne" => $idPersonne,
            "token" => $token
        ];
        App::get('database')->insert('recuperationLink', $data);
        
        return $token;
    }

    public static function exists($idPersonne, $key) {
        $keys = App::get('database')->select('recuperationLink', ['*'], ["idPersonne = $idPersonne", "token = '$key'", "used = 0"]);
        return count($keys) > 0 ? true : false;
    }

    public static function useKey($idPersonne, $key) {
        $keys = App::get('database')->select('recuperationLink', ['*'], ["idPersonne = $idPersonne", "token = '$key'", "used = 0"]);
        if(static::exists($idPersonne, $key)) {
            App::get('database')->update('recuperationLink', ["used" => '1'], ["id = " . $keys[0]->id]);
            return true;
        } else {
            return false;
        }
    }
}
