<?php

namespace App\Controller\action;

use App\Entity\Rdv;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class deleteRdv extends AbstractController
{
    public function new(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $rdv = $this->getDoctrine()
            ->getRepository(Rdv::class)
            ->findOneBy([
                'id' => $_GET['id'],
            ]);

        $rdv->setStatus($_GET['action']);

        $entityManager->persist($rdv);

        $entityManager->flush();

        return $this->redirect("/home");

    }

}