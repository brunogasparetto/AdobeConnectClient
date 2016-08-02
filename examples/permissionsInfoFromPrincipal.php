<?php

require __DIR__ . '/../vendor/autoload.php';

use \Bruno\AdobeConnectClient\API;

$api = new API('https://user.adobeconnect.com');

$api->login('your@email.com', 'password');

// The SCO ID, Principal ID or Account ID
$aclId = 12354897;

// The Principal ID
$principalId = 987654321;

$permissions = $api->permissionsInfoFromPrincipal($aclId, $principalId);

var_dump($permissions);

