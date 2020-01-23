<?php

namespace src\DataProvider;

interface DataProviderInterface
{
    public function get(array $input): array;
}