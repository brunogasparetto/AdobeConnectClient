---
title: PHP Adobe Connect Client
layout: default
---

# Client for Adobe Connect API v9.5.4

This library offers a simple way to comunicate with Adobe Connect Web Service

## Installation ##

The package is available on [Packagist](https://packagist.org/packages/brunogasparetto/adobe-connect-client).
You can install it using [Composer](http://getcomposer.org/)

```bash
$ composer require brunogasparetto/adobe-connect-client
```

## Usage

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;

$connection = new Connection('https://hostname.adobeconnect.com');
$client =  new Client($connection);
$commonInfo = $client->commonInfo();
```

### Important ###

All Client actions are throwable.

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;
use AdobeConnectClient\Exceptions\NoAccessException;

$connection = new Connection('https://hostname.adobeconnect.com');
$client = new Client($connection);

// Throws NoAccessException if not logged in
$client->scoInfo(123);
```

## More Info ##

- [The Client](client)
