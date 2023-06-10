<?php

namespace DutchIS;

use Curl\Curl;


enum HttpMethod : string {
    case GET = 'get';
    case POST = 'post';
    case PUT = 'put';
    case DELETE = 'delete';
}

class Api
{
    protected string  $apiEndpoint = 'https://dutchis.net';
    protected string  $teamUuid;
    protected Curl $client;
    private string $apiToken;

    public function __construct(string $apiToken, string $teamUuid)
    {
        if (!isset($apiToken)) {
            throw new \Exception("No API token provided");
        }

        if (!isset($teamUuid)) {
            throw new \Exception("No team uuid provided");
        }

        $this->apiToken = $apiToken;
        $this->teamUuid = $teamUuid;

        $this->client = new Curl();
        $this->client->setHeader('Authorization', "Bearer " . $this->apiToken);
        $this->client->setHeader('X-Team-Uuid', $this->teamUuid);
    }


    private function doRequest(HttpMethod $method, string $path, array $data = null)
    {
        if (substr($path, 0, 1) === '/') {
            $path = substr($path, 1);
        }

        $path = sprintf('%s/api/%s', $this->apiEndpoint, $path);
        $method = $method->value;

        return $this->client->{$method}($path, $data, $method);
    }

    /**
     * Send a GET request to the API
     *
     * @param string $path path to send the request to
     * @param array $data the data to send
     */
    public function get(string $path, array $data = null)
    {
        return $this->doRequest(HttpMethod::GET, $path, $data);
    }

    /**
     * Send a PUT request to the API
     *
     * @param string $path path to send the request to
     * @param array $data the data to send
     */
    public function put(string $path, array $data = null)
    {
        return $this->doRequest(HttpMethod::PUT, $path, $data);
    }

    /**
     * Send a POST request to the API
     *
     * @param string $path path to send the request to
     * @param array $data the data to send
     */
    public function post(string $path, array $data = null)
    {
       return $this->doRequest(HttpMethod::POST, $path, $data);
    }

    /**
     * Send a DELETE request to the API
     *
     * @param string $path path to send the request to
     */
    public function delete(string $path)
    {
       return $this->doRequest(HttpMethod::DELETE, $path, null);
    }
}
