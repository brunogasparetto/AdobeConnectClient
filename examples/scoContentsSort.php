<?php

require __DIR__ . '/../vendor/autoload.php';

use \Bruno\AdobeConnectClient\API;
use \Bruno\AdobeConnectClient\Sorter;

$api = new API('https://user.adobeconnect.com');

$api->login('your@email.com', 'password');

// The SCO ID or the Folder ID
$scoId = 123456789;

$sort = new Sorter();
$sort->asc('dateBegin');

$scos = $api->scoContents($scoId, null, $sort);

var_dump($scos);
