<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait TimestampableEntity
{
    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $updatedAt;

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $now = new \DateTimeImmutable('now');

        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $now = new \DateTimeImmutable('now');
        $this->updatedAt = $now;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }
}