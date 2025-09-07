<?php

require_once dirname(__FILE__).'/../settings/configuration_file.php';
$Activities = file_get_contents('/home/john/Desktop/strava.json');
$Activities = json_decode($Activities, true);
$Activities = ParserHelper::parseActivities($Activities);
$Activities = ParserHelper::compileActivities($Activities);

foreach($Activities as $Date => $ActivitiesByType){

    foreach($ActivitiesByType as $Type => $Activity){

        $Hours = floor($Activity['Time'] / 3600);
        $Minutes = floor(($Activity['Time'] % 3600) / 60);
        $Seconds = $Activity['Time'] % 60;

        $Time = sprintf('%02d:%02d:%02d', $Hours, $Minutes, $Seconds);
        $Distance = round($Activity['Distance']/1000, 2);

        echo $Date.' - '.$Type.' - '.$Activity['Name'].' - '.$Activity['StartTime'].' - '.$Time.' - '.$Distance."\n";

    }

}