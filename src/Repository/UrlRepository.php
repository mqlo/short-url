<?php

namespace App\Repository;

use App\Entity\Url\Url;
use Doctrine\ORM\EntityManagerInterface;

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
