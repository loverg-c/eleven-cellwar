<?php

namespace App\Domain\Game\Level;

use App\Domain\User\User;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[Entity]
#[Table(name: 'cell_unit')]
class CellUnits
{
    #[Id]
    #[Column(type: UuidType::NAME, nullable: false)]
    #[GeneratedValue(strategy: 'CUSTOM')]
    #[CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private Uuid $id;

    #[Column(type: 'integer', nullable: false)]
    private int $nbUnits;

    #[ManyToOne(targetEntity: User::class, inversedBy: 'cellUnits')]
    private ?User $user;

    #[ManyToOne(targetEntity: Cell::class, inversedBy: 'cellUnits')]
    private Cell $cell;

    public function __construct(int $nbUnits, ?User $user)
    {
        $this->nbUnits = $nbUnits;
        $this->user = $user;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getNbUnits(): int
    {
        return $this->nbUnits;
    }

    public function setNbUnits(int $nbUnits): self
    {
        $this->nbUnits = $nbUnits;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCell(): Cell
    {
        return $this->cell;
    }

    public function setCell(Cell $cell): self
    {
        $this->cell = $cell;

        return $this;
    }
}