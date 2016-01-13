<?php

namespace Supayr;


class Client extends \GuzzleHttp\Client
{
    const API_VERSION = "1.0";
    const API_URL     = "http://alpixel-devbox/app_dev.php/api/";

    protected $username;
    protected $apiKey;

    /**
     * @param string  $key   Supayr API Key
     * @param string  $token Supayr API token
     */
    public function __construct($username, $key)
    {
        parent::__construct(['defaults' => [
            'headers' => [
                'user-agent' => 'supayr-php-api/' . phpversion() . '/' . self::API_VERSION
            ]
        );
        $this->username = $username;
        $this->apiKey   = $key;
    }

    public function requestInstance($folderToken)
    {
    }

    public function call()
    {
        $response = null;
        if ($call) {
            try {
                $response = call_user_func_array(
                    array($this, strtolower($this->method)), [
                    $this->url, [
                            'headers'  => ['content-type' => $this->type],
                            'query' => $this->filters,
                            'json' => $this->body,
                            'auth' => $this->auth
                        ]
                    ]
                );
            }
            catch (\GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();
            }
        }

        return [];
    }
}
