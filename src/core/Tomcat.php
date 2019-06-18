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



    public static function checkSum($str){
        $hex=[];
        $sum=0;
        for ($i=0;$i<strlen($str);$i++){
            
            $hex[$i]=ord($str[$i]);

        }

        for ($j=0;$j<sizeof($hex);$j++){
            $sum=($sum+$hex[$j])%256;
        }

        return dechex($sum);

    }

    public static function createTrame($type,$objectNumber,$requestType,$capteurType,$capteurNumber,$capteurValue,$trameNumber){
        
        $trame=$type.$objectNumber.$requestType.$capteurType.$capteurNumber.$capteurValue.$trameNumber;
        $checkSum=Tomcat::checkSum($trame);
        $trame=$trame.$checkSum;
        return $trame;
    }

    public static function sendTrame($type,$objectNumber,$requestType,$capteurType,$capteurNumber,$capteurValue,$trameNumber){
        $trame=Tomcat::createTrame($type,$objectNumber,$requestType,$capteurType,$capteurNumber,$capteurValue,$trameNumber);
        $ch = curl_init();
        curl_setopt(
            $ch,
            CURLOPT_URL,
            "http://projets-tomcat.isep.fr:8080/appService/?ACTION=COMMAND&TEAM=007C&TRAME=$trame"
        );
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_exec($ch);
        curl_close($ch);
    }

}