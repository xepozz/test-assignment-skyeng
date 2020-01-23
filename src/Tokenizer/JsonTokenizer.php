<?php

namespace src\Tokenizer;

class JsonTokenizer implements TokenizerInterface
{
    public function getKey($input): string
    {
        return json_encode($input);
    }
}