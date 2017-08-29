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
