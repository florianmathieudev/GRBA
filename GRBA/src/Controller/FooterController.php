<?php

namespace App\Controller;

use App\Entity\Approach;
use App\Repository\FooterRepository;
use App\Repository\ApproachRepository;
use App\Repository\NetworkRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FooterController extends AbstractController
{

    public function index(NetworkRepository $networkRepository, ApproachRepository $approachRepository, FooterRepository $footerRepository)
    {
        return $this->render('/_footer.html.twig', [
            'controller_name' => 'MainController',
            'approachs' => $approachRepository->findAll(),
            'footers' =>  $footerRepository->findAll(),
            'networks' => $networkRepository->findAll()
        ]);
    }
}