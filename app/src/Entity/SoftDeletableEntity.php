<?php

namespace App\Entity;

use DateTimeInterface;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

#[Gedmo\SoftDeleteable(fieldName: 'deletedAt')]
trait SoftDeletableEntity
{
    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $deletedAt;

    public function getDeletedAt(): \DateTimeInterface
    {
        return $this->deletedAt;
    }
}