<?php

declare(strict_types=1);

namespace App\Domain\Game;

interface GameSessionRepository
{
    public function save(GameSession $gameSession): void;
}