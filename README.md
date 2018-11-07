# legito/api-wrapper
PHP wrapper for Legito REST API requests.

English documentation for API [https://app.swaggerhub.com/apis-docs/Legito/legito-api/1.0](https://app.swaggerhub.com/apis-docs/Legito/legito-api/1.0)


## Install
The preferred way to install this package is through [composer](http://getcomposer.org/download/).

```
composer require legito/api-wrapper
```

## Basic usage

``` php
<?php

use Legito\Api\Legito;

// Configure API wrapper
$apiKey = 'ad2e37c9-ee63-4479-9295-36cf21674343';
$privateKey = '37c2f78b02';
//$url = 'https://example.legito.com/api/v1.0'; // use only if you run Legito on custom server

// Create instance
$legitoApi = new Legito($apiKey, $privateKey, $url);

// Call some API methods

$users = $legitoApi->getUser();
print_r($users);

$legitoApi->postUser(
    [
         [       
            'email' => 'johndoe@legito.com',
            'name' => 'John Doe'
         ],
         [
             'email' => 'janedee@legito.com',
             'name' => 'Jane Dee',
             'caption' => 'CEO'
         ]
    ]
);

$legitoApi->deleteUser('johndoe@legito.com');
```