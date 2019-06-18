<?php

namespace App\Core;

class Tomcat {

    public static function getLogs() {
        $ch = curl_init();
        curl_setopt(
            $ch,
            CURLOPT_URL,
            "http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=TEST"
        );
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);

        return str_split($data,33);
    }

    public static function getTrames() {
        $logs = static::getLogs();

        return array_map(function($log) {
            $trame = [];
            list(
                $trame['type'], 
                $trame['objectNumber'], 
                $trame['requestType'], 
                $trame['capteurType'], 
                $trame['capteurNumber'], 
                $trame['capteurValue'], 
                $trame['trameNumber'], 
                $trame['checksum'], 
                $year, 
                $month, 
                $day, 
                $hour, 
                $min, 
                $sec
            ) = sscanf($log,"%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
            $trame['date'] = "$year-$month-$day $hour:$min:$sec";
            return $trame;
        }, $logs);
    }

    public static function getTramesFrom($date='1999-06-05 11:56:50') {
        $allTrames = static::getTrames();

        $result = [];

        foreach ($allTrames as $trame) {
            if($trame['date'] >= $date) {
                $result[] = $trame;   
            }
        }

        return $result;
    }

    public static function actualizeTrame($trameInitial) {
        $allTrames = static::getTramesFrom($trameInitial['date']);

        $result = [];

        foreach ($allTrames as $trame) {
            if($trameInitial != $trame) {
                $result[] = $trame;
            }
        }

        return $result;
    }

    public static function actualizeLogs($trameInitial) {
        $trames = static::actualizeTrame($trameInitial);

        $result = [];

        foreach ($trames as $trame) {
            if(array_key_exists($trame['capteurNumber'], $result)) {
                if(end($result[$trame['capteurNumber']])['capteurValue'] != $trame['capteurValue']) {
                    $result[$trame['capteurNumber']][] = $trame;
                }
            } else {
                $result[$trame['capteurNumber']][] = $trame;
            }
        }

        return $result;
    }
}