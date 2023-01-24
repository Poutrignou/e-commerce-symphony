<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/inscription', name:'app_register')]
//1 objet Request; l objet Request doit etre mis dans $request
function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
    $user = new User();
    $form = $this->createForm(RegisterType::class, $user);

    //form peut ecouter la requete.
    $form->handleRequest($request);
    //si le form est submit et est valid :
    if ($form->isSubmitted() && $form->isValid()) {
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);

        $user->setPassword($password);

        $user = $form->getData();
        $this->entityManager->persist($user);

        $this->entityManager->flush();

    }
    return $this->render('register/index.html.twig', [
        'form' => $form->createView(),
    ]);
}
}