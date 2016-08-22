<?php

require __DIR__ . '/../vendor/autoload.php';

use \Bruno\AdobeConnectClient\API;
use \Bruno\AdobeConnectClient\Principal;

$api = new API('https://user.adobeconnect.com');

$api->login('your@email.com', 'password');

// Update User
$user = new Principal();
$user->type = Principal::TYPE_USER;
$user->principalId = 123456789;
$user->firstName = 'First Name';
$user->lastName = 'Last Name';
$user->login = 'email@email.com'; // required
var_dump($api->principalUpdate($user));

// Update Group
$group = new Principal();
$group->type = Principal::TYPE_GROUP;
$group->principalId = 123456789;
$group->name = 'Teachers';
$group->description = 'A group';
var_dump($api->principalUpdate($group));
