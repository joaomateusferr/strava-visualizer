<?php

class Strava {

    private $ClientID = 0;
    private $ClientSecret = '';
    private $AuthorizationCode = '';
    private $AccessToken = '';

    public function __construct(string $AuthorizationCode) {

        $Client = ClientHelper::getClientData();
        $this->ClientID = $Client['ID'];
        $this->ClientSecret = $Client['Secret'];
        $this->AuthorizationCode = $AuthorizationCode;
        $this->authenticate();

    }

    private function authenticate() {

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
        CURLOPT_POSTFIELDS => [
            'client_id' => $this->ClientID,
            'client_secret' => $this->ClientSecret,
            'code' => $this->AuthorizationCode,
            'grant_type' => 'authorization_code'
        ],
        ));

        $Response = curl_exec($curl);
        $Info = curl_getinfo($curl);
        curl_close($curl);

        if($Info["http_code"] != 200)
            throw new Exception("Error authenticate (".$Info["http_code"].") => $Response");

        $Response = json_decode($Response,true);

        $this->AccessToken = $Response['access_token'];

    }

    public function getActivitiesPage(int $Before, int $After, int $Page = 1, int $PageSize = 50) : array {

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.strava.com/api/v3/athlete/activities?before='.$Before.'&after='.$After.'&page='.$Page.'&per_page='.$PageSize,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => ['Authorization: Bearer '.$this->AccessToken],
        ));

        $Response = curl_exec($curl);
        $Info = curl_getinfo($curl);
        curl_close($curl);

        if($Info["http_code"] != 200)
            throw new Exception("Error getActivitiesPage (".$Info["http_code"].") => $Response");

        return json_decode($Response,true);

    }

}