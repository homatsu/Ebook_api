<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ImageFixtures extends BaseFixture
{
    private static $imagesList = [
        'chemia.jpg',
        'fizyka.jpg',
        'matematyka.jpg'
    ];

    private static $imagesListTextbook = [
        'test1.jpg',
        'test2.jpg',
        'test3.jpg',
        'test4.jpg',
        'test5.jpg',
        'test6.jpg',
    ];


    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(3, 'images_category', function ($i) {
            $image = new Image();
            $image->setPath('/images/category/')
                ->setName(self::$imagesList[$i]);

            return $image;
        });

        $this->createMany(6, 'images_book_yea', function ($i) {
            $image = new Image();
            $image->setPath('/images/textbook/')
                ->setName(self::$imagesListTextbook[$i]);

            return $image;
        });


        $manager->flush();
    }
}
