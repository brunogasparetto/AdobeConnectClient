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

You can use filters and sorters in some actions.

## More Info ##

- [The Client](client)
- [Connection](connection)

## Objectives ##

- Create actions to all Adobe Connect endpoints.
- Create tests with PHPUnit

## Endpoints / Actions ##

The Original Endpoints.

- [] account-expiry-info
- [] acl-field-info
- [] acl-field-list
- [x] acl-field-update
- [] acl-preference-update
- [] asset-interaction-delete
- [] asset-interaction-response-update
- [] asset-interactions-order-update
- [] cancel-recording-job
- [x] common-info
- [] concurrent-training-user-graph
- [] curriculum-contents
- [] custom-field-update
- [] custom-fields
- [] custom-fields-delete
- [] event-guest-invite
- [] event-notification-status-update
- [] event-register
- [] events-attendance
- [] expiry-settings-info
- [] expiry-settings-update
- [] first-time-user-url
- [] get-my-and-shared-events
- [] get-recording-job
- [x] group-membership-update
- [] learning-path-info
- [] learning-path-update
- [] limited-administrator-permissions-update
- [] limited-administrator-permissionsinfo
- [x] list-recordings
- [x] login
- [x] logout
- [] meeting-disclaimer-info
- [] meeting-disclaimer-update
- [x] meeting-feature-update
- [] notification-list
- [x] permissions-info
- [] permissions-reset
- [x] permissions-update
- [x] principal-info
- [x] principal-list
- [] principal-list-by-field
- [x] principal-update
- [x] principals-delete
- [] process-recording
- [] quota-threshold-exceeded
- [] quota-threshold-info
- [] quota-threshold-update
- [] report-active-meetings
- [] report-asset-response-info
- [] report-bulk-consolidated-transactions
- [] report-bulk-objects
- [] report-bulk-questions
- [] report-bulk-slide-views
- [] report-bulk-users
- [] report-course-status
- [] report-curriculum-taker
- [] report-event-participants-complete-information
- [] report-meeting-attendance
- [] report-meeting-concurrent-users
- [] report-meeting-session-users
- [] report-meeting-sessions
- [] report-meeting-summary
- [] report-my-courses
- [] report-my-events
- [] report-my-meetings
- [] report-my-training
- [] report-quiz-interactions
- [] report-quiz-question-answer-distribution
- [] report-quiz-question-distribution
- [] report-quiz-question-response
- [] report-quiz-summary
- [] report-quiz-takers
- [] report-quotas
- [] report-sco-slides
- [] report-sco-views
- [] report-user-training-transcripts
- [] report-user-trainings-taken
- [] revert-recording
- [] sco-by-url
- [x] sco-contents
- [x] sco-delete
- [] sco-expanded-contents
- [x] sco-info
- [x] sco-move
- [] sco-nav
- [] sco-search
- [] sco-search-by-field
- [] sco-session-seminar-list
- [] sco-shortcuts
- [x] sco-update
- [x] sco-upload
- [] seminar-session-sco-update
- [] telephony-profile-dial-in-number-update
- [] update-sco-url
- [] user-accounts
- [] user-transcript-update
- [x] user-update-pwd

Additional actions to simplify access.

- [x] listRecordings
- [x] principalCreate
- [x] scoCreate

***

- [MIT License](LICENSE)
