<?php

namespace App\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use App\Repository\ContactRepository;
use App\Entity\Header;
use App\Repository\HeaderRepository;
use App\Entity\Footer;
use App\Repository\FooterRepository;

class BackController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(ContactRepository $contactRepository, HeaderRepository $headerRepository, FooterRepository $footerRepository)
    {
        return $this->render('back/index.html.twig', [
            'controller_name' => 'BackController',
            'contacts' => $contactRepository->findAll()
        ]);
    }
}
