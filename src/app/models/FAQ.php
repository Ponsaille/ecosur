<?php

namespace App\Model;

use App\Core\App;

use \Exception;

class FAQ extends Model
{
    public static function get() {
        return App::get('database')->select('faq');
    }

    public static function getById($id) {
        return App::get('database')->select('faq', ['*'], ["idFAQ=$id"]);
    }

    public static function store($question, $reponse) {
        $data = [
            "question" => $question,
            "reponse" => $reponse
        ];
        return App::get('database')->insert('faq', $data);
    }

    public static function update($id, $contenu) {
        return App::get('database')->update('faq', ["reponse" => htmlspecialchars($contenu)], ["idFAQ=$id"]);
    }

    public static function delete($id) {
        return App::get('database')->delete('faq', ["idFAQ=$id"]);
    }

    public static function orderedByQuestion() {
        $modifiables = static::get();
        $result = [];
        foreach ($modifiables as $modifiable) {
            $result[$modifiable->question] = $modifiable;
        }
        return $result;
    }
}
