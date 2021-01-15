<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;

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
        // Récupérer le repository de l'entité Entreprise
        $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);

        // Récupérer les entreprises enregistrées en BD
        $entreprises = $repositoryEntreprise->findAll();

        return $this->render('pro_stages/entreprises.html.twig', [
            'controller_name' => 'Cette page affichera la liste des entreprises proposant un stage', 'entreprises' => $entreprises,
        ]);
    }
    public function formations(): Response
    {
        // Récupérer le repository de l'entité Formation
        $repositoryFormation = $this->getDoctrine()->getRepository(Formation::class);

        // Récupérer les formations enregistrées en BD
        $formations = $repositoryFormation->findAll();

        return $this->render('pro_stages/formations.html.twig', [
            'controller_name' => 'Cette page affichera la liste des formations de l\'IUT', 'formations' => $formations,
        ]);
    }
    public function stages($id): Response
    {
        // Récupérer le repository de l'entité Stage
        $repositoryStage = $this->getDoctrine()->getRepository(Formation::class);

        // Récupérer le stage enregistrées en BD
        $stage = $repositoryStage->find($id);

        return $this->render('pro_stages/stages.html.twig', [
            'controller_name' => "Cette page affichera le descriptif du stage ayant pour identifiant ".$id, 'stage' => $stage,
    ]);
    }

    /*Page qui affiche l'entrepise correspondant à l'id */
    public function entreprise($id): Response
    {
        // Récupérer le repository de l'entité Entreprise
        $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);

        // Récupérer les entreprises enregistrées en BD
        $entreprise = $repositoryEntreprise->find($id);

        return $this->render('pro_stages/entreprise.html.twig', [
            'entreprise' => $entreprise,
        ]);
    }
}
?>
