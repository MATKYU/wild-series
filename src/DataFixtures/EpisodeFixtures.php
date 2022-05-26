<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const EPISODES = [
        ['title' => 'First épisode', 'number' => 1, 'synopsis' => 'saison 1 épisode 1', 'season' => 'S1'],
        ['title' => 'Second épisode', 'number' => 2, 'synopsis' => 'saison 1 épisode 2', 'season' => 'S1'],
        ['title' => 'Third épisode', 'number' => 3, 'synopsis' => 'saison 1 épisode 3', 'season' => 'S1'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $episodeFixture) {
            $episode = new Episode();
            $episode->setTitle($episodeFixture['title']);
            $episode->setNumber($episodeFixture['number']);
            $episode->setSynopsis($episodeFixture['synopsis']);
            $episode->setSeason($this->getReference('season_' . $episodeFixture['season']));
            $manager->persist($episode);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            SeasonFixtures::class,
        ];
    }
}
