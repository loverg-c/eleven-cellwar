<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\ORM\Repository;

use App\Domain\User\Planet\Planet;
use App\Domain\User\Planet\PlanetRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
class PlanetDoctrineRepository extends ServiceEntityRepository implements PlanetRepository
{
    public function __construct(
        ManagerRegistry $registry
    ) {
        parent::__construct($registry, Planet::class);
    }
}