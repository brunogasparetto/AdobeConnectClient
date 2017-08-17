---
title: PHP Adobe Connect Client
layout: default
---

# Client for Adobe Connect API v9.5.4

This library offers a simple way to comunicate with Adobe Connect Web Service

## Installation ##

The package is available on [Packagist](https://packagist.org/packages/brunogasparetto/adobe-connect-client). You can install it using [Composer](http://getcomposer.org/)

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

You can use filters and sorters in some actions.

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;
use AdobeConnectClient\SCO;
use AdobeConnectClient\Filter;
use AdobeConnectClient\Sorter;

$connection = new Connection('https://hostname.adobeconnect.com');
$client =  new Client($connection);

$client->login('username', 'password');

$folderId = 123;

$filter = Filter::instance()
  ->dateAfter('dateBegin', new DateTimeImmutable())
  ->like('name', 'ClassRoom');

$sorter = Sorter::instance()
  ->asc('dateBegin');

$scos = $client->scoContents($folderId, $filter, $sorter);
```

The **AdobeConnectClient\Connection\Curl\Connection** class accept an array of options
to configure the CURL.

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;

// For tests with no SSL
$connection = new Connection(
  'https://hostname.adobeconnect.com',
  [
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
  ]
);
$client =  new Client($connection);
$commonInfo = $client->commonInfo();
```

### IMPORTANT ###

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

## TODO ##

- [ ] Create documentation.
- [ ] Create automatized tests (All actions were manually tested).
- [ ] Implement all methods and entities.

***

- [License](LICENSE)
