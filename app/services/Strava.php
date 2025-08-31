<?php

class Strava {

    private $ClientID = 0;
    private $ClientSecret = '';

    public function __construct(int $ClientID, string $ClientSecret) {

        $this->ClientID = $ClientID;
        $this->ClientSecret = $ClientSecret;

    }

}