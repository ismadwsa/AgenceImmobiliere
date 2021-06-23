<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

class SearchController extends AbstractController
{
    /**
    //  * @Route("admin/{id}/espaceAdmin/search", name="search")
    //  */
    // public function searchArticle($id,UserRepository $userRepo ,Request $request,ArticleRepository $artRepo): Response
    // {  
    //     $user=$userRepo->find($id);
    //     $form = $this->createForm( SearchForm::class);
     
    //          $form->handleRequest($request);
       
           
    //          if ($form->isSubmitted() && $form->isValid()) {

    //             $art=$form->getData();
    //             $art->setUpdatedAt(new \DateTime());
    //             $manager->persist($art);
    //             $manager->flush();
    //         $this->addFlash(
    //             'notice',
    //             'Felicitation, votre article a été ajouter avec succès !',
    //         );
    //         return $this->redirectToRoute('espaceAdmin',['id' => $user->getId()]);
    //      }
         
    //         return $this->render('formulaire/ajouterArticle.html.twig',[
    //             'form' => $form->createView()]);
    //      }
     
    }
