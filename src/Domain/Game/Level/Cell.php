<?php

namespace App\Domain\Game\Level;

use App\Domain\Game\GameSession;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[Entity]
#[Table(name: 'cell')]
class Cell
{
    #[Id]
    #[Column(type: UuidType::NAME, nullable: false)]
    #[GeneratedValue(strategy: 'CUSTOM')]
    #[CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private Uuid $id;

    #[Column(type: 'integer', nullable: false)]
    private int $posX;

    #[Column(type: 'integer', nullable: false)]
    private int $posY;

    #[Column(type: 'boolean', nullable: false)]
    private bool $isSpawn = false;

    #[OneToMany(targetEntity: CellUnits::class, mappedBy: 'cell', cascade: ['all'])]
    private Collection $cellUnits;

    #[ManyToOne(targetEntity: GameSession::class, inversedBy: 'cells')]
    private GameSession $gameSession;

    public function __construct(int $posX, int $posY)
    {
        $this->posX = $posX;
        $this->posY = $posY;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getPosX(): int
    {
        return $this->posX;
    }

    public function setPosX(int $posX): self
    {
        $this->posX = $posX;

        return $this;
    }

    public function getPosY(): int
    {
        return $this->posY;
    }

    public function setPosY(int $posY): self
    {
        $this->posY = $posY;

        return $this;
    }

    public function isSpawn(): bool
    {
        return $this->isSpawn;
    }

    public function setIsSpawn(bool $isSpawn): self
    {
        $this->isSpawn = $isSpawn;

        return $this;
    }

    public function getGameSession(): GameSession
    {
        return $this->gameSession;
    }

    public function setGameSession(GameSession $gameSession): self
    {
        $this->gameSession = $gameSession;

        return $this;
    }

    public function getCellUnits(): Collection
    {
        return $this->cellUnits;
    }

    public function setCellUnits(Collection|array $cellUnits): self
    {
        if (!$cellUnits instanceof Collection) {
            $cellUnits = new ArrayCollection($cellUnits);
        }
        $this->cellUnits = $cellUnits;

        return $this;
    }
}