<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ApiImmobilierController extends AbstractController
{
    /**
     * @Route("/api/article", name="api-article",methods="GET")
     */
    public function apiArticle(ArticleRepository $articleRepo,
    NormalizerInterface $normalizer)
    {
        $articles = $articleRepo->findAll();
        $normalized = $normalizer->normalize($articles, null, [
        'groups' => 'article:read'
        ]);
        $json = json_encode($normalized);
        return new Response($json, 200, [
        'content-type' => 'application/json'
        ]);
    }
    /**
     * @Route("/api/user", name="api-user",methods="GET")
     */
    public function apiUser(UserRepository $userRepo,
    NormalizerInterface $normalizer)
    {
        $users = $userRepo->findAll();
        $normalized = $normalizer->normalize($users, null, [
        'groups' => 'user:read'
        ]);
        $json = json_encode($normalized);
        return new Response($json, 200, [
        'content-type' => 'application/json'
        ]);
    }
    
     /**
     * @Route("/api/article", name="articleOfCat", methods="GET")
     */
    public function articles(ArticleRepository $art, NormalizerInterface $normalizer)
    {
        $article = $art->findAll();
    
        $normalized = $normalizer->normalize($article, null, [
            'groups' => 'article:read'
        ]);
        $json = json_encode($normalized);
        return new Response($json, 200, [
            'content-type' => 'application/json'
        ]);
    }
     /**
     * @Route("/api/article/{id}/categorie", name="articleOfCat", methods="GET")
     */
    public function articleOfCat(CategorieRepository $catRepo, NormalizerInterface $normalizer, $id)
    {
        $cat = $catRepo->find($id);
        $article = $cat->getArticles();
        $normalized = $normalizer->normalize($article, null, [
            'groups' => 'article:read'
        ]);
        $json = json_encode($normalized);
        return new Response($json, 200, [
            'content-type' => 'application/json'
        ]);
    }
      

}
