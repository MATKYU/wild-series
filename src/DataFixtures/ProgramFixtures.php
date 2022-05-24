<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const SERIES = [
        ['Title' => 'Resident evils', 'Synopsis' => 'Des zombies envahissent la terre', 'Category' => 'Action'],
        ['Title' => 'Your Name', 'Synopsis' => 'Mitsuha, adolescente coincée dans une famille traditionnelle, rêve de quitter ses montagnes natales pour découvrir la vie trépidante de Tokyo.', 'Category' => 'Animation'],
        ['Title' => 'Silent Hill: Revelation', 'Synopsis' => 'Arrivée à la veille de ses 18 ans, en proie à de terrifiants cauchemars, Heather doit faire face à la disparition soudaine de son père. Elle va découvrir qu\'elle n\'est pas celle qu\'elle croyait être.', 'Category' => 'Horreur'],
        ['Title' => 'Teen wolf', 'Synopsis' => 'Transformé en loup-garou après avoir été mordu par un animal, un lycéen devient un sportif adulé et un bourreau des coeurs qui doit faire face à de nouveaux problèmes.', 'Category' => 'Aventure'],
        ['Title' => 'stranger things', 'Synopsis' => 'En 1983, à Hawkins dans l\'Indiana, Will Byers disparaît de son domicile. Ses amis se lancent alors dans une recherche semée d\'embûches pour le retrouver. Pendant leur quête de réponses, les garçons rencontrent une étrange jeune fille en fuite.', 'Category' => 'Fantastique'],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::SERIES as $serie) {
            $program = new Program();
            $program->setTitle($serie['Title']);
            $program->setSynopsis($serie['Synopsis']);
            $program->setCategory($this->getReference('category_' . $serie['Category']));
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
