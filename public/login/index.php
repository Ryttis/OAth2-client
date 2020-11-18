<?php
require __DIR__ . '/../../vendor/autoload.php';

use App\Storage;

session_start();

$provider = new League\OAuth2\Client\Provider\GenericProvider([
    'garnt_type' => 'authorization_code',
    'clientId'          => '6',
    'clientSecret'      => 'L7lngcAhfN50LagMF0JPsZOvowuRR2Qm2Lece99I',
    'redirectUri'       => 'http://oauth2:8888/public/login/',
    'urlAuthorize'            => 'http://127.0.0.1:8000/oauth/authorize',
    'urlAccessToken'          => 'http://127.0.0.1:8000/oauth/token',
    'urlResourceOwnerDetails' => 'http://127.0.0.1:8000/api/user'
]);

if (!isset($_GET['code'])) {

    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl();
  
    $_SESSION['oauth2state'] = $provider->getState();

    header('Location: ' . $authUrl);
    exit;

    // Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state');
} else {

    // Try to get an access token (using the authorization code grant)
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    // Optional: Now you have a token you can look up a users profile data
    try {

        // We got an access token, let's now get the user's details
        $user = $provider->getResourceOwner($token);

        // Use these details to create a new profile
       
        Storage::addUser($user->toArray());
        $_SESSION['login'] = 1;
        header('location: http://oauth2:8888/public/content/index.php');
        die();
    } catch (Exception $e) {

        // Failed to get user details
        exit('Oh dear...');
    }
}
