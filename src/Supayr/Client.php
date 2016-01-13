<?php

namespace Supayr;

use GuzzleHttp\Exception\ClientException;


class Client extends \GuzzleHttp\Client
{
    const API_VERSION = "1.0";
    const API_URL     = "http://alpixel-devbox/app_dev.php/api";

    protected $username;
    protected $apiKey;

    /**
     * @param string  $key   Supayr API Key
     * @param string  $token Supayr API token
     */
    public function __construct($username, $key)
    {
        $this->username = $username;
        $this->apiKey   = $key;
        parent::__construct(['defaults' => [
            'headers' => [
                'user-agent' => 'supayr-php-api/' . phpversion() . '/' . self::API_VERSION
            ]
        ]]);
    }

    /**
     * @param string  $folderToken  Your given token on supayr.com
     */
    public function requestInstance($folderToken)
    {
        return $this->_call('GET', 'instance/new', [
            'username' => $this->username,
            'api_key'  => $this->apiKey,
            'token'    => $folderToken,
        ]);
    }

    /**
     * @param string  $folderToken  Your given token on supayr.com
     */
    public function download($instanceToken)
    {
        return $this->_call('GET', 'download', [
            'username' => $this->username,
            'api_key'  => $this->apiKey,
            'token'    => $instanceToken,
        ]);
    }

    protected function _call($method, $query, $params)
    {
        try {
            $callURL = self::API_URL.'/'.$query;
            $call    = $this->send($this->createRequest(strtolower($method), $callURL, [
                'query' => $params
            ]));

            $response = [
                'statusCode' => $call->getStatusCode(),
                'data'       => $call->json(),
            ];
        }
        catch (ClientException $e) {
            $response = $e->getResponse();
        }
        return $response;
    }
}
