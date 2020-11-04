<?php

namespace App\Entity\Url\UseCase\Redirect;

use App\Entity\Url\Hash;

final class Command
{
    private Hash $hash;

    public function __construct(Hash $hash)
    {
        $this->hash = $hash;
    }

    public function getHash(): Hash
    {
        return $this->hash;
    }
}