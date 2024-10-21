<?php

namespace App\Domain\Game;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'game_turn')]
class Turn
{
    #[Id]
    #[Column(type: 'datetime', nullable: false)]
    private \DateTimeImmutable $beginAt;

    #[ManyToOne(targetEntity: GameSession::class, inversedBy: 'turns')]
    private GameSession $gameSession;

    public function getBeginAt(): \DateTimeImmutable
    {
        return $this->beginAt;
    }

    public function setBeginAt(\DateTimeImmutable $beginAt): self
    {
        $this->beginAt = $beginAt;

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
}