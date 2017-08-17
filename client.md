---
title: The Client
layout: default
---

# Client #

The Client class has all the actions (the endpoints) to Adobe Connect Web Service.

The action's name are the same as the endpoints from [Adobe Connect Web Service](https://helpx.adobe.com/adobe-connect/webservices/topics/action-reference.html),
but in camelCase instead of hyphen.

Some actions are a sequence of endpoints, like the recordingPasscode action.

All the actions methods can throw exceptions.

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;

$connection = new Connection('https://hostname.adobeconnect.com');
$client = new Client($connection);

// NoAccessException if not logged in
$sco = $client->scoInfo(12345);
```

Except for the commonInfo action all of them needs a logged user.

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;

$connection = new Connection('https://hostname.adobeconnect.com');
$client = new Client($connection);

// returns bool
$client->login('username', 'password');

// returns a SCO object if logged
$sco = $client->scoInfo(12345);
```

You can get/set the session phrase when execute many actions in different calls.

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;

$connection = new Connection('https://hostname.adobeconnect.com');
$client = new Client($connection);

// returns bool
$client->login('username', 'password');

$sessionPhrase = $client->getSession();

// In other script called
$client->setSession($sessionPhrase);
```

You can use Filter and Sorter in some actions.

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;
use AdobeConnectClient\Filter;
use AdobeConnectClient\Sorter;

$connection = new Connection('https://hostname.adobeconnect.com');
$client = new Client($connection);

$folderId = 12345;

$filter = Filter::instance()
    ->like('name', 'Test')
    ->dateAfter('dateBegin', new DateTimeImmutable());

$sorter = Sorter::instance()
    ->asc('dateBegin');

$scos = $client->scoContents($folderId, $filter, $sorter);
```

***

[Back to Index]({{site.github.url}})