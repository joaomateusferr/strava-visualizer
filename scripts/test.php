<?php

require_once dirname(__FILE__).'/../settings/configuration_file.php';
$Activities = file_get_contents('/home/john/Desktop/strava.json');
$Activities = json_decode($Activities, true);
$Activities = ParserHelper::compileActivities($Activities);
var_dump($Activities);exit;