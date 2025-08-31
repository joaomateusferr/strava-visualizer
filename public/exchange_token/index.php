<?php

require_once dirname(__FILE__).'/../../settings/configuration_file.php';

$Client = ClientHelper::getClientData();

if(!empty($_GET['code'])){

    $Code = $_GET['code'];
    $Fields = ['client_id' => $Client['ID'], 'client_secret' => $Client['Secret'], 'code' => $Code, 'grant_type' => 'authorization_code'];

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://www.strava.com/oauth/token',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $Fields,
    ));

    $Response = curl_exec($curl);
    $Info = curl_getinfo($curl);
    curl_close($curl);

    if($Info["http_code"] != 200)
        exit("Error (".$Info["http_code"].") => $Response");

    $Response = json_decode($Response,true);

    $Header = ['Authorization: Bearer '.$Response['access_token']];

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://www.strava.com/api/v3/athlete/activities?before='.time().'&after=1756090800&page=1&per_page=50',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => $Header,
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;


}