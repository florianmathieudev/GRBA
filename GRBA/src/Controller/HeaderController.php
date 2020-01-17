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
            'header' => $headerRepository->findOneById(5),
            
        ]);
    } public function indexMain(HeaderRepository $headerRepository)
    {
        
        return $this->render('/_headerMain.html.twig', [
            'controller_name' => 'HeaderController',
            'header' => $headerRepository->findOneById(3),
        ]);
    } public function indexBack(HeaderRepository $headerRepository)
    {
       
        return $this->render('/_headerBack.html.twig', [
            'controller_name' => 'HeaderController',
            'backHeader' => $headerRepository->findOneById(4),
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
