<?php

require __DIR__ . '/../vendor/autoload.php';

use \Bruno\AdobeConnectClient\API;

$api = new API('https://user.adobeconnect.com');

$api->login('your@email.com', 'password');

// The SCO ID or the Folder ID
$scoId = 123456789;

$scos = $api->scoContents($scoId);

var_dump($scos);
