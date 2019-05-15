<?php

namespace App\Model;

use App\Core\App;

use \Exception;

class TypeComposant extends Model
{
    public static function get() {
        return App::get('database')->select('typeComposant');
    }

    public static function getById($id) {
        return App::get('database')->select('typeComposant', ['*'], ["idtypeComposant=$id"]);
    }

    public static function store($nom, $type, $icone) {
        $data = [
            "nom" => $nom,
            "type" => $type,
            "icone" => $icone
        ];
        return App::get('database')->insert('typeComposant', $data);
    }

    public static function update($id, $nom, $type, $icone) {
        $data = [
            "nom" => $nom,
            "type" => $type,
            "icone" => $icone
        ];
        return App::get('database')->update('typeComposant', $data, ["idtypeComposant=$id"]);
    }

    public static function orderedByTitre() {
        $modifiables = static::get();
        $result = [];
        foreach ($modifiables as $modifiable) {
            $result[$modifiable->titre] = $modifiable;
        }
        return $result;
    }
}
