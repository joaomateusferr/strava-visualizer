<?php

require_once dirname(__FILE__).'/../../settings/configuration_file.php';

if(empty($_GET['code']))
    exit ('User code not received!<br>');

try {

    $Strava = new Strava ($_GET['code']);
    $Activities = $Strava->getActivitiesPage(time(), strtotime("monday this week midnight"));
    $Activities = ParserHelper::parseActivities($Activities);
    $Activities = ParserHelper::compileActivities($Activities);

    foreach($Activities as $Date => $ActivitiesByType){

        foreach($ActivitiesByType as $Type => $Activity){

            $Hours = floor($Activity['Time'] / 3600);
            $Minutes = floor(($Activity['Time'] % 3600) / 60);
            $Seconds = $Activity['Time'] % 60;

            $Time = sprintf('%02d:%02d:%02d', $Hours, $Minutes, $Seconds);
            $Distance = round($Activity['Distance']/1000, 2);

            echo $Date.' - '.$Type.' - '.$Activity['Name'].' - '.$Activity['StartTime'].' - '.$Time.' - '.$Distance."<br>";

        }

    }

} catch (Exception $Exception) {
    exit ($Exception->getMessage().'!<br>');
}
