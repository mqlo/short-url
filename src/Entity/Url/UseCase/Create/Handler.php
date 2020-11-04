<?php

namespace App\Entity\Url\UseCase\Create;

use App\Entity\Url\Id;
use App\Entity\Url\Services\Hasher;
use App\Entity\Url\Source;
use App\Entity\Url\Url;
use App\Repository\UrlRepository;

final class Handler
{
    private UrlRepository $repo;
    private Hasher $hasher;

    public function __construct(UrlRepository $repo, Hasher $hasher)
    {
        $this->repo = $repo;
        $this->hasher = $hasher;
    }

    public function handle(Command $command)
    {
        $url = new Url(
            Id::generate(),
            new Source($command->source),
            $this->hasher->generate()
        );

        $this->repo->add($url);

        $this->repo->flush();
    }
}