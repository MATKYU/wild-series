<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const SERIES = [
        ['title' => 'Resident evils', 'synopsis' => 'Des zombies envahissent la terre', 'category' => 'Action'],
        ['title' => 'Your Name', 'synopsis' => 'Mitsuha, adolescente coincée dans une famille traditionnelle, rêve de quitter ses montagnes natales pour découvrir la vie trépidante de Tokyo.', 'category' => 'Animation'],
        ['title' => 'Silent Hill: Revelation', 'synopsis' => 'Arrivée à la veille de ses 18 ans, en proie à de terrifiants cauchemars, Heather doit faire face à la disparition soudaine de son père. Elle va découvrir qu\'elle n\'est pas celle qu\'elle croyait être.', 'category' => 'Horreur'],
        ['title' => 'Teen wolf', 'synopsis' => 'Transformé en loup-garou après avoir été mordu par un animal, un lycéen devient un sportif adulé et un bourreau des coeurs qui doit faire face à de nouveaux problèmes.', 'category' => 'Aventure'],
        ['title' => 'stranger things', 'synopsis' => 'En 1983, à Hawkins dans l\'Indiana, Will Byers disparaît de son domicile. Ses amis se lancent alors dans une recherche semée d\'embûches pour le retrouver. Pendant leur quête de réponses, les garçons rencontrent une étrange jeune fille en fuite.', 'category' => 'Fantastique'],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::SERIES as $serie) {
            $program = new Program();
            $program->setTitle($serie['title']);
            $program->setSynopsis($serie['synopsis']);
            $program->setCategory($this->getReference('category_' . $serie['category']));
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
