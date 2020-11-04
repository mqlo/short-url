<?php

namespace App\Entity\Url;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class SourceType extends StringType
{
    public const NAME = 'url_source';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Source ? $value->getValue() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new Source((string)$value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}