<?php

namespace App\Entity\Url;

use App\Repository\UrlRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="urls")
 */
final class Url
{
    /**
     * @ORM\Column(type="url_id")
     * @ORM\Id
     */
    private Id $id;

    /**
     * @ORM\Column(type="url_source", length=255)
     */
    private Source $source;

    /**
     * @ORM\Column(type="url_hash", length=255, unique=true)
     */
    private Hash $hash;

    /**
     * @ORM\Column(type="smallint", options={"default": "0", "unsigned": true})
     */
    private int $clicks;

    public function __construct(Id $id, Source $source, Hash $hash, int $clicks = 0)
    {
        $this->id = $id;
        $this->source = $source;
        $this->hash = $hash;
        $this->clicks = $clicks;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getSource(): Source
    {
        return $this->source;
    }

    public function getHash(): Hash
    {
        return $this->hash;
    }

    public function getClicks(): int
    {
        return $this->clicks;
    }

    public function incClicks(): self
    {
        $this->clicks++;

        return $this;
    }

    public function __toString(): string
    {
        return "Url";
    }
}
