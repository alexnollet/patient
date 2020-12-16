<?php

namespace App\Controller;

use App\Form\UpdatePatient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Patient;


class modifPatient extends AbstractController
{
    public function new(Request $request)
    {

        $patients = $this->getDoctrine()
            ->getRepository(Patient::class)
            ->findOneBy([
                'id' => $_GET['id'],
            ]);

        $nompatient = $patients->getNom();
        $prenompatient = $patients->getPrenom();
        $telpatient = $patients->getTelpatient();
        $adressepatient = $patients->getAdressepatient();


        $form = $this->createForm(UpdatePatient::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            if ($task["nom"] != null){
                $patients->setNom($task["nom"]);
            }
            if ($task["prenom"] != null){
                $patients->setPrenom($task["prenom"]);
            }
            if ($task["num"] != null){
                $patients->setTelpatient($task["num"]);
            }
            if ($task["adresse"] != null){
                $patients->setAdressepatient($task["adresse"]);
            }

            $entityManager->persist($patients);

            $entityManager->flush();

            return $this->redirect("/");

        }

        return $this->render('modifpatient.html.twig', [
            'nompatient' => $nompatient,
            'prenompatient' => $prenompatient,
            'telpatient' => $telpatient,
            'adressepatient' => $adressepatient,
            'form' => $form->createView(),
        ]);

    }

}

