<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\stage;
use App\Entity\Entreprise;
use App\Entity\Formation;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /* Création d'un générateur de données à partir de la classe Faker*/
        $faker = \Faker\Factory::create('fr_FR');

        /***************************************
        ***     CREATION DES FORMATIONS      ***
        ****************************************/
        $DUTInfo = new Formation();
        $DUTInfo -> setTitre("DUT Informatique");
        $DUTInfo -> setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));

        $DUTGIM = new Formation();
        $DUTGIM -> setTitre("DUT GIM");
        $DUTGIM -> setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));

        $LPPOO = new Formation();
        $LPPOO -> setTitre("LP Programmation avancée");
        $LPPOO -> setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));

        $LPNum = new Formation();
        $LPNum -> setTitre("LP Numérique");
        $LPNum -> setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));

        $DUTGEA = new Formation();
        $DUTGEA -> setTitre("DUT GEA");
        $DUTGEA -> setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));

        /* On regroupe les objets "formation" dans un tableau
        pour pouvoir s'y référer au moment de la création d'un stage  */
        $tableauFormations = array($DUTInfo, $DUTGIM, $LPPOO, $LPNum, $DUTGEA);

        // Mise en persistance des objets formation
        foreach ($tableauFormations as $formation) {
          $manager->persist($formation);
        }


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

                // Création relation Stage -- Formation
                $nbFormation = $faker->numberBetween($min = 1, $max = 4);
                for($i = 0; $i < $nbFormation; $i++){
                  $numFormation = $faker->numberBetween($min = 0, $max = 4);
                  $stage -> addFormation($tableauFormations[$numFormation]);
                  $tableauFormations[$numFormation] -> addStage($stage);
                }

                // Persister les stages
                $manager->persist($stage);
                // Persister les formations
                $manager->persist($tableauFormations[$numFormation]);
            }
          }

        $manager->flush();
    }
}
