<?php

namespace App;

require __DIR__ . '/../vendor/autoload.php';

use Laminas\Config\Factory;
use GuzzleHttp\Client;


class Rates
{

    public static function get()
    {
        $config = Factory::fromFile('config.json');
        var_dump($config);
        exit;
        $provider = $config['providers']['rates'];
       
        $http = new Client([
            'base_uri' => '',
            'timeout'  => 2.0,
        ]);
        
        $response = $http->request('GET', $provider);
        
       
        
        $rates = json_decode((string)$response->getBody(),true );
        return $rates;
    }
}
