---
title: PHP Adobe Connect Client - Connection
layout: default
---

# Connection #

The Connection sends GET and POST requests to Adobe Connect Web Service.

You can use any connection which implements the ConnectionInterface.

## CurlConnection ##

This package implements the Connection with CURL.

The constructor accepts the server URL to access the Web Service and an array
of options to configure the CURL.

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;

$connection = new Connection('https://hostname.adobeconnect.com');

// only for example

$connection = new Connection(
    'https://hostname.adobeconnect.com',
    [
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER  => 0,
    ]
);
```

The Connection throws exceptions if URL is invalid or can't access the service.

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;

// throws InvalidArgumentException
$connection = new Connection('invalid');

// throws UnexpectedValueException if not access the service
$connection->get(['action' => 'test']);
```


***

[Voltar](index)
