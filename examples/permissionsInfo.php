<?php

require __DIR__ . '/../vendor/autoload.php';

use \Bruno\AdobeConnectClient\API;
use \Bruno\AdobeConnectClient\Permission;
use \Bruno\AdobeConnectClient\Filter;

$api = new API('https://user.adobeconnect.com');

$api->login('your@email.com', 'password');

// The SCO ID, Principal ID or Account ID
$aclId = 123456789;

$filter = new Filter();
$filter->equals('permissionId', Permission::PRINCIPAL_HOST);

$permission = $api->permissionsInfo($aclId, $filter);

var_dump($permission);
