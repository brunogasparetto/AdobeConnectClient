<?php

use \Bruno\AdobeConnectClient\API;
use \Bruno\AdobeConnectClient\RequestHandler;

// If want change the cURL Options
$requestHandler = new RequestHandler(
    'https://user.adobeconnect.com',
    [
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0
    ]
);

$api = new API($requestHandler);
