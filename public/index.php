<?php

require_once dirname(__FILE__).'/../settings/configuration_file.php';

$Client = ClientHelper::getClientData();
$URL = 'http://www.strava.com/oauth/authorize?client_id='.$Client['ID'].'&response_type=code&redirect_uri=http://localhost/exchange_token&approval_prompt=force&scope=read,activity:read';

?>

<a href=<?php echo $URL ?>>Click here to authenticate on strava!</a>