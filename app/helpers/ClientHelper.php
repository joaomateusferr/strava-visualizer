<?php

class ClientHelper {

    private const ClientDataPath = '/../../data/client.json';

    public static function getClientData() : array {

        $ClientDataFilePath = dirname(__FILE__).self::ClientDataPath;
        return json_decode(file_get_contents($ClientDataFilePath), true);

    }

}