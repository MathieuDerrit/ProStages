<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;

class ProStagesController extends AbstractController
{
    public function index(): Response
    {
        // Récupérer le repository de l'entité Stage
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        // Récupérer les stages enregistrées en BD
        $stages = $repositoryStage->findAll();

        // Envoyer un texte dans la variable controller_name et dans la variable stages les stages récupérées à la vue chargée de les afficher
        return $this->render('pro_stages/index.html.twig', [
          'controller_name' => 'Bienvenue sur la page d\'accueil de Prostages','stages' => $stages,
        ]);
    }
    public function entreprises(): Response
    {
        return $this->render('pro_stages/entreprises.html.twig', [
            'controller_name' => 'Cette page affichera la liste des entreprises proposant un stage',
        ]);
    }
    public function formations(): Response
    {
        return $this->render('pro_stages/formations.html.twig', [
            'controller_name' => 'Cette page affichera la liste des formations de l\'IUT',
        ]);
    }
    public function stages($id): Response
    {
        return $this->render('pro_stages/stages.html.twig', [
            'controller_name' => "Cette page affichera le descriptif du stage ayant pour identifiant ".$id,
    ]);
    }
}
?>
