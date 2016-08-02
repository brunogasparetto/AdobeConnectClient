<?php

require __DIR__ . '/../vendor/autoload.php';

use \Bruno\AdobeConnectClient\API;
use \Bruno\AdobeConnectClient\Permission;

$api = new API('https://user.adobeconnect.com');

$api->login('your@email.com', 'password');

// Set the SCO access to only accept registered users and accepted guests
$permission = new Permission();
$permission->aclId = 123456789; // SCO ID
$permission->principalId = Permission::MEETING_PRINCIPAL_PUBLIC_ACCESS;
$permission->permissionId = Permission::MEETING_PROTECTED;
$api->permissionUpdate($permission);

// Set the Meeting User Host
$permission->aclId = 987654321; // SCO ID
$permission->principalId = 147258369;
$permission->permissionId = Permission::PRINCIPAL_HOST;
$api->permissionUpdate($permission);
