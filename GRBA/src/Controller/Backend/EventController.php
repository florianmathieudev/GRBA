<?php

namespace App\Controller\Backend;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use App\Repository\TypeRepository;
use App\Entity\Type;
use App\Form\TypeType;
use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/event")
 */
class EventController extends AbstractController
{
    /**
     * @Route("/", name="event_index", methods={"GET","POST"})
     */
    public function index(EventRepository $eventRepository, Request $request, TypeRepository $typeRepository): Response
    {
        $event = new Event();
        $eventForm = $this->createForm(EventType::class, $event);
        $eventForm->handleRequest($request);
        if ($eventForm->isSubmitted() && $eventForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
            return $this->redirectToRoute('event_index');
        };

        $type = new Type();
        $typeform = $this->createForm(TypeType::class, $type);
        $typeform->handleRequest($request);
        if ($typeform->isSubmitted() && $typeform->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($type);
            $entityManager->flush();
            return $this->redirectToRoute('event_index');
        }
        return $this->render('back/event/index.html.twig', [
            'events' => $eventRepository->findAll(),
            'types' => $typeRepository->findAll(),
            'event' => $event,
            'typeForm' => $typeform->createView(),            
            'eventForm' => $eventForm->createView(),
            'pictures' => $event->getPictures(),
        ]);
    }

    /**
     * @Route("/new", name="event_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $event = new Event();
        $eventForm = $this->createForm(EventType::class, $event);
        $eventForm->handleRequest($request);

        if ($eventForm->isSubmitted() && $eventForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('event_index');
        }

        return $this->render('back/event/new.html.twig', [
            'event' => $event,
            'eventForm' => $eventForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_show", methods={"GET"})
     */
    public function show(Event $event, PictureRepository $pictureRepository): Response
    {
        return $this->render('back/event/show.html.twig', [
            'event' => $event,
            'pictures' => $event->getPictures(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="event_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Event $event): Response
    {
        $eventForm = $this->createForm(EventType::class, $event);
        $eventForm->handleRequest($request);
        if ($eventForm->isSubmitted() && $eventForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('event_index');
        }
        return $this->render('back/event/edit.html.twig', [
            'event' => $event,
            'eventForm' => $eventForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Event $event): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('event_index');
    }
}
