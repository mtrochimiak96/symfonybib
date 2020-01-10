<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

class HomeController extends AbstractController
{
	/**
     * @Route("/", name="home")
     */
	public function index()
	{
		
		$articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
		
		return $this ->render('home.html.twig', [
			'title' => "Bibliometr",
			"articles" => $articles
		]);
	}
}