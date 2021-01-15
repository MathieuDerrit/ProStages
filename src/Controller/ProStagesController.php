<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Repository\StageRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\FormationRepository;

class ProStagesController extends AbstractController
{
    public function index(StageRepository $repositoryStage): Response
    {
        // Récupérer les stages enregistrées en BD
        $stages = $repositoryStage->findAll();

        // Envoyer les les stages récupérées à la vue chargée de les afficher
        return $this->render('pro_stages/index.html.twig', [
          'stages' => $stages,
        ]);
    }
    public function entreprises(EntrepriseRepository $repositoryEntreprise): Response
    {
        // Récupérer les entreprises enregistrées en BD
        $entreprises = $repositoryEntreprise->findAll();
        // Envoyer les entreprises récupérées à la vue chargée de les afficher
        return $this->render('pro_stages/entreprises.html.twig', [
            'entreprises' => $entreprises,
        ]);
    }
    public function formations(FormationRepository $repositoryFormation): Response
    {
        // Récupérer les formations enregistrées en BD
        $formations = $repositoryFormation->findAll();
        // Envoyer les formations récupérées à la vue chargée de les afficher
        return $this->render('pro_stages/formations.html.twig', [
            'formations' => $formations,
        ]);
    }
    public function formation(Formation $formation): Response
    {
        return $this->render('pro_stages/formation.html.twig', [
            'formation' => $formation,
        ]);
    }
    /*Page qui affiche le stage correspondant à $stage */
    public function stages(Stage $stage): Response
    {
        return $this->render('pro_stages/stages.html.twig', [
            'stage' => $stage,
    ]);
    }
    /*Page qui affiche l'entrepise correspondant à $entreprise */
    public function entreprise(Entreprise $entreprise): Response
    {
        return $this->render('pro_stages/entreprise.html.twig', [
            'entreprise' => $entreprise,
        ]);
    }
}
?>
