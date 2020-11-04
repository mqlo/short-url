<?php

namespace App\Entity\Url;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

final class IdType extends GuidType
{
    public const NAME = 'url_id';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Id ? $value->getValue() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new Id((string)$value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    // true - для добавления комментариев столбцу, чтобы доктрина понимала типы столбца url_id в коде ~ uuid в БД
    // Пример из миграции: $this->addSql('COMMENT ON COLUMN urls.id IS \'(DC2Type:url_id)\'');
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}