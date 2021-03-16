<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Doctor;


class voirdoc extends AbstractController
{
    public function new(Request $request)
    {
        if ($this->get('session')->get('grade') == 'client'){

            $Doctor = $this->getDoctrine()
                ->getRepository(Doctor::class)
                ->findAll();

            $id = array();
            $nom = array();
            $lundi = array();
            $mardi = array();
            $mercredi = array();
            $jeudi = array();
            $vendredi = array();
            $samedi = array();
            $dimanche = array();

            for($i = 0, $size = count($Doctor); $i < $size; ++$i) {
                array_push($id, $Doctor[$i]->getId());
                array_push($nom, $Doctor[$i]->getNom());
                array_push($lundi, $Doctor[$i]->getLundi());
                array_push($mardi, $Doctor[$i]->getMardi());
                array_push($mercredi, $Doctor[$i]->getMercredi());
                array_push($jeudi, $Doctor[$i]->getJeudi());
                array_push($vendredi, $Doctor[$i]->getVendredi());
                array_push($samedi, $Doctor[$i]->getSamedi());
                array_push($dimanche, $Doctor[$i]->getDimanche());
            }

            return $this->render('doctor.html.twig', [
                'id' => $id,
                'nom' => $nom,
                'lundi' => $lundi,
                'mardi' => $mardi,
                'mercredi' => $mercredi,
                'jeudi' => $jeudi,
                'vendredi' => $vendredi,
                'samedi' => $samedi,
                'dimanche' => $dimanche,
            ]);
        }
        else{
            return $this->redirect('/');
        }
    }
}
