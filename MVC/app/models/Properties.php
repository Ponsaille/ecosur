<?php

namespace App\Model;

use App\Core\App;
use \Exception;

class Properties extends Model
{

    public static function findPropertiesByConnectedUser()
    {
        return App::get('database')->select('domicile INNER JOIN abonnementproprietaire ON domicile.idDomicile = abonnementproprietaire.idDomicile AND abonnementproprietaire.idPersonne = ' . $_SESSION['user_id'], ['Titre', 'Adresse', 'code_postal', 'Ville', 'Pays']);

    }

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

        try {
            App::get('database')->insert('domicile', $data);

            $data = [
                "DateDebut" => getDate(),
                "DateFin" => date(Y - m - d, strtotime(date('Y-m-d') . '+1 years')),
                "idPersonne" => $_SESSION['user_id'],
                "idDomicile" => getLastInsertId()
            ];

            return App::get('database')->insert('abonnementproprietaire', $data);
        } catch (Exception $e) {
            $title = "Informations invalides";
            return die($e->getMessage()); //require "app/views/users/__info-invalide.view.php";
        }
    }
}
