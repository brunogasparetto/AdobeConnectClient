<?php

require __DIR__ . '/../vendor/autoload.php';

use \Bruno\AdobeConnectClient\API;
use \Bruno\AdobeConnectClient\SCO;
use \Bruno\AdobeConnectClient\Permission;

$api = new API('https://user.adobeconnect.com');

$api->login('your@email.com', 'password');

// Create the SCO type Meeting
$sco = new SCO();
$sco->folderId = 123456789;
$sco->type = SCO::TYPE_MEETING;
$sco->name = 'Meeting Name';
$sco->dateBegin = new DateTimeImmutable('2016-07-25T10:00:00-03:00');
$sco->dateEnd = $sco->dateBegin->add(new DateInterval('PT1H'));

$scoCreated = $api->scoCreate($sco);

// Set the SCO access to only accept registered users and accepted guests
$permission = new Permission();
$permission->aclId = $scoCreated->scoId;
$permission->principalId = Permission::MEETING_PRINCIPAL_PUBLIC_ACCESS;
$permission->permissionId = Permission::MEETING_PROTECTED;
$api->permissionUpdate($permission);

// Set the Meeting User Host
$permission->principalId = 147258369;
$permission->permissionId = Permission::PRINCIPAL_HOST;
$api->permissionUpdate($permission);
