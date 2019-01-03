<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ApiTokenRepository;
use App\Repository\UserRepository;
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
            'message' => 'Register!!'
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
            'token' => $tokens[0]->getToken()
        ]);
    }
}
