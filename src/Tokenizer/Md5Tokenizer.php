<?php

namespace src\Tokenizer;

class Md5Tokenizer implements TokenizerInterface
{
    public function getKey($input): string
    {
        return md5($input);
    }
}