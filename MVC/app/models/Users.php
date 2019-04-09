<?php

namespace App\Model;

class Users {
    public static function get() {
        return App::get('database')->select('users');
    }
}