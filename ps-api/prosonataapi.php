<?php

/**
 * ProSonata API
 */

class ProSonataAPI {

    /**
     * Workspace
     */
    private $workspace = "";

    /**
     * App ID
     */
    private $appID = "";

    /**
     * API Token
     */
    private $token = "";

    /**
     * ProSonataAPI Constructor
     * @since 1.0
     */
    function __construct(string $workspace, string $app, string $token) {
        $this->workspace = $workspace;
        $this->appID = $app;
        $this->token = $token;
    }

    /**
     * Get ProSonata Workspace
     * @since 1.0
     */
    function getWorkspace():string {
        return $this->workspace;
    }

    /**
     * Get ProSonata AppID
     * @since 1.0
     */
    function getAppID():string {
        return $this->appID;
    }

    /**
     * Get ProSonata API Token
     * @since 1.0
     */
    function getAPIToken():string {
        return $this->token;
    }

}