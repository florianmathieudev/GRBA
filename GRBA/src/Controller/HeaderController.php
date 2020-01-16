<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HeaderRepository;

class HeaderController extends AbstractController
{

    public function index(HeaderRepository $headerRepository)
    {
        return $this->render('/_header.html.twig', [
            'controller_name' => 'HeaderController',
            'headers' => $headerRepository->findOneById(3)
        ]);
    }

    public function back(HeaderRepository $headerRepository)
    {
        return $this->render('/back_base.html.twig', [
            'controller_name' => 'HeaderController',
            'headers' => $headerRepository->findById(3)
        ]);
    }
}
