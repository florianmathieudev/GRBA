<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\FileRepository;
use App\Repository\TypeRepository;
use App\Repository\EventRepository;
use App\Repository\HeaderRepository;
use App\Repository\ApproachRepository;
use App\Notification\ContactNotification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(EventRepository $eventRepository, ApproachRepository $approachRepository, TypeRepository $typeRepository)
    {

        
        
        


// dd($eventRepository->findPastEventsMP());
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'events' => $eventRepository->findAll(),
            'findNextEvents' => $eventRepository->findNextEventsMP(),
            'findPastEvents' => $eventRepository->findPastEventsMP(),
            'findOtherEvents' => $eventRepository->findOtherEventsMP(),
            'approachs' => $approachRepository->findAll(),
            'type' => $typeRepository->findAll()
        ]);
    }

    /**
     * @Route("/precedents-evenements", name="allPastEvents")
     *
     */
    public function pastEvents(EventRepository $eventRepository, TypeRepository $typeRepository){
        return $this->render('main/pastEvent.html.twig', [
            'controller_name' => 'MainController',
            'types' => $typeRepository->findPastEventsByType()
        ]);
    }

    /**
     * @Route("/prochaines-randonnees", name="allNextEvents")
     *
     */
    public function nextEvents(EventRepository $eventRepository, TypeRepository $typeRepository){
        return $this->render('main/nextEvent.html.twig', [
            'controller_name' => 'MainController',
            // 'findNextEvents' => $eventRepository->findNextEvents(),
            'types' => $typeRepository->findNextEventsByType()
        ]);
    }

    /**
     * @Route("/autres-evenements", name="allOtherEvents")
     *
     */
    public function otherEvents(EventRepository $eventRepository, TypeRepository $typeRepository){
        return $this->render('main/otherEvent.html.twig', [
            'controller_name' => 'MainController',
            'types' => $typeRepository->findOtherEventsByType()
        ]);
    }

    /**
     * @Route("/evenement/{id}/", name="event_show", methods={"GET"})
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
     * @Route("/contact", name="contact", methods={"GET", "POST"})
     */
    public function contact(ApproachRepository $approachRepository, Request $request, ContactNotification $contactNotification){
        $contact = new Contact();
        $contactForm= $this->createForm(ContactType::class, $contact);
        $contactForm->handleRequest($request);
        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $contactNotification->notify($contact);
            $this->addFlash('success', 'Votre message a bien ete envoye');
            return $this->redirectToRoute('contact');
        };

        return $this->render('main/contact.html.twig', [
            'approachs' => $approachRepository->findAll(),
            'contactForm' => $contactForm->createView()
        ]);
    }
}