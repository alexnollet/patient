<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Rdv;
use App\Entity\Utilisateur;
use App\Entity\Doctor;

class voirRdv extends AbstractController
{
    public function new(Request $request)
    {
        if ($this->get('session')->get('grade') == 'client'){

            $rdv = $this->getDoctrine()
                ->getRepository(Rdv::class)
                ->findBy([
                    'userid' => $this->get('session')->get('id'),
                ]);

            $id = array();
            $nom_doc = array();
            $jour = array();
            $status = array();

            for($i = 0, $size = count($rdv); $i < $size; ++$i) {
                $Doctor = $this->getDoctrine()
                    ->getRepository(Doctor::class)
                    ->findOneBy([
                        'id' => $rdv[$i]->getDocteurid(),
                    ]);

                array_push($id, $rdv[$i]->getId());
                array_push($nom_doc, $Doctor->getNom());
                array_push($jour, $rdv[$i]->getJour());
                array_push($status, $rdv[$i]->getStatus());
            }

            return $this->render('rdv.html.twig', [
                'id' => $id,
                'nom_docteur' => $nom_doc,
                'jour' => $jour,
                'status' => $status,
            ]);
        }
        elseif ($this->get('session')->get('grade') == 'secretaire'){

            $rdv = $this->getDoctrine()
                ->getRepository(Rdv::class)
                ->findAll();

            $id = array();
            $nom = array();
            $nom_doc = array();
            $jour = array();
            $status = array();

            for($i = 0, $size = count($rdv); $i < $size; ++$i) {
                $Doctor = $this->getDoctrine()
                    ->getRepository(Doctor::class)
                    ->findOneBy([
                        'id' => $rdv[$i]->getDocteurid(),
                    ]);

                $User = $this->getDoctrine()
                    ->getRepository(Utilisateur::class)
                    ->findOneBy([
                        'id' => $rdv[$i]->getUserid(),
                    ]);

                array_push($id, $rdv[$i]->getId());
                array_push($nom, $User->getIdentifiant());
                array_push($nom_doc, $Doctor->getNom());
                array_push($jour, $rdv[$i]->getJour());
                array_push($status, $rdv[$i]->getStatus());
            }

            return $this->render('rdvbis.html.twig', [
                'id' => $id,
                'nom' => $nom,
                'nom_docteur' => $nom_doc,
                'jour' => $jour,
                'status' => $status,
            ]);
        }
        else{
            return $this->redirect('/');
        }
    }
}
