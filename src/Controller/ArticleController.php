<?php

namespace App\Controller;

use App\Form\ArticleType;
use App\Entity\Article;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index()
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }
	
	/**
     * @Route("/add_article", name="app_add_article")
     */
    public function add_article(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
			
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('article/add_article.html.twig', [
            'articleForm' => $form->createView(),
        ]);
    }
	
	/**
     * @Route("/delete_article/{id}", name="app_delete_article")
     */
    public function delete_article(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $article = $entityManager->getRepository(Article::class)->find($id);
		$entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('home');
    }
	
	/**
     * @Route("/edit_article/{id}", name="app_edit_article")
     */
    public function edit_article(Request $request, int $id): Response
    {
        $article = $this->getDoctrine()->getManager()->getRepository(Article::class)->findOneBy(['id' => $id]);
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
			
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('article/add_article.html.twig', [
            'articleForm' => $form->createView(),
        ]);
    }
}
