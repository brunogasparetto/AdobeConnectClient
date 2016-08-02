<?php

require __DIR__ . '/../vendor/autoload.php';

use \Bruno\AdobeConnectClient\API;
use \Bruno\AdobeConnectClient\Filter;
use \Bruno\AdobeConnectClient\Sorter;
use \Bruno\AdobeConnectClient\SCO;

$api = new API('https://user.adobeconnect.com');

$api->login('your@email.com', 'password');

// The SCO ID or the Folder ID
$scoId = 123456789;

$filter = new Filter();
$filter
    ->equals('type', SCO::TYPE_MEETING)
    ->like('name', 'meeting')
    ->dateAfter('dateBegin', new DateTime('2016-01-01T00:00:00-03:00'))
    ->dateBefore('dateBegin', new DateTime('2016-02-01T00:00:00-03:00'), false);

$sort = new Sorter();
$sort->asc('dateBegin');

$scos = $api->scoContents($scoId, $filter, $sort);

var_dump($scos);
