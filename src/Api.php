<?php

namespace DutchIS;

use Curl\Curl;

class Api
{
    protected static $apiEndpoint = 'https://dutchis.net/api';
    protected static $teamUuid;
    protected static $client;
    private static $apiToken;

    public function _construct(string $apiToken, string $teamUuid) {
        if (!isset($apiToken)) {
            throw new \Exception("No API token provided");
        }

        if (!isset($teamUuid)) {
            throw new \Exception("No team uuid provided");
        }

        $this->apiToken = $apiToken;
        $this->teamUuid = $teamUuid;
        
        $this->client = new Curl();
        $this->client->setHeader('Authorization', "Bearer ". $this->apiToken);
        $this->client->setHeader('X-Team-Uuid', $this->teamUuid);
    }

    /**
     * Send a GET request to the API
     *
     * @param string $path path to send the request to
     * @param array $data the data to send
     */
    public function get(string $path, array $data = null) {
        if (substr($path, 0, 1) != '/') {
            $path = '/' . $path;
        }

        return $this->client->get($path, $data, "GET");
    }

    /**
     * Send a PUT request to the API
     *
     * @param string $path path to send the request to
     * @param array $data the data to send
     */
    public function put(string $path, array $data = null) {
        if (substr($path, 0, 1) != '/') {
            $path = '/' . $path;
        }

        return $this->client->put($path, $data, "PUT");
    }

    /**
     * Send a POST request to the API
     *
     * @param string $path path to send the request to
     * @param array $data the data to send
     */
    public function post(string $path, array $data = null) {
        if (substr($path, 0, 1) != '/') {
            $path = '/' . $path;
        }

        return $this->client->post($path, $data, "POST");
    }

    /**
     * Send a DELETE request to the API
     *
     * @param string $path path to send the request to
     */
    public function delete(string $path) {
        if (substr($path, 0, 1) != '/') {
            $path = '/' . $path;
        }

        return $this->client->delete($path, null, "DELETE");
    }
}
