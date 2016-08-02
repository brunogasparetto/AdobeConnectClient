<?php

require __DIR__ . '/../vendor/autoload.php';

use \Bruno\AdobeConnectClient\API;
use \Bruno\AdobeConnectClient\Principal;

$api = new API('https://user.adobeconnect.com');

$api->login('your@email.com', 'password');

$filter = new Filter();
$filter->isMember(true);

$principals = $api->principalList(123456789, $filter);

var_dump($principals);
