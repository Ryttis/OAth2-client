<?php
require __DIR__ . '/../../vendor/autoload.php';

use App\Storage;
use App\Rates;


$user = (object)Storage::getUser();
$rates = Rates::get();
?>
<h1>Hello: <?= $user->name; ?></h1>
<!-- <h3>USD: <?= $rates['rates']['USD']; ?></h3> -->
<a href="http://oauth2:8888/public/views/eur.php" class="">EUR</a>
<a href="http://oauth2:8888/public/views/usd.php" class="">USD</a>
<a href="http://oauth2:8888/public/views/gbp.php" class="">GBP</a>
