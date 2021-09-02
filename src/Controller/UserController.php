<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UpdateUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        return $this->render('user/cordonnées.html.twig', [
            'connectedUser' => $user
        ]);
    }
    /**
     * @Route("/deco", name="deco")
     */
    public function deco(): Response
    {
        return $this->redirectToRoute('accueil');
    }
    /**
     * @Route("/updateUser/{id}", name="updateUser")
     */
    public function updateUser(Request $request,User $user): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $form = $this->createForm( UpdateUserType::class,$user); 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();
        $this->addFlash(
            'notice',
            'Felicitation,modification de vos cordonnées avec succées !',
        );
        return $this->redirectToRoute('espaceAdmin',['id' => $user->getId()]);
    }

        return $this->render('formulaire/updateUser.html.twig',[
            'formUser' => $form->createView()]);
    }
}
