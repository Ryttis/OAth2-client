<?php
require __DIR__ . '/../../vendor/autoload.php';

use Laminas\Config\Factory;
use GuzzleHttp\Client;
use App\Storage;

session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] != 1) {
    header('location: http://oauth2:8888/views/home.php');
    die();
}

$config = Factory::fromFile('config.json');
$provider = $config['providers']['rates'];

$http = new Client([
    'base_uri' => '',
    'timeout'  => 2.0,
]);

$response = $http->request('GET', $provider);

$user = (object)Storage::getUser();

$rates = json_decode((string)$response->getBody(),true );
// var_dump($rates)
?>
<h1>Hello: <?= $user->name; ?></h1>
<h3>USD: <?= $rates['rates']['USD']; ?></h3>
<a href="http://oauth2:8888/public/views/eur.php" class="">EUR</a>
<a href="http://oauth2:8888/public/views/usd.php" class="">USD</a>
<a href="http://oauth2:8888/public/views/gbp.php" class="">GBP</a>
