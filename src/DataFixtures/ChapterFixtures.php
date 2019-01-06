<?php

namespace App\DataFixtures;

use App\Entity\Chapter;
use App\Entity\Textbook;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ChapterFixtures extends BaseFixture implements DependentFixtureInterface
{
    private $usedArticle = [];
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'chapters', function () {
           $chapter = new Chapter();
           $chapter->setTitle($this->faker->sentence(6, true));

            /**
             * @var Textbook $textbook
             */
           $textbook = $this->getRandomReference('textbooks');
           array_push($this->usedArticle, $textbook->getId());
           $count = 0;
           foreach ($this->usedArticle as $num) {
               if($num === $textbook->getId())
                   $count++;
           }

           $chapter->setNumber($count)
                ->setTextbook($textbook);

           return $chapter;
        });


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TextbookFixtures::class
        ];
    }

}
