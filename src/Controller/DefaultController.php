<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use App\Repository\SeasonRepository;
use App\Repository\EpisodeRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(ProgramRepository $programRepository, 
    SeasonRepository $seasonRepository, 
    EpisodeRepository $episodeRepository): Response
    {
        $programs = $programRepository->findAll();
        $seasons = $seasonRepository->findAll();
        $episodes = $episodeRepository->findAll();
        return $this->render('home/index.html.twig', [
            'nbPrograms' => count($programs),
            'nbSeasons' => count($seasons),
            'nbEpisodes' => count($episodes),
        ]);
    }
}
