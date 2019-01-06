<?php

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends BaseFixture implements DependentFixtureInterface
{
    private static $categories = [
        'Fizyka',
        'Chemia',
        'Matematyka',
        'Geografia'
    ];
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(3, 'categories', function ($i) {
           $category = new Category();
           $category->setName(self::$categories[$i])
               ->setImage($this->getRandomReference('images'));

           return $category;
        });

        $manager->flush();
    }

    public function getDependencies()
    {
       return [ImageFixtures::class];
    }


}
