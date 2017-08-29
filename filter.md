---
layout: default
title: Filter/Sorter
permalink: /filter/
order: 5
---

# Filter

Some actions accept filtering the result and the Adobe Connect Docs recomends filtering
to reduce the response size.

The Filter use Influent Interface.

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;
use AdobeConnectClient\Filter;

$connection = new Connection('https://hostname.adobeconnect.com');
$client =  new Client($connection);

$folderId = 12345;

$filter = Filter::instance()
    ->like('name', 'Test')
    ->dateAfter('dateBegin', new DateTimeImmutable());

$scos = $client->scoContents($folderId, $filter);
```

# Sorter

Some actions accpet sorter the result, but max two fields in a request.

The Sorter use Influent Interface.

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;
use AdobeConnectClient\Filter;
use AdobeConnectClient\Sorter;

$connection = new Connection('https://hostname.adobeconnect.com');
$client =  new Client($connection);

$folderId = 12345;

$filter = Filter::instance()
    ->like('name', 'Test')
    ->dateAfter('dateBegin', new DateTimeImmutable());

$sorter = Sorter::instance()
    ->asc('dateBegin');

$scos = $client->scoContents($folderId, $filter, $sorter);
```
