<?php

namespace App\Model;

use App\Core\App;
use Exception;

class Station extends Model
{

    public static function get()
    {
        return App::get('database')->select('cemac');
    }

    public static function getNomsTypesComposants()
    {
        return App::get('database')->select('typeComposant', ['nom']);
    }

    public static function getTypesComposants()
    {
        return App::get('database')->select('typeComposant', ['idtypeComposant', 'nom']);
    }

    public static function findCemacByRoom($idRoom)
    {
        return App::get('database')->select('cemac INNER JOIN piece ON cemac.idPiece = piece.idPiece', ['idCemac', 'nbObjet', 'cemac.Nom', 'Disponible', 'Descriptif', 'cemac.idPiece'], ['cemac.idPiece = ' . $idRoom]);
    }

    public static function findComposantByCemac($idCemac)
    {
        return App::get('database')->select('(composants INNER JOIN cemac ON composants.idCemac = cemac.idCemac) INNER JOIN typeComposant ON composants.idtypeComposant = typeComposant.idtypeComposant', ['idComposant', 'composants.idCemac', 'typeComposant.nom', 'typeComposant.type', 'typeComposant.icone'], ['composants.idCemac = ' . $idCemac]);
    }


    public static function delete($id)
    {
        return App::get('database')->delete('cemac', ['idCemac = ' . $id['idCemac']]);
    }

    public static function store($data, $id)
    {
        $filter = array('filter' => FILTER_CALLBACK, 'options' => function ($input) {
            $filtered = filter_var($input, FILTER_SANITIZE_STRING);
            return $filtered ? $filtered : false;
        });

        $data = [
            "nbObjet" => $data['nbObjet'],
            "Nom" => $data['Nom'],
            "Disponible" => 0,
            "Descriptif" => $data['Descriptif'],
            "idPiece" => $id['idPiece']
        ];

        $args = [
            "nbObjet" => $filter,
            "Nom" => FILTER_SANITIZE_ENCODED,
            "Disponible" => FILTER_SANITIZE_NUMBER_INT,
            "Descriptif" => FILTER_SANITIZE_ENCODED,
            "idPiece" => FILTER_SANITIZE_ENCODED
        ];

        $data = filter_var_array($data, $args);

        try {
            return App::get('database')->insert('cemac', $data);
        } catch (Exception $e) {
            $title = "Informations invalides";
            return die($e->getMessage());
        }
    }

    public static function deleteCapteur($id) {
        return App::get('database')->delete('composants', ['idComposant = ' . $id['idComposant']]);
    }

    public static function storeCapteur($data, $idCemac, $typesComposants)
    {
        $filter = array('filter' => FILTER_CALLBACK, 'options' => function ($input) {
            $filtered = filter_var($input, FILTER_SANITIZE_STRING);
            return $filtered ? $filtered : false;
        });

        foreach ($typesComposants as $typeComposant) {
            if ($typeComposant->nom == $data['nom']) {
                $idType = $typeComposant->idtypeComposant;
            }
        }
        $data = [
            "idCemac" => $idCemac ["idCemac"],
            "idtypeComposant" => $idType
        ];

        $args = [
            "idCemac" => $filter,
            "idtypeComposant" => FILTER_SANITIZE_NUMBER_INT
        ];

        $data = filter_var_array($data, $args);

        try {
            return App::get('database')->insert('composants', $data);
        } catch (Exception $e) {
            $title = "Informations invalides";
            return die($e->getMessage());
        }
    }

}