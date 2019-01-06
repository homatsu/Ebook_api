<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Textbook;
use App\Repository\CategoryRepository;
use App\Repository\ChapterRepository;
use App\Repository\TextbookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SectionController
 * @Route(methods={"GET"})
 */
class SectionController extends AbstractController
{
    /**
     * @Route("/api/categories", name="api_categories")
     */
    public function getCategoryList(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAllCategories();
            // TODO Simple version with slug and name only for search bar
        return $this->json([
            'message' => 'Categories found',
            'data' => $categories
        ]);
    }

    /**
     * @Route("/api/category/{slug}", name="api_textbooks")
     */
    public function getTextbookList(Category $category, TextbookRepository $textbookRepository)
    {
        $data = $textbookRepository->findAllBooksForCategory($category->getId());
        return $this->json([
            'message' => 'Textbooks found',
            'data' => $data,
            'additionalData' => [
                'name' => $category->getName()
                // TODO if need add more data for category...
            ]
        ]);
    }

    /**
     * @Route("/api/textbook/{slug}", name="api_chapters")
     */
    public function getChapters(Textbook $textbook)
    {
        //TODO change for repository????
        // TODO swap to search with ID
        $chapters = $textbook->getChapters();
        $data = [];
        foreach ($chapters as $chapter) {
            $dataLesson = [];
            $lessons = $chapter->getLessons();
            foreach ($lessons as $lesson) {
                array_push($dataLesson, [
                    'slug' => $lesson->getSlug(),
                    'title' => $lesson->getTitle(),
                ]);
            }
            array_push($data, [
                'slug' => $chapter->getSlug(),
                'number' => $chapter->getNumber(),
                'title' => $chapter->getTitle(),
                'lessons' => $dataLesson
            ]);
        }

        return $this->json([
            'message' => 'Book found',
            'data' => $data
        ]);
    }
}
