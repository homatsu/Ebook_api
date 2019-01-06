<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    /**
     * @Route("/api/image", name="image")
     */
    public function index()
    {
        $testImage = new File('images/category/fizyka.jpg');

        return $this->file($testImage);
//        return $this->render('image/index.html.twig', [
//            'controller_name' => 'ImageController',
//        ]);
    }
}
