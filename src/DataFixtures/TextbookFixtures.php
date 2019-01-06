<?php

namespace App\DataFixtures;

use App\Entity\Textbook;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TextbookFixtures extends BaseFixture implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager)
    {

        $this->createMany(10, 'textbooks', function ($i) {
           $textbook = new Textbook();
           $textbook->setAuthors($this->faker->name)
               ->setEditor($this->faker->name)
               ->setCategory($this->getRandomReference('categories'))
               ->setTitle($this->faker->sentence(2, true))
               ->setImage($this->getRandomReference('images_category'));
           return $textbook;
        });

        $manager->flush();
    }

    public function getDependencies()
    {
       return [
           CategoryFixtures::class
       ];
    }


}
