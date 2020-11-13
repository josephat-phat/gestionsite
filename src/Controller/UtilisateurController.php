<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Client;
use App\Form\ClientType;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function index(): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    /**
     * @Route("/ajout_client", name="ajout_client")
     */
    public function ajouterClient(Request $request, EntityManagerInterface $manager): Response
    {
        $client = new Client();

        $form = $this->createForm(ClientType::class,$client);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($client);
            $manager->flush();

        }

        return $this->render('utilisateur/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
