<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\User;
use App\Form\RegistrationFormType;

class UserController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
		
		$users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
			'users' => $users
        ]);
    }
	
	/**
     * @Route("/delete_user/{id}", name="app_delete_user")
     */
    public function delete_user(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
		$entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('home');
    }
	
	/**
     * @Route("/edit_user/{id}", name="app_edit_user")
     */
    public function edit_user(Request $request, int $id): Response
    {
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->findOneBy(['id' => $id]);
        $form = $this->createForm(RegistrationFormType::class, $user, [
			'edit' => true,
			'role' => $user->getRole(),
		]);
		
		$pass = $user->getPassword();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
			if($pass !== $user->getPassword()) {
				$user->setPassword(
					$passwordEncoder->encodePassword(
						$user,
						$form->get('plainPassword')->getData()
					)
				);
			}
			
			$user->setRole($user->getRole());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('admin');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
