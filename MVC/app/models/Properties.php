<?php

namespace App\Model;

use App\Core\App;
use \Exception;

class Properties extends Model
{

    public static function findPropertiesByConnectedUser()
    {
        return App::get('database')->select('domicile INNER JOIN abonnementproprietaire ON domicile.idDomicile = abonnementproprietaire.idDomicile AND abonnementproprietaire.idPersonne = ' . $_SESSION['user_id'], ['domicile.idDomicile', 'Titre', 'Adresse', 'code_postal', 'Ville', 'Pays']);
    }

    public static function findRoomsByProperties($idsProperties)
    {
        $rooms = [];
        foreach ($idsProperties as $idProperty) {
            $a = App::get('database')->select('piece INNER JOIN domicile ON piece.idDomicile = domicile.idDomicile', ['idPiece', 'nom', 'piece.idDomicile'], ['piece.idDomicile = '. $idProperty]);
            if ($a != null) {
                array_push($rooms, $a);
            }
        }
        //var_dump($rooms);
        return $rooms;
    }

    public static function findCemacByRooms($idsRooms)
    {
        $cemacs = [];
        foreach ($idsRooms as $idRoom) {
            $a = App::get('database')->select('cemac INNER JOIN piece ON cemac.idPiece = piece.idPiece', ['idCemac', 'nbObjet', 'cemac.Nom', 'Disponible', 'Descriptif', 'cemac.idPiece'], ['cemac.idPiece = '. $idRoom]);
            if ($a != null) {
                array_push($cemacs, $a);
            }
        }
        return $cemacs;
    }

    public static function findById($id)
    {
        $result = App::get('database')->select('domicile', ['*'], ["'idDomicile' = '$id'"]);
        if (sizeOf($result) == 1) {
            return $result[0];
        } else {
            return false;
        }
    }

    public static function edit($data, $id) {
        $filter = array('filter' => FILTER_CALLBACK, 'options' => function ($input) {
            $filtered = filter_var($input, FILTER_SANITIZE_STRING);
            return $filtered ? $filtered : false;
        });

        $args = [
            "Titre" => $filter,
            "Adresse" => FILTER_SANITIZE_ENCODED,
            "Ville" => FILTER_SANITIZE_ENCODED,
            "code_postal" => FILTER_SANITIZE_ENCODED,
            "Pays" => FILTER_SANITIZE_ENCODED
        ];

        $data = filter_var_array($data, $args);

        try {
            var_dump($data);
            return App::get('database')->update('`domicile`', $data, ["('idDomicile' = '" . $id . "')"]);
        } catch (Exception $e) {
            $title = "Informations invalides";
            return die($e->getMessage()); //require "app/views/users/__info-invalide.view.php";
        }
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
