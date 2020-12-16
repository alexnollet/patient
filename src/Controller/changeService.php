<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Entity\Lit;
use App\Entity\Services;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Patient;


class changeService extends AbstractController
{
    public function new(Request $request)
    {

        $patients = $this->getDoctrine()
            ->getRepository(Patient::class)
            ->findOneBy([
                'id' => $_GET['id'],
            ]);

        $idpatient = $patients->getId();
        $nompatient = $patients->getNom();
        $prenompatient = $patients->getPrenom();
        $telpatient = $patients->getTelpatient();
        $adressepatient = $patients->getAdressepatient();

        $lit = $this->getDoctrine()
            ->getRepository(Lit::class)
            ->findoneBy([
                'id' => $patients->getIdlit(),
            ]);

        if ($lit->getIdchambre() != null){

            $chambre = $this->getDoctrine()
                ->getRepository(Chambre::class)
                ->findOneBy(
                    ['id' => $lit->getIdchambre()]
                );

            $service = $this->getDoctrine()
                ->getRepository(Services::class)
                ->findOneBy(
                    ['id' => $chambre->getIdservice()]
                );

            $servicepatient = $service->getNomservice();
        }
        else{
            $servicepatient = 'pas attribué';
        }




        $services = $this->getDoctrine()
            ->getRepository(Services::class)
            ->findAll();

        $nomservice = array();
        $idservices = array();

        for($i = 0; $i < count($services); ++$i) {

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

            if ($nbchambre-$nblitdispo != 0 and $services[$i]->getNomservice() != $servicepatient){
                array_push($nomservice, $services[$i]->getNomservice());
                array_push($idservices, $services[$i]->getId());
            }

        }


        return $this->render('changeservice.html.twig', [
            'nompatient' => $nompatient,
            'prenompatient' => $prenompatient,
            'telpatient' => $telpatient,
            'adressepatient' => $adressepatient,
            'servicepatient' => $servicepatient,
            'services' => $nomservice,
            'idservices' => $idservices,
            'idpatient' => $idpatient,
        ]);

    }

}


