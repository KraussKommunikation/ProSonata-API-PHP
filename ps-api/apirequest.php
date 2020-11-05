<?php

/**
 * ProSonata API Request
 */

define( 'API_METHOD_GET', 'GET' );
define( 'API_METHOD_POST', 'POST' );

class APIRequest {

    /**
     * ProSonata API
     */
    private $prosonataAPI = null;

    /**
     * API Endpoint
     */
    private $endpoint = "";

    /**
     * Method
     */
    private $method = API_METHOD_GET;

    /**
     * Get Parameters
     */
    private $getParams = [];

    /**
     * Post Parameters
     */
    private $postParams = [];

    /**
     * Is executed
     */
    private $executed = false;

    /**
     * Result
     */
    private $result = [];

    /**
     * APIRequest class constructor
     * @since 1.0
     */
    function __construct(ProSonataAPI $prosonataAPI, string $endpoint) {
        $this->prosonataAPI = $prosonataAPI;
        $this->endpoint = $endpoint;
    }

    /**
     * Set Request method
     * @since 1.0
     */
    function setMethod(string $method) {
        if($method === API_METHOD_GET || $method === API_METHOD_POST) {
            $this->method = $method;
        }
    }

    /**
     * Set Get parameters
     * @since 1.0
     */
    function setGetParams(array $params) {
        $this->getParams = $params;
    }

    /**
     * Set Post parameters
     * @since 1.0
     */
    function setPostParams(array $params) {
        $this->postParams = $params;
    }

    /**
     * Send API Request
     * @since 1.0
     */
    function send() {

        if($this->executed) {
            return;
        }

        // Initialize cURL
        $curl = curl_init();

        // Setup header
        $headers = array(
            'Content-Type: application/json',
        );

        $this->getParams['appID'] = $this->prosonataAPI->getAppID();
        $this->getParams['apiKey'] = $this->prosonataAPI->getAPIToken();
        $getParams = http_build_query($this->getParams);

        // Setup cURL
        curl_setopt($curl, CURLOPT_URL, $this->prosonataAPI->getWorkspace() . '/' . $this->endpoint . '?' . $getParams);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        // Set Method
        if($this->method === API_METHOD_POST){
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->postParams));
        }

        // Execute cURL
        $curl_result = curl_exec($curl);

        // Close cURL
        curl_close($curl);

        // Parse result to JSON
        $json_result = json_decode($curl_result, true);

        $this->result = $json_result;
        $this->executed = true;
    }

    /**
     * Check if request already executed
     * @since 1.0
     */
    function isExecuted() {
        return $this->executed;
    }

    /**
     * Check if request failed
     * @since 1.0
     */
    function hasError() {
        return ($this->result['meta']['status'] !== 200);
    }

    /**
     * Get the error message
     * @since 1.0
     */
    function getErrorMessage() {
        return ($this->result['meta']['message']);
    }

    /**
     * Get Result Data
     * @since 1.0
     */
    function getData() {
        return ($this->result['data']);
    }

    /**
     * Get Result meta
     * @since 1.0
     */
    function getMeta() {
        return ($this->result['meta']);
    }

}