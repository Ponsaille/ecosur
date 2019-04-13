<?php

namespace App\Model;

class Model {
    protected static function parseString($string) {
        $string = trim($string);
        $string = stripslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }

    protected static function parseArrayString($array) {
        return array_map(static::parseString, $array);
    }
}