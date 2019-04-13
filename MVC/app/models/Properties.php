<?php

namespace App\Model;

use App\Core\App;
use App\Controllers;

use \Exception;

class Properties extends Model {

    public static function get() {
        return App::get('database')->select('domicile');
    }

    public static function find($id) {
        $result = App::get('database')->select('domicile', ['*'], ["idDomicile = $id"]);

        if(sizeOf($result) == 1) {
            return $result[0];
        } else {
            return false;
        }
    }

    public static function findByOwner($IdPersonne) {
        $owner = static::parseString($IdPersonne);
        $result = App::get('database')->select('domicile', ['*'], ["IdPersonne = '$idPersonne'"]);
        if(sizeOf($result) == 1) {
            return $result[0];
        } else {
            return false;
        }
    }

    public static function store($data) {
        $filter = array('filter' => FILTER_CALLBACK, 'options' => function ($input) {
            $filtered = filter_var($input, FILTER_SANITIZE_STRING);
            return $filtered ? $filtered : false;
        });

        $args = [
            "titre" => $filter,
            "adresse"=> FILTER_SANITIZE_ENCODED,
            "ville" => FILTER_SANITIZE_ENCODED,
            "code_postal" => FILTER_SANITIZE_ENCODED, //TODO: Check for good code_postal
            "pays" => FILTER_SANITIZE_ENCODED
        ];

        $data = filter_var_array($data, $args);

        $errors = [];

        array_walk($data, function($val, $key) use(&$errors) {
            if(!$val) {
                $errors[] = $key;
            }
        });

        if(sizeof($errors) > 0) {
            $title = "Informations erronnées";
            return require "app/views/users/__input-erronnee.view.php";
        }

        try {
            return App::get('database')->insert('domicile', $data);
        } catch(Exception $e) {
            $title = "Informations invalides";
            return require "app/views/users/__info-invalide.view.php";
        }  
    }



}