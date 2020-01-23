<?php

namespace src\Tokenizer;

interface TokenizerInterface
{
    public function getKey($input): string;
}