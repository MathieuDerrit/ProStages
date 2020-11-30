<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStagesController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('pro_stages/index.html.twig', [
            'controller_name' => 'Bienvenue sur la page d\'accueil de Prostages',
        ]);
    }
}
public function entreprises(): Response
{
    return $this->render('pro_stages/entreprises.html.twig', [
        'controller_name' => 'Cette page affichera la liste des entreprises proposant un stage',
    ]);
}
