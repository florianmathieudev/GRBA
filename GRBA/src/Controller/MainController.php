<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\FileRepository;
use App\Repository\TypeRepository;
use App\Repository\EventRepository;
use App\Repository\ContactRepository;
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
     * @Route("/autres-evenements", name="allOtherEvents")
     *
     */
    public function otherEvents(EventRepository $eventRepository){
        return $this->render('main/nextEvent.html.twig', [
            'controller_name' => 'MainController',
            'events' => $eventRepository->findAll(),
            'findNextEvents' => $eventRepository->findOtherEvents(),
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

    /**
     * @Route("/mentions-legales", name="legalNotice", methods={"GET"})
     */
    public function legalNotice(){
        return $this->render('main/legalNotice.html.twig', [
        ]);
    }    
    
    /**
     * @Route("/fichiers", name="file", methods={"GET"})
     */
    public function download(FileRepository $fileRepository){
        return $this->render('main/download.html.twig', [
            'files' => $fileRepository->findAll(),
        ]);
    }

    /**
     * @Route("/contact", name="contact", methods={"GET"})
     */
    public function contact(ContactRepository $contactRepository){
        return $this->render('main/contact.html.twig', [
            'contacts' => $contactRepository->findAll(),
        ]);
    }
}