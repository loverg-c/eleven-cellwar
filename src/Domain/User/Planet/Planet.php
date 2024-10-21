<?php

declare(strict_types=1);

namespace App\Domain\User\Planet;

use App\Domain\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[Entity]
#[Table(name: 'planet')]
class Planet
{
    #[Id]
    #[Column(type: UuidType::NAME, nullable: false)]
    #[GeneratedValue(strategy: 'CUSTOM')]
    #[CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private Uuid $id;

    #[Column(type: 'string', nullable: false)]
    private string $name;

    #[Column(type: 'string', nullable: false)]
    private string $imagePath;

    #[Column(type: 'string', nullable: false)]
    private string $colorCode;

    #[OneToMany(targetEntity: User::class, mappedBy: 'planet', fetch: 'EAGER')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): self
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getColorCode(): string
    {
        return $this->colorCode;
    }

    public function setColorCode(string $colorCode): self
    {
        $this->colorCode = $colorCode;

        return $this;
    }

    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function setUsers(array|Collection $users): self
    {
        if (!$users instanceof Collection) {
            $users = new ArrayCollection($users);
        }

        $this->users = $users;

        return $this;
    }

    public function addUser(User $doctrineUser): self
    {
        $this->users->add($doctrineUser);

        return $this;
    }

    public function removeUser(User $doctrineUser): self
    {
        $this->users->removeElement($doctrineUser);

        return $this;
    }
}