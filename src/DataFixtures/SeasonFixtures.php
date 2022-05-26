<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASONS = [
        ['number' => 1, 'year' => 2016, 'description' => 'En 1983, à Hawkins dans l\'Indiana, Will Byers disparaît de son domicile. Ses amis se lancent alors dans une recherche semée d\'embûches pour le retrouver. Pendant leur quête de réponses, les garçons rencontrent une étrange jeune fille en fuite.', 'program' => 'Stranger things',],
        ['number' => 2, 'year' => 2017, 'description' => 'En 1984, à Hawkins dans l\’Indiana, un an a passé depuis l\'attaque du Démogorgon et la disparition d\'Onze. Will Byers a des visions du Monde à l\'envers et de son maître, une créature gigantesque et tentaculaire. Plusieurs signes indiquent que les monstres vont franchir le portail et revenir sur la ville.', 'program' => 'Stranger things',],
        ['number' => 3, 'year' => 2019, 'description' => 'En 1983, à Hawkins dans l\'Indiana, Will Byers disparaît de son domicile. Ses amis se lancent alors dans une recherche semée d\'embûches pour le retrouver. Pendant leur quête de réponses, les garçons rencontrent une étrange jeune fille en fuite.', 'program' => 'Stranger things',]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SEASONS as $seasonFixture) {
            $season = new Season();
            $season->setNumber($seasonFixture['number']);
            $season->setYear($seasonFixture['year']);
            $season->setDescription($seasonFixture['description']);
            $season->setProgram($this->getReference('program_' . $seasonFixture['program']));
            $this->addReference('season_' . 'S' . $seasonFixture['number'], $season);
            $manager->persist($season);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            ProgramFixtures::class,
        ];
    }
}
