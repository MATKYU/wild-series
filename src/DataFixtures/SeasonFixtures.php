<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{

    public const MAX_SEASON = 5;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        
        for ($i = 0; $i < count(ProgramFixtures::SERIES); $i++) {
            for ($j = 1; $j <= self::MAX_SEASON; $j++) {
                $season = new Season();

                $season->setNumber($j);
                $season->setYear(2000 + $j);
                $season->setDescription($faker->paragraphs(3, true));

                $season->setProgram($this->getReference('program_' . $i));

                $this->addReference('season_' . $i . '_' . $j, $season);
                $manager->persist($season);
            }
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
