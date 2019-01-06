<?php

namespace App\DataFixtures;

use App\Entity\Lesson;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LessonFixtures extends BaseFixture implements DependentFixtureInterface
{
    private static $lessonTitle = [
        'Why Asteroids Taste Like Bacon',
        'Life on Planet Mercury: Tan, Relaxing and Fabulous',
        'Light Speed Travel: Fountain of Youth or Fallacy',
    ];

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(75, 'lessons', function () {
            $lesson = new Lesson();
            $lesson->setTitle($this->faker->randomElement(self::$lessonTitle));
            $lesson->setContent('<p><b>Hej</b> To dziala </p>');
            $lesson->setChapter($this->getRandomReference('chapters'));

            return $lesson;
        });

        $manager->flush();
    }

    public function getDependencies()
    {
       return [
           ChapterFixtures::class
       ];
    }
}
