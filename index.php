<?php

/**
 * Example
 * 
 * You can remove this file, it's just to show you how it works.
 */

/**
 * Include ProSonataAPI
 */
require_once __DIR__ . '/ps-api/load.php';

/**
 * Create new ProSonata API
 */
$prosonataAPI = new ProSonataAPI('https://subdomain.prosonata.software/api/v1', 'app', 'token');

/**
 * Create a new Request
 */
$request = new APIRequest($prosonataAPI, 'contacts');

/**
 * Execute
 */
$request->send();

/**
 * Validate
 */
if($request->hasError()){

    /**
     * Echo error message
     */
    echo $request->getErrorMessage();

}else {

    /**
     * Print out data
     */
    print_r($request->getData());

}