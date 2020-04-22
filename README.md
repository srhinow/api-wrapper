# legito/api-wrapper
PHP wrapper for Legito REST API requests.

Wrapper currently support Legito API v1. Legacy API is not suppoted anymore.

English documentation for API [https://app.swaggerhub.com/apis-docs/Legito/legito-api/1](https://app.swaggerhub.com/apis-docs/Legito/legito-api/1)


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
$legitoApi = new Legito($apiKey, $privateKey, $url)->getWrapper();

// Call some API methods
// ------------------------------------------------------------------------

// Creates smart document from template suite ID 2255. Insets some data to input 
// element 'first_party_name1' and downloads it.
$smartDocument = $this->legitoApi->postSmartDocumentData(
    2255,
    [
         [
              'name' => 'first_party_name1',
              'value' => 'John Doe'
         ]
    ]
);
$documentsData = $this->legitoApi->getSmartDocumentDownload($smartDocument->code, 'pdf');
foreach($documentsData as $documentData) {
    file_put_contents(
        $documentData->filename,
        base64_decode($documentData->data)
    );
}

// Prints all users form your workspace.
$users = $legitoApi->getUser();
print_r($users);

// Creates two users in your workspace.
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

// Deletes user form your workspace.
$legitoApi->deleteUser('johndoe@legito.com');
```