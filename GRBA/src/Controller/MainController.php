<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EventRepository;
use App\Repository\ContactRepository;
use App\Repository\TypeRepository;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(EventRepository $eventRepository, ContactRepository $contactRepository, TypeRepository $typeRepository)
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'events' => $eventRepository->findAll(),
            'findNextEvents' => $eventRepository->findNextEventsMP(),
            'findPastEvents' => $eventRepository->findPastEventsMP(),
            'findOtherEvents' => $eventRepository->findOtherEventsMP(),
            'contacts' => $contactRepository->findAll(),
            'type' => $typeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/precedents-evenements", name="allPastEvents")
     *
     */
    public function pastEvents(EventRepository $eventRepository){
        return $this->render('main/pastEvent.html.twig', [
            'controller_name' => 'MainController',
            'events' => $eventRepository->findAll(),
            'findPastEvents' => $eventRepository->findPastEvents(),
            'findPrevious'
        ]);
    }

    /**
     * @Route("/prochaines-randonnees", name="allNextEvents")
     *
     */
    public function nextEvents(EventRepository $eventRepository){
        return $this->render('main/nextEvent.html.twig', [
            'controller_name' => 'MainController',
            'events' => $eventRepository->findAll(),
            'findNextEvents' => $eventRepository->findNextEvents(),
        ]);
    }

    // /**
    //  * @Route("/autres-evenements", name="allOtherEvents")
    //  *
    //  */
    // public function otherEvents(EventRepository $eventRepository){
    //     return $this->render('main/otherEvent.html.twig', [
    //         'controller_name' => 'MainController',
    //         'events' => $eventRepository->findAll(),
    //         'findOtherEvents' => $eventRepository->findOtherEvents(),
    //     ]);
    // }
}