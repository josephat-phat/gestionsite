<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SiteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(SiteRepository $site, PaginatorInterface $paginator,Request $request): Response
    {
        $pagination = $paginator->paginate(
            $site->findAll(),
            $request->query->getInt('page',1),
            15
        );
        return $this->render('accueil/index.html.twig', [
            'sites' => $pagination,
        ]);
    }
}
