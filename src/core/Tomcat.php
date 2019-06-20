<?php

namespace App\Core;

class Tomcat {

    public static function getLogs($objectNumber) {
        $ch = curl_init();
        curl_setopt(
            $ch,
            CURLOPT_URL,
            "http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=$objectNumber"
        );
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);

        return str_split($data,33);
    }

    public static function getTrames($objectNumber) {
        $logs = static::getLogs($objectNumber);

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

    public static function getTramesFrom($objectNumber, $date='1999-06-05 11:56:50') {
        $allTrames = static::getTrames($objectNumber);

        $result = [];

        foreach ($allTrames as $trame) {
            if($trame['date'] > $date) {
                $result[] = $trame;   
            }
        }

        return $result;
    }

    public static function actualizeTrame($trameInitial) {
        $allTrames = static::getTramesFrom($trameInitial['objectNumber'], $trameInitial['date']);

        $result = [];

        foreach ($allTrames as $trame) {
            if($trameInitial != $trame) {
                $result[] = $trame;
            }
        }

        return $result;
    }

    public static function actualizeLogs($objectNumber, $date='1999-06-05 11:56:50') {
        $trames = static::getTramesFrom($objectNumber, $date);

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