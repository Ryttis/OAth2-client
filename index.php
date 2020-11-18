<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) 
{
    case '/' :
        require __DIR__ . '/public/views/home.php';
        break;
    case '' :
        require __DIR__ . '/public/views/home.php';
        break;
    case '/public/content/' :
        require __DIR__ . '/public/content/index.php';
        break;
    case '/public/login/' :
        require __DIR__ . '/public/login/index.php';
        break;    
    case '/public/views/usd' :
        require __DIR__ . '/public/views/usd.php';
        break;  
    case '/public/views/eur' :
        require __DIR__ . '/public/views/eur.php';
        break;
    case '/public/views/gbp.php' :
        require __DIR__ . '/public/views/gbp.php';
        break;       
    default:
        http_response_code(404);
        require __DIR__ . '/public/views/404.php';
        break;
}