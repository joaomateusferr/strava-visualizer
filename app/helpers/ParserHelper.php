<?php

class ParserHelper {

    public static function parseActivities(array $Activities) : array {

        $Result = [];

        foreach($Activities as $Activity){

            $Date = new DateTime($Activity['start_date_local'], new DateTimeZone("UTC"));
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
                'StartTime' => $Date->format("H:i"),
            ];

            $Result[$DateString][$Activity['type']][] = $Line;

        }

        foreach($Result as $Date => $ActivitiesByType){

            foreach($ActivitiesByType as $Type => $Activities){

                array_multisort(array_column($Activities, 'Time'), SORT_DESC, $Activities);
                $Result[$Date][$Type] = $Activities;

            }

        }

        return $Result;

    }

    public static function compileActivities(array $Activities) : array {

        $Result = [];

        foreach($Activities as $Date => $ActivitiesByType){

            foreach($ActivitiesByType as $Type => $Activities){

                $Line = ['Name' => $Activities[0]['Name'], 'StartTime' => $Activities[0]['StartTime'], 'Distance' => 0, 'Time' => 0];

                foreach($Activities as $Activity){

                    $Line['Distance'] = $Line['Distance'] + $Activity['Distance'];
                    $Line['Time'] = $Line['Time'] + $Activity['Time'];
                }

                $Result[$Date][$Type] = $Line;

            }

        }

        return $Result;

    }

}