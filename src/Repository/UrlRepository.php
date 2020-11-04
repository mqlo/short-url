<?php

namespace App\Repository;

use App\Entity\Url\Url;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

final class UrlRepository
{
    private EntityManagerInterface $em;
    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(Url::class);
    }

    public function flush(): void
    {
        $this->em->flush();
    }

    public function refresh(Url $url): void
    {
        $this->em->refresh($url);
    }

    public function findByHashLessThanClicks(string $hash, int $clicks): Url
    {
        $url = $this->repo->createQueryBuilder('t')
            ->andWhere('t.hash = :hash')
            ->andWhere('t.clicks < :clicks')
            ->setParameter(':hash', $hash)
            ->setParameter(':clicks', $clicks)
            ->getQuery()->getOneOrNullResult();
        if (!$url instanceof Url)
            throw new EntityNotFoundException("Url не найден");

        return $url;
    }

    public function all(): array
    {
        return $this->repo->findAll();
    }

    public function add(Url $url): void
    {
        $this->em->persist($url);
    }

    public function remove(Url $url): void
    {
        $this->em->remove($url);
    }

    public function hasByHash(string $value): bool
    {
        return $this->repo->createQueryBuilder('t')
                ->select('COUNT(t.id)')
                ->andWhere('t.hash = :hash')
                ->setParameter(':hash', $value)
                ->getQuery()
                ->getSingleScalarResult() > 0;
    }
}
