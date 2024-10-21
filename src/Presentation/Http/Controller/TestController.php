<?php

namespace App\Presentation\Http\Controller;

use App\Application\Command\GameSession\CreateDraftGameSession\CreateDraftGameSession;
use App\Application\Command\GameSession\CreateDraftGameSession\CreateDraftGameSessionHandler;
use App\Domain\User\Planet\PlanetRepository;
use App\Domain\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    public function __construct(
//        private UserRepository $userRepository,
//        private PlanetRepository $planetRepository
    private CreateDraftGameSessionHandler $createDraftGameSessionHandler
    )
    {
    }

    #[Route('/test', name: 'app_test')]
    public function index(): JsonResponse
    {

////        dd($this->userRepository->findAll());
//        $planets = $this->planetRepository->findAll();
//
//        $users = $this->userRepository->findBy(['planet' => $planets[0]]);

        $this->createDraftGameSessionHandler->handle(
            new CreateDraftGameSession(null, null, 10, 10, 500)
        );

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TestController.php',
        ]);
    }
}
