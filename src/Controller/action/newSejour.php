<?php

namespace App\Controller\action;

use App\Entity\Lit;
use App\Entity\Sejour;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Patient;


class newSejour extends AbstractController
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
                'disponibilite' => 1,
            ]);

        $patient->setIdlit($lit->getId());

        $lit->setDisponibilite(0);

        $sejour = new Sejour();
        $sejour->setDebutsejour(new \DateTime('now'));
        $sejour->setIdpatient($patient->getId());


        $entityManager->persist($patient);
        $entityManager->persist($lit);
        $entityManager->persist($sejour);

        $entityManager->flush();

        return $this->redirect("/home");

    }

}
