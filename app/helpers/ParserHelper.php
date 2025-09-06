<?php

class ParserHelper {

    public static function compileActivities(array $Activities) : array {

        $Result = [];

        foreach($Activities as $Activity){

            $Date = new DateTime($Activity['start_date_local'], new DateTimeZone("UTC"));
            $Date->setTimezone(new DateTimeZone("America/Sao_Paulo"));
            $DateString = $Date->format("Y/m/d");

            if(!isset($Result[$DateString]))
                $Result[$DateString] = [];

            if(!isset($Result[$DateString][$Activity['type']]))
                $Result[$DateString][$Activity['type']] = [];

            $Line = [
                'Name' => $Activity['name'],
                'Distance' => $Activity['distance'],
                'Time' => $Activity['moving_time'],
                'ID' => $Activity['id'],
            ];

            $Result[$DateString][$Activity['type']][] = $Line;

        }

        return $Result;

    }

}