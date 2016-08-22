<?php

require __DIR__ . '/../vendor/autoload.php';

use \Bruno\AdobeConnectClient\API;

$api = new API('https://user.adobeconnect.com');

$api->login('your@email.com', 'password');
var_dump($api->userUpdatePassword(123456789, 'new password'));
