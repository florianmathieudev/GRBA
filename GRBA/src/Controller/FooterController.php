<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\FooterRepository;
use App\Repository\ContactRepository;
use App\Repository\NetworkRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FooterController extends AbstractController
{

    public function index(NetworkRepository $networkRepository, ContactRepository $contactRepository, FooterRepository $footerRepository)
    {
        return $this->render('/_footer.html.twig', [
            'controller_name' => 'MainController',
            'contacts' => $contactRepository->findAll(),
            'footers' =>  $footerRepository->findAll(),
            'networks' => $networkRepository->findAll()
        ]);
    }
}