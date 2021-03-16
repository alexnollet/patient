<?php

namespace App\Controller;

use App\Form\AddPatient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Chambre;
use App\Entity\Services;
use App\Entity\Lit;
use App\Entity\Patient;
use App\Entity\Sejour;


class home extends AbstractController
{
    public function new(Request $request)
    {

        if ($this->get('session')->get('grade') == 'secretaire'){
            $services = $this->getDoctrine()
                ->getRepository(Services::class)
                ->findAll();

            $nomservice = array();
            $nbschambre = array();
            $nbslitdispo = array();

            for($i = 0; $i < count($services); ++$i) {
                array_push($nomservice, $services[$i]->getNomservice());

                $chambres = $this->getDoctrine()
                    ->getRepository(Chambre::class)
                    ->findBy(
                        ['idservice' => $services[$i]->getId()]
                    );

                $nbchambre = 0;
                $nblitdispo = 0;

                for($a = 0, $size = count($chambres); $a < $size; ++$a) {
                    $nbchambre += $chambres[$a]->getNblit();

                    $lits = $this->getDoctrine()
                        ->getRepository(Lit::class)
                        ->findBy([
                            'idchambre' => $chambres[$a]->getId(),
                            'disponibilite' => 0,
                        ]);

                    $nblitdispo += count($lits);
                }

                array_push($nbslitdispo, $nbchambre-$nblitdispo);
                array_push($nbschambre, $nbchambre);

            }

            $patients = $this->getDoctrine()
                ->getRepository(Patient::class)
                ->findAll();

            $idspatient = array();
            $nompatient = array();
            $prenompatient = array();
            $telpatient = array();
            $adressepatient = array();
            $servicepatient = array();
            $sejourpatient = array();

            for($i = 0, $size = count($patients); $i < $size; ++$i) {
                array_push($idspatient, $patients[$i]->getId());
                array_push($nompatient, $patients[$i]->getNom());
                array_push($prenompatient, $patients[$i]->getPrenom());
                array_push($telpatient, $patients[$i]->getTelpatient());
                array_push($adressepatient, $patients[$i]->getAdressepatient());

                if ($patients[$i]->getIdlit() != null){
                    $lit = $this->getDoctrine()
                        ->getRepository(Lit::class)
                        ->findBy([
                            'id' => $patients[$i]->getIdlit(),
                        ]);

                    if ($lit[0]->getIdchambre() != null){

                        $chambre = $this->getDoctrine()
                            ->getRepository(Chambre::class)
                            ->findBy(
                                ['id' => $lit[0]->getIdchambre()]
                            );

                        $service = $this->getDoctrine()
                            ->getRepository(Services::class)
                            ->findBy(
                                ['id' => $chambre[0]->getIdservice()]
                            );

                        array_push($servicepatient, $service[0]->getNomservice());
                    }
                    else{
                        array_push($servicepatient, 'pas attribué');
                    }
                }
                else{
                    array_push($servicepatient, 'pas attribué');
                }

                $sejour = $this->getDoctrine()
                    ->getRepository(Sejour::class)
                    ->findBy([
                        'idpatient' => $patients[$i]->getId(),
                    ],
                        ['id' => 'DESC']
                    );

                if ($sejour[0]->getFinsejour() == null){
                    array_push($sejourpatient, date_format($sejour[0]->getDebutsejour(), 'd/m/Y'));
                }
                else{
                    array_push($sejourpatient, 'pas de séjour en cours');
                }
            }

            $form = $this->createForm(AddPatient::class);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $task = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();

                $patient = new Patient();
                $patient->setNom($task["nom"]);
                $patient->setPrenom($task["prenom"]);
                $patient->setTelpatient($task["num"]);
                $patient->setAdressepatient($task["adresse"]);

                $lit = $this->getDoctrine()
                    ->getRepository(Lit::class)
                    ->findOneBy([
                        'disponibilite' => 1,
                    ]);

                $patient->setIdlit($lit->getId());
                $lit->setDisponibilite(0);

                $entityManager->persist($patient);

                $entityManager->flush();

                $newsejour = new Sejour();
                $newsejour->setIdpatient($patient->getId());
                $newsejour->setDebutsejour(new \DateTime('now'));

                $entityManager->persist($newsejour);

                $entityManager->flush();

                return $this->redirect($request->getUri());

            }

            return $this->render('index.html.twig', [
                'nomservice' => $nomservice,
                'nbchambre' => $nbschambre,
                'nblitdispo' => $nbslitdispo,
                'idpatient' => $idspatient,
                'nompatient' => $nompatient,
                'prenompatient' => $prenompatient,
                'telpatient' => $telpatient,
                'adressepatient' => $adressepatient,
                'servicepatient' => $servicepatient,
                'sejourpatient' => $sejourpatient,
                'form' => $form->createView(),
            ]);
        }
        elseif ($this->get('session')->get('grade') == 'client'){
            return $this->render('client.html.twig', []);
        }
        else{
            return $this->redirect('/');
        }
    }
}
