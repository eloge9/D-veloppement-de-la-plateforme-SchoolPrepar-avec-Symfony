<?php

namespace App\DataFixtures;

use App\Entity\Etablissement;
use App\Entity\Filiere;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Créer des établissements
        $etablissement1 = new Etablissement();
        $etablissement1->setNom('Université Paris-Saclay');
        $etablissement1->setAdresse('15 Rue Georges Clemenceau');
        $etablissement1->setVille('Paris');
        $etablissement1->setContact('01 23 45 67 89');
        $etablissement1->setSiteWeb('https://www.universite-paris-saclay.fr');
        $manager->persist($etablissement1);

        $etablissement2 = new Etablissement();
        $etablissement2->setNom('École Polytechnique');
        $etablissement2->setAdresse('Route de Saclay');
        $etablissement2->setVille('Palaiseau');
        $etablissement2->setContact('01 69 33 30 00');
        $etablissement2->setSiteWeb('https://www.polytechnique.edu');
        $manager->persist($etablissement2);

        $etablissement3 = new Etablissement();
        $etablissement3->setNom('CentraleSupélec');
        $etablissement3->setAdresse('3 Rue Joliot-Curie');
        $etablissement3->setVille('Gif-sur-Yvette');
        $etablissement3->setContact('01 69 85 10 00');
        $etablissement3->setSiteWeb('https://www.centralesupelec.fr');
        $manager->persist($etablissement3);

        // Créer des filières
        $filiere1 = new Filiere();
        $filiere1->setNom('Informatique');
        $filiere1->setDescription('Formation complète en développement logiciel, intelligence artificielle et cybersécurité.');
        $filiere1->setDomaine('Sciences et Technologies');
        $filiere1->setConditionAdmission('Bac Scientifique avec spécialité Mathématiques et NSI recommandée. Concours sur dossier et entretien.');
        $filiere1->setDebouches('Développeur logiciel, ingénieur IA, expert cybersécurité, data scientist.');
        $filiere1->setEtablissement($etablissement1);
        $manager->persist($filiere1);

        $filiere2 = new Filiere();
        $filiere2->setNom('Génie Industriel');
        $filiere2->setDescription('Optimisation des processus industriels, management de la production et logistique.');
        $filiere2->setDomaine('Ingénierie');
        $filiere2->setConditionAdmission('Bac Scientifique ou STI2D. Excellentes compétences en mathématiques et physique.');
        $filiere2->setDebouches('Ingénieur production, consultant logistique, manager qualité, chef de projet industriel.');
        $filiere2->setEtablissement($etablissement2);
        $manager->persist($filiere2);

        $filiere3 = new Filiere();
        $filiere3->setNom('Sciences Économiques');
        $filiere3->setDescription('Analyse économique, finance, gestion d\'entreprise et politiques publiques.');
        $filiere3->setDomaine('Économie et Gestion');
        $filiere3->setConditionAdmission('Bac Économique et Social ou Scientifique. Bon niveau en mathématiques.');
        $filiere3->setDebouches('Analyste financier, consultant, banquier, économiste, gestionnaire de patrimoine.');
        $filiere3->setEtablissement($etablissement3);
        $manager->persist($filiere3);

        $filiere4 = new Filiere();
        $filiere4->setNom('Biotechnologies');
        $filiere4->setDescription('Recherche biomédicale, ingénierie tissulaire et technologies de santé.');
        $filiere4->setDomaine('Sciences de la Vie');
        $filiere4->setConditionAdmission('Bac Scientifique avec spécialité SVT. Très bon niveau en sciences expérimentales.');
        $filiere4->setDebouches('Chercheur biomédical, ingénieur biotech, responsable R&D, technicien de laboratoire.');
        $filiere4->setEtablissement($etablissement1);
        $manager->persist($filiere4);

        $filiere5 = new Filiere();
        $filiere5->setNom('Énergies Renouvelables');
        $filiere5->setDescription('Énergie solaire, éolienne, hydroélectrique et solutions durables.');
        $filiere5->setDomaine('Énergie et Environnement');
        $filiere5->setConditionAdmission('Bac Scientifique ou STI2D. Intérêt pour les technologies vertes.');
        $filiere5->setDebouches('Ingénieur énergie, consultant environnemental, technicien solaire, expert éolien.');
        $filiere5->setEtablissement($etablissement2);
        $manager->persist($filiere5);

        $filiere6 = new Filiere();
        $filiere6->setNom('Design et Innovation');
        $filiere6->setDescription('Design industriel, UX/UI design, création et innovation technologique.');
        $filiere6->setDomaine('Arts et Design');
        $filiere6->setConditionAdmission('Tous baccalauréats. Portfolio créatif et entretien. Sensibilité artistique et technique.');
        $filiere6->setDebouches('Designer industriel, UX designer, directeur artistique, innovateur technologique.');
        $filiere6->setEtablissement($etablissement3);
        $manager->persist($filiere6);

        $manager->flush();
    }
}
