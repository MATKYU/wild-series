<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < count(ProgramFixtures::SERIES); $i++) {
            for ($k = 1; $k <= SeasonFixtures::MAX_SEASON; $k++) {
                for ($j = 1; $j <= 20; $j++) {
                    $episode = new Episode();

                    $episode->setTitle($faker->sentence(4, true));
                    $episode->setNumber($j);
                    $episode->setSynopsis($faker->paragraphs(3, true));

                    $episode->setSeason($this->getReference('season_' . $i . '_' . $k));

                    $manager->persist($episode);
                }
            }
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
