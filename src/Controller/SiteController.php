<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClientRepository;
use App\Form\SiteType;
use App\Entity\Site;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class SiteController extends AbstractController
{
    /**
     * @Route("/ajout_site", name="ajout_site")
     */
    public function index(Request $request,ClientRepository $client, EntityManagerInterface $manager): Response
    {
        $site = new Site();

        $form = $this->createForm(SiteType::class,$site);
        $form->handleRequest($request);

        if(isset($_POST['ajout'])){ // si formulaire soumis
            $site->setNomSite($_POST['nomsite']);
            $site->setLien($_POST['lien']);
            $site->setDescription($_POST['description']);
            $site->setClient($_POST['client']);
            $site->setPhpVersion($_POST['vphp']);
            //dd($site);
            $manager->persist($site);
            $manager->flush();
        }
        return $this->render('site/index.html.twig', [
            'clients' => $client->findAll(),
            'form' => $form->createView(),
        ]);
    }
}
