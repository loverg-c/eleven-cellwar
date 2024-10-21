<?php

declare(strict_types=1);

namespace App\Application\Command\GameSession\CreateDraftGameSession;

use App\Application\Command\Command;

class CreateDraftGameSession implements Command
{
    public function __construct(
        public ?\DateTimeImmutable $beginAt,
        public ?\DateTimeImmutable $endAt,
        public int $nbCellX,
        public int $nbCellY,
        public int $neutralCellHealth
    ) {
    }
}