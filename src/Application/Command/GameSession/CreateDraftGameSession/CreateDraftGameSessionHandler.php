<?php

declare(strict_types=1);

namespace App\Application\Command\GameSession\CreateDraftGameSession;

use App\Application\Command\CommandHandler;
use App\Domain\Game\GameSession;
use App\Domain\Game\GameSessionRepository;
use App\Domain\Game\Level\Cell;
use App\Domain\Game\Level\CellUnits;

class CreateDraftGameSessionHandler implements CommandHandler
{
    public function __construct(private GameSessionRepository $gameSessionRepository)
    {
    }

    public function handle(CreateDraftGameSession $command): void
    {
        $cells = [];

        for ($x = 0; $x < $command->nbCellX; $x++) {
            for ($y = 0; $y < $command->nbCellY; $y++) {
                $cellUnit = new CellUnits($command->neutralCellHealth, null);

                $cells[] = (new Cell($x, $y))->setCellUnits([$cellUnit]);
            }
        }

        $gameSession = (new GameSession())
            ->setBeginAt($command->beginAt)
            ->setEndAt($command->endAt)
            ->setCells($cells)
        ;

        $this->gameSessionRepository->save($gameSession);
    }
}