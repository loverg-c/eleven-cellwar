<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\ORM\Repository;

use App\Domain\Game\GameSession;
use App\Domain\Game\GameSessionRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
class GameSessionDoctrineRepository extends ServiceEntityRepository implements GameSessionRepository
{
    public function __construct(
        ManagerRegistry $registry
    ) {
        parent::__construct($registry, GameSession::class);
    }

    public function save(GameSession $gameSession): void
    {
        $em = $this->getEntityManager();

        $em->persist($gameSession);
        $em->flush();
    }
}