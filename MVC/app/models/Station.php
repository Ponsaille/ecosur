<?php

namespace App\Model;

use App\Core\App;

class Station extends Model {

    public static function get() {
        return App::get('database')->select('cemac');
    }

    public static function findCemacByRoom($idRoom)
    {
        return App::get('database')->select('cemac INNER JOIN piece ON cemac.idPiece = piece.idPiece', ['idCemac', 'nbObjet', 'cemac.Nom', 'Disponible', 'Descriptif', 'cemac.idPiece'], ['cemac.idPiece = '. $idRoom]);
    }

    public static function findComposantByCemac($idCemac)
    {
        return App::get('database')->select('(composants INNER JOIN cemac ON composants.idCemac = cemac.idCemac) INNER JOIN typeComposant ON composants.idtypeComposant = typeComposant.idtypeComposant', ['idComposant', 'composants.idCemac', 'typeComposant.nom', 'typeComposant.type', 'typeComposant.icone'], ['composants.idCemac = '. $idCemac]);
    }

    public static function delete($id) {

        return App::get('database')->delete('cemac', ['idCemac = '. $id]);
    }

    /*
    public static function findByNomLogement($identifiantLogement) {
        $station = App::get('database')->query("SELECT cemac.idCemac FROM domicile
        JOIN pièce
        ON piece.idDomicile=domicile.idDomicile
        JOIN cemac
        ON cemac.idPiece=piece.idPiece
        WHERE cemac.idCemac=$identifiantLogement");
    }
    */

}