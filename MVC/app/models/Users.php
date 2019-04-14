<?php

namespace App\Model;

use App\Core\App;
use App\Controllers;

use \Exception;

class Users extends Model {
    public static function get() {
        return App::get('database')->select('personne');
    }

    public static function find($id) {
        $result = App::get('database')->select('personne', ['*'], ["idPersonne = $id"]);

        if(sizeOf($result) == 1) {
            return $result[0];
        } else {
            return false;
        }
    }

    public static function findByEmail($email) {
        $email = static::parseString($email);
        $result = App::get('database')->select('personne', ['*'], ["email = '$email'"]);
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
            "nom" => $filter,
            "prenom" => FILTER_SANITIZE_ENCODED,
            "email"=> FILTER_VALIDATE_EMAIL,
            "adresse"=> FILTER_SANITIZE_ENCODED,
            "ville" => FILTER_SANITIZE_ENCODED,
            "code_postal" => FILTER_SANITIZE_ENCODED, //TODO: Check for good code_postal
            "password" => FILTER_SANITIZE_ENCODED,
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
            return App::get('database')->insert('personne', $data);
        } catch(Exception $e) {
            $title = "Informations invalides";
            return require "app/views/users/__info-invalide.view.php";
        }  
    }
}