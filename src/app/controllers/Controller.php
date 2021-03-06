<?php
/**
 * Created by PhpStorm.
 * User: jules
 * Date: 01/04/2019
 * Time: 11:35
 */

namespace App\Controllers;

use App\Model\Modifiables;


class Controller
{
    public static function view($name, $data = [])
    {
        extract($data);
        $modifiables = Modifiables::orderedByTitre();
        return require "app/views/$name.view.php";
    }

    public static function redirect($uri)
    {
        header("Location: /$uri");
    }
}
