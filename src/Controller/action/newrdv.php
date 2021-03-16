<?php

namespace App\Controller\action;

use App\Entity\Rdv;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class newrdv extends AbstractController
{
    public function new(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $rdv = new Rdv();
        $rdv->setUserid($this->get('session')->get('id'));
        $rdv->setDocteurid($_GET['id']);
        $rdv->setJour($_GET['jour']);
        $rdv->setStatus("Demandé");

        $entityManager->persist($rdv);

        $entityManager->flush();

        return $this->redirect("/home");

    }

}
