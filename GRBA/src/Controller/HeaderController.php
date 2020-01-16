<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HeaderRepository;

class HeaderController extends AbstractController
{

    public function index(HeaderRepository $headerRepository)
    {
        $variables['url'] = $_SERVER['REQUEST_URI'];
        $variables['#cache']['contexts'][] = 'url.path';
        return $this->render('/_header.html.twig', [
            'controller_name' => 'HeaderController',
            'header' => $headerRepository->findOneById(3),
            'backHeader' => $headerRepository->findOneById(4),
            'url' => $variables
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
