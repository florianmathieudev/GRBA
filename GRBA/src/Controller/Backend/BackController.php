<?php

namespace App\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContactRepository;
use App\Repository\TypeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Event;
use App\Form\EventType;

class BackController extends AbstractController
{
    /**
     * @Route("/admin", name="admin", methods={"GET","POST"})
     */
    public function index(Request $request, ContactRepository $contactRepository, TypeRepository $typeRepository): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
            return $this->redirectToRoute('admin');
        }
        return $this->render('back/index.html.twig', [
            'controller_name' => 'BackController',
            'types' => $typeRepository->findAll(),
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }
}
