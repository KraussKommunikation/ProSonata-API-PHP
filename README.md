# ProSonata API PHP
Simple PHP API to access ProSonata API

1. [Installation](#installation)
1. [Classes](#classes)
    1. [ProSonataAPI](#apirequest)
    1. [APIRequest](#apirequest)
1. [Updating](#updating)

# Installation

Copy the `ps-api` folder into your php project and import it using

```php
require_once 'ps-api/load.php';
```

It's that simple! :D

# Classes

### ProSonataAPI

Create a connection to the ProSonata API:
```php
$prosonataAPI = new ProSonataAPI( 
    'https://subdomain.prosonata.software/api/v1',
    'app_id',
    'api_token'
);
```
> This is just the setup for APIRequests. This class doesn't send any requests to ProSonata, so the API use count isn't affected.

### APIRequest

Create a new Request:
```php
$request = new APIRequest( $prosonataAPI, 'api_endpoint' );
```
> Endpoint examples: `contacts`, `customers`, ...

The default method is GET, but you can change it:
```php
$request->setMethod( API_METHOD_GET ); // For GET
$request->setMethod( API_METHOD_POST ); // For POST
```

If you want to set extra parameters:
```php
$request->setGetParams( array( 'foo' => 'bar' ) ); // GET Parameters
$request->setPostParams( array( 'foo' => 'bar' ) ); // POST Paramters
```

If your request is ready, send it:
```php
$request->send();
```

Now, check if the request was successfull:
```php
if( $request->hasError() ){
    // Error
    $errormessage = $request->getErrorMessage();
    ...
}else {
    // Everything OK
    ...
}
```

If you checked for errors, you can get the response:
```php
$result_data = $request->getData(); // Get the data
$result_meta = $request->getMeta(); // Get request meta
```

# Updating

To update, just replace your `ps-api` folder with the new one.

Don't forget to check if any classes or functions changed and you've to update your code.