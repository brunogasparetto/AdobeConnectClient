---
layout: default
title: Get Started
permalink: /
order: 1
---

# Client for Adobe Connect Webservice API v9.5.4

PHP library to comunicate with the [Adobe Connect Web Service](https://helpx.adobe.com/adobe-connect/webservices/topics.html).

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
$client->login('username', 'password');

$folderId = 123;

$filter = Filter::instance()
    ->like('name', 'Test')
    ->dateAfter('dateBegin', new DateTimeImmutable());

$scos = $client->scoContents($folderId, $filter);
```
