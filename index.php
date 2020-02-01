<?php

use AdobeConnectClient\Client;
use AdobeConnectClient\Connection\Curl\Connection;

$client = new Client(new Connection('https://ucdbvirtual.adobeconnect.com'));
