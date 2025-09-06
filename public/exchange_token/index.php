<?php

require_once dirname(__FILE__).'/../../settings/configuration_file.php';

if(empty($_GET['code']))
    exit ('User code not received!<br>');

try {

    $Strava = new Strava ($_GET['code']);
    $Activities = $Strava->getActivitiesPage(time(), strtotime("monday this week midnight"));
    var_dump($Activities);exit;

} catch (Exception $Exception) {
    exit ($Exception->getMessage().'!<br>');
}
