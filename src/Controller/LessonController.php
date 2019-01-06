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
        $data = [
            'id' => $lesson->getId(),
            'title' => $lesson->getTitle(),
            'content' => $lesson->getContent(),
            'slug' => $lesson->getSlug(),
        ];
        return $this->json([
            'message' => 'Lesson found',
            'data' => $data
        ]);
    }
}
