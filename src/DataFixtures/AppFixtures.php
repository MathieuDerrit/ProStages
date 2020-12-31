<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\stage;
use App\Entity\Entreprise;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /* Création d'un générateur de données à partir de la classe Faker*/
        $faker = \Faker\Factory::create('fr_FR');

        /***************************************
        ***     CREATION DES ENTREPRISES     ***
        ****************************************/
        $entreprisesProStages = array(
         "Price Induction" => "Aéronautique",
         "Microsoft" => "Informatique",
         "Apple" => "Informatique",
         "DesignWeb" => "Développement web",
         "MobileTech" => "Développement mobile",
         "OriginalSite" => "Développement web",
         "SecurityPc" => "Cybersécurité",
         "LogiDev" => "Développement logiciel",
         );

         foreach ($entreprisesProStages as $nomEntreprise => $activiteEntreprise) {
            // ************* Création d'une nouvelle entreprise *************
            $entreprise = new Entreprise();
            // Nom de l'entreprise
            $entreprise->setNom($nomEntreprise);
            // Activite de l'entreprise
            $entreprise->setActivite($activiteEntreprise);
            // Adressee de l'entreprise
            $entreprise->setAdresse($faker->address);
            // Enregistrement de l'entreprise créé
            $manager->persist($entreprise);

            /***************************************
            ***        CREATION DES STAGES       ***
            ****************************************/
            // **** Création de plusieurs stages associées aux entreprises
            $nbStagesAGenerer = $faker->numberBetween($min = 0, $max = 5);
            for ($numStage=0; $numStage < $nbStagesAGenerer; $numStage++) {
                $stage = new Stage();
                $stage -> setTitre($faker->sentence($nbWords = 10, $variableNbWords = true));
                $stage -> setDomaine($faker->realText($maxNbChars = 25, $indexSize = 2));
                $stage -> setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));
                $stage -> setEmail($faker->email);
                $stage -> setEntreprise($entreprise);
                // Création relation Stage -- Entreprise
                $entreprise -> addStage($stage);

                // Persister les stages
                $manager->persist($stage);
            }
          }

        $manager->flush();
    }
}
