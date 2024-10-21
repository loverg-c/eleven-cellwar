<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Game\GameSession;
use App\Domain\Game\Level\CellUnits;
use App\Domain\User\Planet\Planet;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[Entity]
#[Table('app_user')]
class User
{
    #[Id]
    #[Column(type: UuidType::NAME, nullable: false)]
    #[GeneratedValue(strategy: 'CUSTOM')]
    #[CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private Uuid $id;

    #[Column(type: 'string', nullable: false)]
    private string $firstName;

    #[Column(type: 'string', nullable: false)]
    private string $lastName;

    #[Column(type: 'string', nullable: false)]
    private string $email;

    #[ManyToOne(targetEntity: Planet::class, fetch: 'EAGER', inversedBy: 'users')]
    private ?Planet $planet;

    #[OneToMany(targetEntity: CellUnits::class, mappedBy: 'user')]
    private Collection $cellUnits;

    #[ManyToMany(targetEntity: GameSession::class, mappedBy: 'usersRegistred')]
    private Collection $gameSessions;

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPlanet(): ?Planet
    {
        return $this->planet;
    }

    public function setPlanet(?Planet $planet): self
    {
        $this->planet = $planet;

        return $this;
    }

    public function getCellUnits(): Collection
    {
        return $this->cellUnits;
    }

    public function setCellUnits(Collection $cellUnits): self
    {
        $this->cellUnits = $cellUnits;

        return $this;
    }

    public function getGameSessions(): Collection
    {
        return $this->gameSessions;
    }

    public function setGameSessions(Collection $gameSessions): self
    {
        $this->gameSessions = $gameSessions;

        return $this;
    }
}