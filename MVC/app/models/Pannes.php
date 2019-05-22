<?php

namespace App\Model;

use App\Core\App;

use \Exception;

class Pannes extends Model
{
    public static function get()
    {
        return App::get('database')->select('panne');
    }

    public static function getById($id)
    {
        return App::get('database')->select('panne', ['*'], ["idPanne=$id"]);
    }

    public static function getbyUser($id)
    {
        return App::get('database')->select('((panne INNER JOIN cemac ON panne.idCemac = cemac.idCemac) INNER JOIN piece ON cemac.idPiece = piece.idPiece) INNER JOIN abonnementproprietaire ON piece.idDomicile = abonnementproprietaire.idDomicile', ['panne.idPanne', 'panne.descriptif', 'startDate', 'endDate', 'etat', 'panne.idCemac'], ["abonnementproprietaire.idPersonne = $id"]);
    }

    public static function findIdUserByPanne($id)
    {
        return App::get('database')->select('((abonnementproprietaire INNER JOIN piece ON  piece.idDomicile = abonnementproprietaire.idDomicile ) INNER JOIN cemac ON  cemac.idPiece = piece.idPiece ) INNER JOIN panne ON  panne.idCemac = cemac.idCemac ', ['abonnementproprietaire.idPersonne'], ["panne.idPanne = $id"]);
    }

    public static function findMessagesByPanne($id)
    {
        return App::get('database')->select('message', ['*'], ["idPanne=$id"]);
    }

    public static function storeMessage($data, $idPersonne, $idPanne)
    {

        $data = [
            "date" => date("Y-m-d"),
            "content" => $data['message'],
            "idPersonne" => $idPersonne,
            "idPanne" => $idPanne
        ];

        $args = [
            "date" => FILTER_SANITIZE_ENCODED,
            "content" => FILTER_SANITIZE_ENCODED,
            "idPersonne" => FILTER_SANITIZE_NUMBER_INT,
            "idPanne" => FILTER_SANITIZE_NUMBER_INT
        ];

        $data = filter_var_array($data, $args);

        try {
            return App::get('database')->insert('message', $data);
        } catch (Exception $e) {
            $title = "Informations invalides";
            return die($e->getMessage());
        }
    }

}
