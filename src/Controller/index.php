<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Chambre;
use App\Entity\Services;
use App\Entity\Lit;


class index extends AbstractController
{
    public function main(): Response
    {
        $services = $this->getDoctrine()
            ->getRepository(Services::class)
            ->findAll();

        $nomservice = array();
        $nbschambre = array();
        $nbslitdispo = array();

        for($i = 0, $size = count($services); $i < $size; ++$i) {
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

        return $this->render('index.html.twig', [
            'nomservice' => $nomservice,
            'nbchambre' => $nbschambre,
            'nblitdispo' => $nbslitdispo,
        ]);

    }

}
