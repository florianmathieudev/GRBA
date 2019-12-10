<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\TypeRepository;
use App\Repository\EventRepository;
use App\Repository\ContactRepository;
use App\Repository\PictureRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    /**
     * @Route("/evenement/{id}", name="event_show", methods={"GET"})
     */
    public function show(Event $event): Response
    {
        return $this->render('main/currentEvent.html.twig', [
            'event' => $event,
            'pictures' => $event->getPictures(),
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