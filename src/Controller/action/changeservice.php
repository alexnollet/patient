<?php

namespace App\Controller\action;

use App\Entity\Chambre;
use App\Entity\Lit;
use App\Entity\Services;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Patient;


class changeservice extends AbstractController
{
    public function new(Request $request)
    {

        $patients = $this->getDoctrine()
            ->getRepository(Patient::class)
            ->findOneBy([
                'id' => $_GET['id'],
            ]);

        $litpatient = $patients->getIdlit();

        $service = $this->getDoctrine()
            ->getRepository(Services::class)
            ->findOneBy([
                'id' => $_GET['idservice'],
            ]);

        $chambres = $this->getDoctrine()
            ->getRepository(Chambre::class)
            ->findBy([
                'idservice' => $service->getId(),
            ]);

        $nblitmax = 0;
        $nblit = 0;

        for($a = 0, $size = count($chambres); $a < $size; ++$a) {
            $nblitmax += $chambres[$a]->getNblit();

            $lits = $this->getDoctrine()
                ->getRepository(Lit::class)
                ->findBy([
                    'idchambre' => $chambres[$a]->getId(),
                    'disponibilite' => 0,
                ]);

            $nblit += count($lits);

            if ($nblitmax > $nblit){

                $lit = $this->getDoctrine()
                    ->getRepository(Lit::class)
                    ->findOneBy([
                        'id' => $litpatient,
                    ]);

                $entityManager = $this->getDoctrine()->getManager();

                $lit->setIdchambre($chambres[$a]->getId());

                $entityManager->persist($lit);

                $entityManager->flush();

                break;
            }

        }

        return $this->redirect("/home");

    }

}
