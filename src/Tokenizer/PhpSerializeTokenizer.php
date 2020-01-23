<?php

namespace src\Tokenizer;

class PhpSerializeTokenizer implements TokenizerInterface
{
    public function getKey($input): string
    {
        return serialize($input);
    }
}