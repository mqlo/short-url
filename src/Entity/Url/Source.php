<?php

namespace App\Entity\Url;

use Webmozart\Assert\Assert;

final class Source
{
    private string $value;

    public function __construct(string $value)
    {
        //лучше применить gex, этот пропускает http://test
        Assert::string(filter_var($value, FILTER_VALIDATE_URL), "В поле ресурс ожидается Url.");
        $this->value = mb_strtolower($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}