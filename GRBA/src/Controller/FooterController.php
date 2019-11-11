<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use App\Repository\ContactRepository;

class FooterController extends AbstractController
{

    public function index(ContactRepository $contactRepository)
    {
        return $this->render('/_footer.html.twig', [
            'controller_name' => 'MainController',
            'contacts' => $contactRepository->findAll(),
        ]);
    }
}
