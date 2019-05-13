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
}
