<?php

namespace App\Controller\Backend;

use App\Entity\Event;
use App\Entity\Picture;
use App\Form\EventType;
use App\Repository\EventRepository;
use App\Repository\PictureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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
    public function index(EventRepository $eventRepository, Request $request): Response
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
        return $this->render('back/event/index.html.twig', [
            'events' => $eventRepository->findAll(),
            'event' => $event,        
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
     * @Route("/{id}", name="event_show_back", methods={"GET"})
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
    public function edit(Request $request, Event $event, Picture $picture, EntityManagerInterface $em): Response
    {
        //création du formulaire
        $eventForm = $this->createForm(EventType::class, $event);
        $eventForm->handleRequest($request);
        if ($eventForm->isSubmitted() && $eventForm->isValid()) {
            // dd($eventForm);
            // parcours $picturefiles
            // dump($eventForm->get('picturefiles')->getData());
            // dd($event->picturefiles);
        // si pas d'image envoyé, on garde les images précédentes
            $image = $eventForm->get('picturefiles')->getData();
            // dd($image);
                //on parcours le tableau $image, pour chaque on transforme son nom
            foreach($image as $i)
            {
                if ($i) {
                $originalImagename = pathinfo($i->getClientOriginalName(), PATHINFO_FILENAME);
                $safeImagename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalImagename);
                $newImagename = $safeImagename.'-'.uniqid().'.'.$i->guessExtension();
                //on déplace le fichier dans le bon dossier
                    try {
                        $i->move(
                        $this->getParameter('upload_picture_type_directory'), $newImagename
                        );
                        //
                // dd($event->picturefiles);
                        //creation d'une nouvelle image avec toutes ses données
                        $picture = new Picture;
                        $picture->setPath("/image/".$newImagename);
                        $picture->setName($newImagename);
                        $picture->setEvent($event);
                        // dd($picture);
                        //on enregistre le nom dans event
                        $event->addPicture($picture);
                        $em->persist($picture);
                
                        } catch (FileException $e) {
                
                        }
                }
            }
                
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
