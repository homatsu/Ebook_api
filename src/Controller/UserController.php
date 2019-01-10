<?php

namespace App\Controller;

use App\Entity\Chapter;
use App\Entity\Lesson;
use App\Entity\User;
use App\Entity\UserTextbook;
use App\Repository\ApiTokenRepository;
use App\Repository\LessonRepository;
use App\Repository\UserRepository;
use App\Repository\UserTextbookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/register", name="api_register", methods={"POST"})
     */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();

        $data = json_decode(
            $request->getContent(),
            true
        );
        $userEmail = $data['email'];
        $userPassword = $data['password'];

        $user = new User();
        $user->setEmail($userEmail)
            ->setPassword($encoder->encodePassword($user, $userPassword));
        $em->persist($user);
        $em->flush();

        // TODO message finish and translate
        // TODO handle duplicate entry

        return $this->json([
            'message' => 'Register!!',
            'token' => 'JustSomeSimpleToken',
            'email' => $user->getEmail(),
        ]);
    }

    /**
     * @Route("/login", name="api_login", methods={"POST"})
     */
    public function login(Request $request, UserRepository $userRepository, ApiTokenRepository $apiTokenRepository)
    {
        $data = json_decode(
            $request->getContent(),
            true
        );
        $user = $userRepository->findOneBy(['email' => $data['email']]);

        $tokens = $apiTokenRepository->findBy(['user' => $user]);
        return $this->json([
            'message' => 'Zalogowano!!',
            'token' => $tokens[0]->getToken(),
            'email' => $user->getEmail(),
        ]);
    }

    /**
     * @Route("/api/add/textbook", name="api_add_textbook", methods={"POST"})
     */
    public function addTextbook(Request $request, UserRepository $userRepository, LessonRepository $lessonRepository)
    {
        $data = json_decode(
            $request->getContent(),
            true
        );
        $em = $this->getDoctrine()->getManager();

        $user = $userRepository->findOneBy(['email' => $data['email']]);
        $textbook = new UserTextbook();
        $textbook->setTitle($data['textbook']['title'])
            ->setUser($user);
        $em->persist($textbook);

        $number = 1;
        foreach ($data['textbook']['chapters'] as $chapter) {
            $newChapter = new Chapter();
            $newChapter->setUserTextbook($textbook)
                ->setTitle($chapter['title'])
                ->setNumber($number);
            $em->persist($newChapter);

            foreach ($chapter['lessons'] as $lesson) {
                $oldLesson = $lessonRepository->findOneBy(['slug' => $lesson['slug']]);
                $newLesson = new Lesson();
                $newLesson->setChapter($newChapter)
                    //->setTitle($oldLesson->getTitle())
                    ->setTitle($lesson['title'])
                    ->setContent($oldLesson->getContent());
                $em->persist($newLesson);
            }
            $number++;
        }

        $em->flush();

        return $this->json([
            'message' => 'Book added!!!',
            'wasAdded' => true
        ]);
    }

    /**
     * @Route("/api/user", name="api_userInfo", methods={"POST"})
     */
    public function userInfo(Request $request, UserRepository $userRepository, UserTextbookRepository $userTextbookRepository)
    {
        $data = json_decode(
            $request->getContent(),
            true
        );
        $userEmail = $data['email'];

        $user = $userRepository->findOneBy(['email' => $userEmail]);

        $textbooks = $userTextbookRepository->findBy(['user' => $user]);

        $responseData = [];
        foreach ($textbooks as $textbook) {
            array_push($responseData, [
                'slug' => $textbook->getSlug(),
                'title' => $textbook->getTitle(),
                'id' => $textbook->getId(),
            ]);
        }


        return $this->json([
            'message' => 'User found!!!',
            'data' => $responseData
        ]);
    }
}
