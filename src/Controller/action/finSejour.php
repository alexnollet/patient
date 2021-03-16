<?php

namespace App\Controller\action;

use App\Entity\Lit;
use App\Entity\Sejour;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Patient;


class finSejour extends AbstractController
{
    public function new(Request $request)
    {

        $entityManager = $this->getDoctrine()->getManager();

        $patient = $this->getDoctrine()
            ->getRepository(Patient::class)
            ->findOneBy([
                'id' => $_GET['id'],
            ]);

        $lit = $this->getDoctrine()
            ->getRepository(Lit::class)
            ->findOneBy([
                'id' => $patient->getIdlit(),
            ]);

        $sejour = $this->getDoctrine()
            ->getRepository(Sejour::class)
            ->findOneBy([
                'idpatient' => $_GET['id'],
                'finsejour' => null,
            ]);

        $patient->setIdlit(null);

        $lit->setDisponibilite(1);
        $lit->setIdchambre(null);

        $sejour->setFinsejour(new \DateTime('now'));


        $entityManager->persist($patient);
        $entityManager->persist($lit);
        $entityManager->persist($sejour);

        $entityManager->flush();

        return $this->redirect("/home");

    }

}
