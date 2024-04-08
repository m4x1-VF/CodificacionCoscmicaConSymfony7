<?php

namespace App\Controller;

use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/starships')]
class StarshipApiController extends AbstractController
{
    #[Route('', name: 'app_starshipapi_getcollection', methods: ['GET'])]
    public function getCollection(StarshipRepository $repository): Response
    {

        $starships = $repository->findAll();

        return $this->json($starships);

    }

    #[Route('/{id<\d+>}', name: 'app_starshipapi_getstarship', methods: ['GET'])]
    public function getStarship($id, StarshipRepository $starshipRepository): Response
    {
        $starship = $starshipRepository->find($id);

        if (!$starship) {
            throw $this->createNotFoundException('Starship not found');
        }

        return $this->json($starship);
    }
}
