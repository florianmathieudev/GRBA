<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;
use App\Repository\EventRepository;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(EventRepository $eventRepository)
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'events' => $eventRepository->findAll(),
        ]);
    }
}
