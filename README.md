# Client for Adobe Connect API v9.5.4

Not all actions are implemented, but many actions are in development and some others are a sequence of actions, like the RecordingPasscode.

## Installation ##

The package is available on [Packagist](https://packagist.org/packages/respect/relational). You can install it using [Composer](http://getcomposer.org/)

```bash
$ composer require brunogasparetto/adobe-connect-client
```

## Usage

```php
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Client;

$connection = new Connection('https://hostname.adobeconnect.com');
$client =  new Client($connection);
$commonInfo = $client->commonInfo();
```

You can use filters and sorters in some actions.

```php
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

### IMPORTANT ###

All Client actions are throwable.

```php
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

- [License](LICENSE.md)
