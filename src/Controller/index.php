<?php


namespace App\Controller;


use App\Entity\Utilisateur;
use App\Form\Connect;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;

class index extends AbstractController
{
    public function new(Request $request)
    {
        $form = $this->createForm(Connect::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $User = $this->getDoctrine()
                ->getRepository(Utilisateur::class)
                ->findOneBy([
                    'identifiant' => $task['identifiant'],
                ]);

            $hashed_password = $User->getPassword();

            if(password_verify($task['mot_de_passe'], $hashed_password)) {
                $this->get('session')->set('grade', $User->getGrade());
                $this->get('session')->set('id', $User->getId());
                return $this->redirect('/home');
            }
            else{
                return $this->render('connect.html.twig', [
                    'form' => $form->createView(),
                    'fail' => 'Identifiant ou mot de passe invalide',
                ]);
            }

        }

        return $this->render('connect.html.twig', [
            'form' => $form->createView(),
            'fail' => '',
        ]);
    }
}