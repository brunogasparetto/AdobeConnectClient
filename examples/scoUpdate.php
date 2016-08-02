<?php

require __DIR__ . '/../vendor/autoload.php';

use \Bruno\AdobeConnectClient\API;

$api = new API('https://user.adobeconnect.com');

$api->login('your@email.com', 'password');

$sco = $api->scoInfo(123456789);
$sco->name = 'New Meeting Name';
$sco->dateBegin = new DateTimeImmutable('2016-07-25T10:00:00-03:00');
$sco->dateEnd = $sco->dateBegin->add(new DateInterval('PT1H'));
$sco->sourceScoId = 147258369;

var_dump($api->scoUpdate($sco));
