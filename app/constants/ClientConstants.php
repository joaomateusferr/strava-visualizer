<?php

class ClientConstants {

    private const ClientData = [
    ];

    public static function getCurrencyFromType(string $Type) : string | bool {

        if(isset(self::ClientData[$Type]))
            return self::ClientData[$Type];

        return false;

    }

}