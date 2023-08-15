<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher): Response
    {
        $client = new Client();
        $form = $this->createForm(RegisterType::class, $client);

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $client = $form->getData();

            $password = $hasher->hashPassword($client, $client->getPassword());
            $client->setPassword($password);

            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('inscription/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
