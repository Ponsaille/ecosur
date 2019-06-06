<?php

namespace App\Core;

class Tomcat {

    public static function getLogs() {
        $ch = curl_init();
        curl_setopt(
            $ch,
            CURLOPT_URL,
            "http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=007C"
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
                $trame['t'], 
                $trame['o'], 
                $trame['r'], 
                $trame['c'], 
                $trame['n'], 
                $trame['v'], 
                $trame['a'], 
                $trame['x'], 
                $trame['year'], 
                $trame['month'], 
                $trame['day'], 
                $trame['hour'], 
                $trame['min'], 
                $trame['sec']
            ) = sscanf($log,"%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
            return $trame;
        }, $logs);
    }

}