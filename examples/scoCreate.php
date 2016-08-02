<?php

require __DIR__ . '/../vendor/autoload.php';

use \Bruno\AdobeConnectClient\API;
use \Bruno\AdobeConnectClient\SCO;

$api = new API('https://user.adobeconnect.com');

$api->login('your@email.com', 'password');

$sco = new SCO();
$sco->folderId = 123456789;
$sco->type = SCO::TYPE_MEETING;
$sco->name = 'Meeting Name';
$sco->dateBegin = new DateTimeImmutable('2016-07-25T10:00:00-03:00');
$sco->dateEnd = $sco->dateBegin->add(new DateInterval('PT1H'));

$scoCreated = $api->scoCreate($sco);

var_dump($scoCreated);
