<?php

namespace App\Domain\Game;

use App\Domain\Game\Level\Cell;
use App\Domain\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[Entity]
#[Table(name: 'game_session')]
class GameSession
{
    #[Id]
    #[Column(type: UuidType::NAME, nullable: false)]
    #[GeneratedValue(strategy: 'CUSTOM')]
    #[CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private Uuid $id;

    #[Column(type: 'datetime', nullable: true)]
    private ?\DateTimeImmutable $beginAt;

    #[Column(type: 'datetime', nullable: true)]
    private ?\DateTimeImmutable $endAt;

    #[OneToMany(targetEntity: Turn::class, mappedBy: 'gameSession')]
    private Collection $turns;

    #[OneToMany(targetEntity: Cell::class, mappedBy: 'gameSession', cascade: ['all'])]
    private Collection $cells;

    #[ManyToMany(targetEntity: User::class, inversedBy: 'gameSession')]
    private Collection $usersRegistred;

    #[Column(type: 'boolean', nullable: false)]
    private bool $draft = true;

    public function __construct()
    {
        $this->turns = new ArrayCollection();
        $this->cells = new ArrayCollection();
        $this->usersRegistred = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getBeginAt(): ?\DateTimeImmutable
    {
        return $this->beginAt;
    }

    public function setBeginAt(?\DateTimeImmutable $beginAt): self
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeImmutable $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getTurns(): Collection
    {
        return $this->turns;
    }

    public function setTurns(Collection $turns): self
    {
        $this->turns = $turns;

        return $this;
    }

    public function getCells(): Collection
    {
        return $this->cells;
    }

    public function setCells(array|Collection $cells): self
    {
        if (!$cells instanceof Collection){
            $cells = new ArrayCollection($cells);
        }

        $this->cells = $cells;

        return $this;
    }

    public function getTurnForDateTime(\DateTimeImmutable $dateTime): ?Turn
    {
        $turn = $this
            ->turns
            ->filter(fn (Turn $turn) => $turn->getBeginAt() <= $dateTime)
            ->last()
        ;

        return $turn instanceof Turn ? $turn : null;
    }

    public function currentTurn(): ?Turn
    {
        return $this->getTurnForDateTime(new \DateTimeImmutable());
    }

    public function getTurnIndex(Turn $turn): ?int
    {
        $turns = $this->turns->toArray();

        usort($turns, static fn (Turn $a, Turn $b) => $a->getBeginAt() <=> $b->getBeginAt());

        $index = array_search($turn, $turns, true);

        return $index === false ? null : $index;
    }

    public function getUsersRegistred(): Collection
    {
        return $this->usersRegistred;
    }

    public function setUsersRegistred(Collection $usersRegistred): self
    {
        $this->usersRegistred = $usersRegistred;

        return $this;
    }

    public function isDraft(): bool
    {
        return $this->draft;
    }

    public function setDraft(bool $draft): self
    {
        $this->draft = $draft;

        return $this;
    }
}