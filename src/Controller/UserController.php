<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    /**
     * @Route("/users/{id}/user", name="user")
     */
    public function user($id, UserRepository $userRepo): Response
    {
        $user = $userRepo->find($id);
        return $this->render('user/user.html.twig', [
            'connectedUser' => $user
        ]);
    }
    /**
     * @Route("/deco", name="deco")
     */
    public function deco(): Response
    {
        return $this->redirectToRoute('admin');
    }
    /**
     * @Route("/updateUser/{id}", name="updateUser")
     */
    public function updateUser(Request $request, User $useree): Response
    {
        $manager = $this->getDoctrine()->getManager();
        if ($request->request->count() == 0) {
            return $this->render('espaceAdmin/updateUser.html.twig', [
                'myUser' => $useree
            ]);
        } else {
            $useree->setNom($request->request->get('nom'));
            $useree->setPrenom($request->request->get('prenom'));
            $useree->setEmail($request->request->get('email'));
            $useree->setPassword($request->request->get('password'));
            $manager->persist($useree);
            $manager->flush();
            return $this->redirectToRoute('user', ['id' => $useree->getId()]);
        }
    }
}
