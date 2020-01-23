<?php

namespace src\DataProvider;

use src\Client\ClientInterface;

class DataProvider
{
    /**
     * @var \src\Client\ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param array $request
     * @return array
     */
    public function get(array $request)
    {
        return $this->client->get($request);
    }
}