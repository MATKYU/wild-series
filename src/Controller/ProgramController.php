<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Season;
use App\Entity\Program;
use App\Repository\EpisodeRepository;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;


#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs
         ]);
    }

    #[Route('/show/{id}', requirements: ['id' => '\d+'], methods: ['GET'], name: 'show')]
    public function show(Program $program): Response
    {
        $seasons = $program->getSeasons();
        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $seasons,
        ]);    
    }

    #[Entity('program', options: ['id' => 'programId'])]
    #[Entity('comment', options: ['id' => 'seasonId'])]
    #[Route('/{programId<\d+>}/season/{seasonId<\d+>}', methods: ['GET'], name: 'season_show')]
    public function showSeason(Program $program, Season $season): Response
    {
       
        $episodes = $season->getEpisodes();
        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $episodes,
         ]);
    }

    #[Route('/{programId<\d+>}/season/{seasonId<\d+>}/episode/{episodeId<\d+>}', methods: ['GET'], name: 'episode_show')]
    #[Entity('program', options: ['id' => 'programId'])]
    #[Entity('season', options: ['id' => 'seasonId'])]
    #[Entity('episode', options: ['id' => 'episodeId'])]
    public function showEpisode(Program $program, Season $season, Episode $episode) 
    {
        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode,
        ]);
    }
}
