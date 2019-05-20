<?php

namespace App\Model;

use App\Core\App;

use \Exception;

class Modifiables extends Model
{
    public static function get() {
        return App::get('database')->select('elementsmodifiables');
    }

    public static function getById($id) {
        return App::get('database')->select('elementsmodifiables', ['*'], ["idElementsModifiables=$id"]);
    }

    public static function update($id, $contenu) {
        return App::get('database')->update('elementsmodifiables', ["contenu" => htmlspecialchars($contenu)], ["idElementsModifiables=$id"]);
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
