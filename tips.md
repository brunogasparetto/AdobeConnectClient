---
title: Tips
layout: default
---

# Some Tips #

## Redirect a user to Private Meeting ##

To redirect a user to Private Meeting he needs be logged in the API and so append the session in the URL.

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;

$host = 'https://hostname.adobeconnect.com';
$scoURL = '/urltosco/';

$connection = new Connection($host);
$client =  new Client($connection);

$client->login('username', 'password');
$session = $client->getSession();

header("Location: {$host}{$scoURL}?session={$session}");
```

## Redirect a user to Private Meeting with Passcode ##

To redirect a user to Private Meeting with Passcode the user needs be logged in the API 
and so append the session and passcode in the URL.

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;

$host = 'https://hostname.adobeconnect.com';
$scoURL = '/urltosco/';
$passcode = 'secretphrase';

$connection = new Connection($host);
$client =  new Client($connection);

$client->login('username', 'password');
$session = $client->getSession();

header("Location: {$host}{$scoURL}?session={$session}&override:meeting-passcode={$passcode}");
```

## Redirect a user to Public Recording with Passcode ##

To redirect a user to Public Recording with Passcode append the passcode in the URL.

```php
<?php
$host = 'https://hostname.adobeconnect.com';
$recordingURL = '/urltoscorecording/';
$passcode = 'secretphrase';

header("Location: {$host}{$recordingURL}?recording-passcode={$passcode}");
```

