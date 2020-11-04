<?php

namespace App\Entity\Url\Services;

use App\Entity\Url\Hash;
use App\Repository\UrlRepository;

final class Hasher
{
    private UrlRepository $repo;

    public function __construct(UrlRepository $repo)
    {
        $this->repo = $repo;
    }

    public function generate(): Hash
    {
        do {
            $hash = hash('crc32', (new \DateTimeImmutable())->format('Y-m-d H:i:s'));
        } while ($this->repo->hasByHash($hash));

        return new Hash($hash);
    }
}