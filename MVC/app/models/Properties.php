<?php

namespace App\Model;

use App\Core\App;
use \Exception;

class Properties extends Model
{
    /**
     * Trouver les domiciles liés à l'utilisateur connecté
     * @return mixed
     */
    public static function findPropertiesByConnectedUser()
    {
        return App::get('database')->select('domicile INNER JOIN abonnementproprietaire ON domicile.idDomicile = abonnementproprietaire.idDomicile AND abonnementproprietaire.idPersonne = ' . $_SESSION['user_id'], ['domicile.idDomicile', 'Titre', 'Adresse', 'code_postal', 'Ville', 'Pays', 'Surface']);
    }

    /**
     * Trouver les pièces associées à un domicile
     * @param $idProperty
     * @return array
     */
    public static function findRoomsByProperty($idProperty)
    {
        return App::get('database')->select('piece INNER JOIN domicile ON piece.idDomicile = domicile.idDomicile', ['idPiece', 'nom', 'piece.idDomicile'], ['piece.idDomicile = ' . $idProperty]);
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

    public static function edit($data, $id)
    {
        $filter = array('filter' => FILTER_CALLBACK, 'options' => function ($input) {
            $filtered = filter_var($input, FILTER_SANITIZE_STRING);
            return $filtered ? $filtered : false;
        });

        $args = [
            "Titre" => $filter,
            "Surface" => FILTER_SANITIZE_NUMBER_INT,
            "Adresse" => FILTER_SANITIZE_ENCODED,
            "Ville" => FILTER_SANITIZE_ENCODED,
            "code_postal" => FILTER_SANITIZE_ENCODED,
            "Pays" => FILTER_SANITIZE_ENCODED
        ];

        $data = filter_var_array($data, $args);


        try {
            return App::get('database')->update('domicile', $data, ["idDomicile=$id"]);
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
            "surface" => FILTER_SANITIZE_NUMBER_INT,
            "adresse" => FILTER_SANITIZE_ENCODED,
            "code_postal" => FILTER_SANITIZE_ENCODED,
            "ville" => FILTER_SANITIZE_ENCODED,
            "pays" => FILTER_SANITIZE_ENCODED
        ];

        $data = filter_var_array($data, $args);

        try {
            App::get('database')->insert('domicile', $data);

            $data = [
                "DateDebut" => date("Y-m-d"),
                "DateFin" => date("Y-m-d", strtotime(" +1 year")),
                "idPersonne" => $_SESSION['user_id'],
                "idDomicile" => App::get('database')->select('domicile', ['idDomicile'], ['idDomicile=LAST_INSERT_ID()'])[0]->idDomicile
            ];
            return App::get('database')->insert('abonnementproprietaire', $data);
        } catch (Exception $e) {
            $title = "Informations invalides";
            return die($e->getMessage()); //require "app/views/users/__info-invalide.view.php";
        }
    }

    public static function delete($id) {

        return App::get('database')->delete('domicile', ['idDomicile = '. $id]);
    }

    public static function storeRoom($data, $id)
    {
        $filter = array('filter' => FILTER_CALLBACK, 'options' => function ($input) {
            $filtered = filter_var($input, FILTER_SANITIZE_STRING);
            return $filtered ? $filtered : false;
        });

        $data =[
            "nom" => $data['nom'],
            "idDomicile" => $id['idDomicile']
        ];

        $args = [
            "nom" => $filter,
            "idDomicile" => FILTER_SANITIZE_NUMBER_INT
        ];

        $data = filter_var_array($data, $args);   // Pk ça marche pas ? Les valeurs ressorties sont nulles

        try {
            return App::get('database')->insert('piece', $data);
        } catch (Exception $e) {
            $title = "Informations invalides";
            return die($e->getMessage());
        }
    }

    public static function editOneRoom($data, $id)
    {

        $filter = array('filter' => FILTER_CALLBACK, 'options' => function ($input) {
            $filtered = filter_var($input, FILTER_SANITIZE_STRING);
            return $filtered ? $filtered : false;
        });

        $args = [
            "nom" => $filter
        ];

        $data = filter_var_array($data, $args);


        try {
            return App::get('database')->update('piece', $data, ["idPiece=$id"]);
        } catch (Exception $e) {
            $title = "Informations invalides";
            return die($e->getMessage()); //require "app/views/users/__info-invalide.view.php";
        }
    }

    public static function deleteOneRoom($id) {
        return App::get('database')->delete('piece', ['idPiece = '. $id]);
    }

    public static function userAllowedInProperty($idUser, $idDomicile) {
        $allowed = App::get('database')->select('abonnementproprietaire', ['*'], ['idDomicile = '. $idDomicile, 'idPersonne = ' .$idUser]);

        if (count($allowed)>0) {
            return true;
        } else {
            return false;
        }
    }
}
