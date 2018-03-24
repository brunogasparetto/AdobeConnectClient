---
layout: default
title: Client
permalink: /client/
order: 3
---

# Client

The Client is responsible to load the action Command (all actions are Commands and represents an endpoint) and persist the session cookie.

To connect in Adobe Connect is necessary a ConnectionInterface object.

**All actions can throw an Exception.**

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;

$connection = new Connection('https://hostname.adobeconnect.com');
$client = new Client($connection);
$client->login('username', 'password');
```

Many actions throw the AdobeConnectClient\Exceptions\NoAccessException if is not logged.

When the login action is called and a valid username and password are passed the Client set the session phrase. You can retrieve the session phrase to use it in other page script or to redirect the logged user to a meeting.

```php
<?php
// page1.php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;

$connection = new Connection('https://hostname.adobeconnect.com');
$client = new Client($connection);

$client->login('username', 'password');
$sessionPhrase = $client->getSession();
// persist the $sessionPhrase

// page2.php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;

$connection = new Connection('https://hostname.adobeconnect.com');
$client = new Client($connection);

// retrieve the $sessionPhrase
$client->setSession($sessionPhrase);
$sco = $client->scoInfo(12345);
```

The Adobe Connect Web Service use actions named update to create and update an item, but this package renamed the actions with **create** and **update**.

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;
use AdobeConnectClient\Entities\SCO;

$connection = new Connection('https://hostname.adobeconnect.com');
$client = new Client($connection);

$client->login('username', 'password');

$sco = SCO::instance()
    ->setName('SCO New')
    ->setType(SCO::TYPE_MEETING)
    ->setFolderId(12345);

// Call the sco-update action to create
$newSCO = $client->scoCreate($sco);

$newSCO->setName('SCO Updated');

// Call the sco-update action to update
$client->scoUpdate($sco);
```
