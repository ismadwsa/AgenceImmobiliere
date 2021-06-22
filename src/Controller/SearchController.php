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
     * @Route("admin/{id}/espaceAdmin/search", name="search")
     */
    public function searchArticle($id,UserRepository $userRepo ,Request $request,ArticleRepository $artRepo): Response
    {  
        $user = $userRepo->find($id);
        $allArticle = $artRepo->findAll();
        $req=$request->request->get('search');
        print($req); 
        foreach ($allArticle as $art) {
         
           if (
                $art->getId() == $req &&
                $request->request->count() > 0 
            ) {
                return $this->render('search/resultat.html.twig', [
                    'mesArticles' => $art, 
                    'ArtREcherche'=> $req,
                    'connectedUser' =>$user                ]);
            }
        }
        return $this->redirectToRoute('espaceAdmin',['id' => $user->getId()]);
            


    }
}
