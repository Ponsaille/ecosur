<?php

namespace App\Model;

use App\Core\App;
use App\Controllers;

use \Exception;

class Properties extends Model
{

    public static function store($data)
    {
        $filter = array('filter' => FILTER_CALLBACK, 'options' => function ($input) {
            $filtered = filter_var($input, FILTER_SANITIZE_STRING);
            return $filtered ? $filtered : false;
        });

        $args = [
            "titre" => $filter,
            "adresse" => FILTER_SANITIZE_ENCODED,
            "code_postal" => FILTER_SANITIZE_ENCODED, //TODO: Check for good code_postal
            "ville" => FILTER_SANITIZE_ENCODED,
            "pays" => FILTER_SANITIZE_ENCODED
        ];

        $data = filter_var_array($data, $args);

        // $data2 = [
        //     "DateDebut" => date('Y-m-d'),
        //     "DateFin" => date(Y-m-d, strtotime(date('Y-m-d') .'+1 years')),
        // ] LAST_INSERT_ID()

        try {
            //App::get('database')->insert('domicile', $data);

            $data = [
                "DateDebut" => getDate(),
                "DateFin" => date(Y - m - d, strtotime(date('Y-m-d') . '+1 years')),
                "idPersonne" => $_SESSION['user_id'],
                "idDomicile" => LAST_INSERT_ID()
            ];

            return App::get('database')->insert('abonnementproprietaire', $data);
        } catch (Exception $e) {
            $title = "Informations invalides";
            return die($e->getMessage()); //require "app/views/users/__info-invalide.view.php";
        }
    }
}
