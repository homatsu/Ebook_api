<?php

namespace App\Controller;

use App\Entity\Lesson;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LessonController extends AbstractController
{
    /**
     * @Route("/api/lesson/{slug}", name="api_lesson")
     */
    public function getLesson(Lesson $lesson)
    {
        return $this->json([
            'message' => 'Lesson found',
            'lesson' => $lesson
        ]);
    }
}
