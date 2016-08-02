<?php

require __DIR__ . '/../vendor/autoload.php';

use \Bruno\AdobeConnectClient\API;
use \Bruno\AdobeConnectClient\Principal;

$api = new API('https://user.adobeconnect.com');

$api->login('your@email.com', 'password');

// Creating User
$user = new Principal();
$user->type = Principal::TYPE_USER;
$user->hasChildren = false; // User doesn't have children
$user->firstName = 'First Name';
$user->lastName = 'Last Name';
$user->login = 'email@email.com';
$user->email = 'email@email.com'; // Need be the same as login
$user->password = '123securePassword';
$user->sendEmail = true; // Send e-mail with info about the new registered user
$userCreated = $api->principalCreate($user);
var_dump($userCreated);

// Creating Group
$group = new Principal();
$group->type = Principal::TYPE_GROUP;
$group->hasChildren = true; // Group has children
$group->name = 'Teachers';
$group->description = 'A group';
$groupCreated = $api->principalCreate($group);
var_dump($groupCreated);
