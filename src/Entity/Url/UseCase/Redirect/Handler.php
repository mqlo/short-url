<?php

namespace App\Entity\Url\UseCase\Redirect;

use App\Entity\Url\Source;
use App\Entity\Url\Url;
use App\Repository\UrlRepository;

final class Handler
{
    private UrlRepository $repo;

    public function __construct(UrlRepository $repo)
    {
        $this->repo = $repo;
    }

    public function handle(Command $command): Source
    {
        $url = $this->repo->findByHashLessThanClicks($command->getHash()->getValue(), Url::MAX_CLICKS);

        $url->incClicks();

        $this->repo->flush();

        return $url->getSource();
    }
}