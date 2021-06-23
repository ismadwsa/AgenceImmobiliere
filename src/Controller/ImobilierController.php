<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Article;
use App\Form\AjouterArticleType;
use App\Form\SearchForm;
use App\Repository\ArticleRepository;
use App\Repository\departementRepository;
use App\Repository\CategorieRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ImobilierController extends AbstractController
{
  
    /**
     * @Route("/", name="accueil")
     */
    public function index(ArticleRepository $articleRepo,CategorieRepository $catRepo): Response {
        $art = $articleRepo->findAll();
        $cat = $catRepo->findAll();
        return $this->render('accueil/index.html.twig', [
            'mesArticles' => $art, 
            'mesCategories'=> $cat,
        ]);
    }

    /**
     * @Route("/admin", name="login")
     */
    public function login(Request $request, UserRepository $userRepo): Response
    {
        $allUsers = $userRepo->findAll();
        foreach ($allUsers as $user) {
            if (
                $user->getEmail() == $request->request->get('email') &&
                $request->request->count() > 0  &&
                $user->getPassword() == $request->request->get('password')
            ) {
                return $this->redirectToRoute('espaceAdmin', ['id' => $user->getId()]);
            }
        }
        if ($request->request->count() == 0)
            return $this->render('login/login.html.twig', [
                'email' => $request->request->get('email')
            ]);

        else return $this->render('login/erreur.html.twig', [
            'email' => $request->request->get('email')
        ]);
    }

    /**
     * @Route("admin/{id}/espaceAdmin", name="espaceAdmin")
     */
    public function espaceAdmin( $id, UserRepository $userRepo,ArticleRepository $artRepo,Request $request): Response {
       
        $user = $userRepo->find($id);
        
        $data= new SearchData();
        $form = $this->createForm( SearchForm::class,$data); 
        $form->handleRequest($request);
    
        $art = $artRepo->findSearch($data);
      
        return $this->render('espaceAdmin/accueilAdmin.html.twig', [
            'connectedUser' => $user,  'mesArticles' => $art,'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/article/{id}/categorie", name="articleOfCat")
     */
    public function articleOfCat(CategorieRepository $catRepo, $id)
    {
        $cat = $catRepo->find($id);
        $article = $cat->getArticles();
        return $this->render('categories/articleOfCategorie.html.twig', [
            'mesArticles' => $article,
        ]);
    }

    /**
     * @Route("article/{id}", name="detailArticle")
     */
    public function afficherArticle(ArticleRepository $artrepo,$id): Response
    {
       

        $monArticle = $artrepo->find($id);

        return $this->render('detailArticle/detailArticle.html.twig', [
            'mesArticles' => $monArticle, 
        ]);
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
        return $this->redirectToRoute('espaceAdmin',['id' => $user->getId()]);
    }

        return $this->render('formulaire/ajouterArticle.html.twig',[
            'form' => $form->createView()]);
    }
}