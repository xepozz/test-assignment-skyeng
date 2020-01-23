<?php

namespace src\DataProvider\Decorator;

use DateTime;
use Psr\Cache\CacheItemPoolInterface;
use src\DataProvider\DataProviderInterface;
use src\Tokenizer\TokenizerInterface;

class CacheDecorator implements DataProviderInterface
{
    /**
     * @var \Psr\Cache\CacheItemPoolInterface
     */
    private $cache;
    /**
     * @var \src\DataProvider\DataProviderInterface
     */
    private $provider;
    /**
     * @var \src\Tokenizer\TokenizerInterface
     */
    private $tokenizer;

    public function __construct(DataProviderInterface $provider, CacheItemPoolInterface $cache, TokenizerInterface $tokenizer)
    {
        $this->cache = $cache;
        $this->provider = $provider;
        $this->tokenizer = $tokenizer;
    }

    /**
     * {@inheritdoc}
     */
    public function get(array $input): array
    {
        $cacheKey = $this->tokenizer->getKey($input);
        $cacheItem = $this->cache->getItem($cacheKey);
        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }

        $result = $this->provider->get($input);

        $cacheItem
            ->set($result)
            ->expiresAt(
                (new DateTime())->modify('+1 day')
            );

        return $result;
    }
}