---
layout: default
title: Entities
permalink: /entities/
order: 4
---

# The Entities

The package use two types of objects to send and receive info from Adobe Connect.

## Entities to Send and Receive

Entities are objects with get and set methods and all of them are ArrayableInterface, returning an associative array formatted as the Adobe Connect API needs.

### SCO

All objects on Adobe Connect are SCO, Shareable Content Objects. These objects
are encapsulate in SCO class entity.

SCO normally are meetings, events, folders, contents etc.

```php
<?php
use AdobeConnectClient\Entities\SCO;

$sco = SCO::instance()
    ->setName('A new SCO')
    ->setType(SCO::TYPE_MEETING)
    ->setFolderId(12345);
```

### Principal

A Principal is an user, group and others not objects.

```php
<?php
use AdobeConnectClient\Entities\Principal;

$principal = Principal::instance()
    ->setType(Principal::TYPE_USER)
    ->setFirstName('Adobe')
    ->setLastName('Connect');
```

### Permission

The Permission normally involves a Principal and a SCO, but exists special permissions
to applied only in a SCO.

The Principal ID for a Permission can be the ID of a Principal or a special string from Permission::MEETING_PRINCIPAL_PUBLIC_ACCESS constant.

The Permission ID is one of the Permission::MEETING_* constants to the SCO (meeting) or Permission::PRINCIPAL_* constants for the Principal.

#### Examples:

Set a SCO Meeting to public access to anyone with the URL.

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;
use AdobeConnectClient\Entities\Permission;

$connection = new Connection('https://hostname.adobeconnect.com');
$client =  new Client($connection);
$client->login('username', 'password');

$scoId = 12345;

$permission = Permission::instance()
    ->setAclId($scoId)
    ->setPrincipalId(Permission::MEETING_PRINCIPAL_PUBLIC_ACCESS)
    ->setPermissionId(Permission::MEETING_ANYONE_WITH_URL);

$client->permissionUpdate($permission);
```

Set a User (Principal) as Host in a Meeting

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;
use AdobeConnectClient\Entities\Permission;

$connection = new Connection('https://hostname.adobeconnect.com');
$client =  new Client($connection);
$client->login('username', 'password');

$scoId = 12345;
$principalId = 987654;

$permission = Permission::instance()
    ->setAclId($scoId)
    ->setPrincipalId($principalId)
    ->setPermissionId(Permission::PRINCIPAL_HOST);

$client->permissionUpdate($permission);
```

## Entities only to receive

These objects are only returned by the web service.

### SCORecord

The SCO Record is a special SCO for a meeting recording.

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;

$connection = new Connection('https://hostname.adobeconnect.com');
$client = new Client($connection);
$client->login('username', 'password');

$folderId = 123;

$scoRecords = $client->listRecordings($folderId);

foreach ($scoRecords as $scoRecord) {
    // shows a DateInterval
    var_dump($scoRecord->getDuration());
}
```

### CommonInfo

The CommonInfo receive information about the server (the common-info endpoint).

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;

$connection = new Connection('https://hostname.adobeconnect.com');
$client =  new Client($connection);
$commonInfo = $client->commonInfo();

echo $commonInfo->getVersion();
```
