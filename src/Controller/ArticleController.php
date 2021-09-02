<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\AjouterArticleType;
use App\Form\UpdatArticleType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{ 
     /**
    * @Route("/admin/{id}/ajouterArticle", name="ajoutArt")
    */
   public function new(UserRepository $userRepo, EntityManagerInterface $manager,Request $request,$id): Response
   {   
       $user=$userRepo->find($id);
       $form = $this->createForm( AjouterArticleType::class);
            $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
   
           $art=$form->getData();
           $art->setUpdatedAt(new \DateTime());
           $manager->persist($art);
           $manager->flush();
       $this->addFlash(
           'notice',
           'Felicitation, votre article a été ajouter avec succès !',
       );
       return $this->redirectToRoute('espaceAdmin',['id' => $user->getId()
       ]);
   }

       return $this->render('formulaire/ajouterArticle.html.twig',[
           'form' => $form->createView()]);
   }

     /**
     * @Route("/admin/{idU}/updateArticle/{id}", name="updateArticle")
     */
    public function updateArticle($idU,UserRepository $userRepo,Request $request,Article $article): Response
    {   
        $user=$userRepo->find($idU);
        $manager = $this->getDoctrine()->getManager();
        $form = $this->createForm( UpdatArticleType::class,$article); 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();
        $this->addFlash(
            'notice',
            'Felicitation, Votre article a bien été modifier !',
        );
        return $this->redirectToRoute('espaceAdmin',['id' => $user->getId()]);
    }
        return $this->render('formulaire/updateArticle.html.twig',[
            'form' => $form->createView()]);
    }
     /**
     * @Route("/admin/{idu}/deleteArticle/{id}", name="suppArt")
     */
    public function deleteArticle(Article $article, UserRepository $userRepo,$idu): Response
    {   $user=$userRepo->find($idu);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($article);
        $manager->flush();
        $this->addFlash(
            'notice',
            'Votre article a été supprimer !!',
        );
        return $this->redirectToRoute('espaceAdmin',['id' => $user->getId()]);
    }
}
