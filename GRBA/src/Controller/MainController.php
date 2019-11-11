<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;
use App\Repository\EventRepository;
use App\Entity\Contact;
use App\Repository\ContactRepository;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(EventRepository $eventRepository, ContactRepository $contactRepository)
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'events' => $eventRepository->findAll(),
            'contacts' => $contactRepository->findAll(),
        ]);
    }
}
