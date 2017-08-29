---
layout: default
title: Connection
permalink: /connection/
order: 2
---

# Connection

To access the Adobe Connect you can use any library wich implements the ConnectionInterface and returns a ResponseInterface.

The package has one Connection class using CURL.

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;

$connection = new Connection('https://hostname.adobeconnect.com');
```

The CURL Connection accepts an array to config the CURL.

```php
<?php
use AdobeConnectClient\Connection\Curl\Connection;

$connection = new Connection(
    'https://hostname.adobeconnect.com',
    [
        CURLOPT_CONNECTTIMEOUT => 0,
        CURLOPT_TIMEOUT=> 300
    ]
);
```
If the hostname is invalid it will throw an InvalidArgumentException.

If the server does not respond it will throw an UnexpectedValueException.
