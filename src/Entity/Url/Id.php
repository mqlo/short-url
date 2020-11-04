<?php

namespace App\Entity\Url;

use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

final class Id
{
    private string $value;

    public function __construct(string $uuid)
    {
        Assert::uuid($uuid, "Значение Id должно быть UUID.");
        $this->value = mb_strtolower($uuid);
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    public function getValue(): string
    {
        return $this->value;
    }

    //для конвертации id в строку и обратно (для doctrine implode)
    public function __toString(): string
    {
        return $this->getValue();
    }
}