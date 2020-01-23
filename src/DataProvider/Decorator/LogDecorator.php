<?php

namespace src\DataProvider\Decorator;

use Psr\Log\LoggerInterface;
use src\DataProvider\DataProviderInterface;

class LogDecorator implements DataProviderInterface
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;
    /**
     * @var \src\DataProvider\DataProviderInterface
     */
    private $provider;

    public function __construct(DataProviderInterface $provider, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->provider = $provider;
    }

    /**
     * {@inheritdoc}
     */
    public function get(array $input): array
    {
        try {
            return $this->provider->get($input);
        } catch (\Throwable $e) {
            $this->logger->critical($e->getMessage(), ['e' => $e]);
        }

        return [];
    }
}