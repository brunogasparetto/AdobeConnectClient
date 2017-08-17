---
title: PHP Adobe Connect Client
layout: default
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
$commonInfo = $client->commonInfo();
```

## More Info ##

- [Client](client)
- [Connection](connection)


For more info see the [API Docs](apidocs)

## Objectives ##

- Create actions to all Adobe Connect endpoints.
- Create tests with PHPUnit

## Endpoints / Actions ##

The Original Endpoints.

Endpoint|Status
--------|------
account-expiry-info|Pending
acl-field-info|Pending
acl-field-list|Pending
acl-field-update|**Done**
acl-preference-update|Pending
asset-interaction-delete|Pending
asset-interaction-response-update|Pending
asset-interactions-order-update|Pending
cancel-recording-job|Pending
common-info|**Done**
concurrent-training-user-graph|Pending
curriculum-contents|Pending
custom-field-update|Pending
custom-fields|Pending
custom-fields-delete|Pending
event-guest-invite|Pending
event-notification-status-update|Pending
event-register|Pending
events-attendance|Pending
expiry-settings-info|Pending
expiry-settings-update|Pending
first-time-user-url|Pending
get-my-and-shared-events|Pending
get-recording-job|Pending
group-membership-update|**Done**
learning-path-info|Pending
learning-path-update|Pending
limited-administrator-permissions-update|Pending
limited-administrator-permissionsinfo|Pending
list-recordings|**Done**
login|**Done**
logout|**Done**
meeting-disclaimer-info|Pending
meeting-disclaimer-update|Pending
meeting-feature-update|**Done**
notification-list|Pending
permissions-info|Pending
permissions-reset|Pending
permissions-update|**Done**
principal-info|**Done**
principal-list|**Done**
principal-list-by-field|Pending
principal-update|**Done**
principals-delete|**Done**
process-recording|Pending
quota-threshold-exceeded|Pending
quota-threshold-info|Pending
quota-threshold-update|Pending
report-active-meetings|Pending
report-asset-response-info|Pending
report-bulk-consolidated-transactions|Pending
report-bulk-objects|Pending
report-bulk-questions|Pending
report-bulk-slide-views|Pending
report-bulk-users|Pending
report-course-status|Pending
report-curriculum-taker|Pending
report-event-participants-complete-information|Pending
report-meeting-attendance|Pending
report-meeting-concurrent-users|Pending
report-meeting-session-users|Pending
report-meeting-sessions|Pending
report-meeting-summary|Pending
report-my-courses|Pending
report-my-events|Pending
report-my-meetings|Pending
report-my-training|Pending
report-quiz-interactions|Pending
report-quiz-question-answer-distribution|Pending
report-quiz-question-distribution|Pending
report-quiz-question-response|Pending
report-quiz-summary|Pending
report-quiz-takers|Pending
report-quotas|Pending
report-sco-slides|Pending
report-sco-views|Pending
report-user-training-transcripts|Pending
report-user-trainings-taken|Pending
revert-recording|Pending
sco-by-url|Pending
sco-contents|**Done**
sco-delete|**Done**
sco-expanded-contents|Pending
sco-info|**Done**
sco-move|**Done**
sco-nav|Pending
sco-search|Pending
sco-search-by-field|Pending
sco-session-seminar-list|Pending
sco-shortcuts|Pending
sco-update|**Done**
sco-upload|**Done**
seminar-session-sco-update|Pending
telephony-profile-dial-in-number-update|Pending
update-sco-url|Pending
user-accounts|Pending
user-transcript-update|Pending
user-update-pwd|**Done**

Additional actions to simplify access.

Action|Status
------|------
recordingPasscode|**Done**
principalCreate|**Done**
scoCreate|**Done**

***

- [MIT License](LICENSE)
