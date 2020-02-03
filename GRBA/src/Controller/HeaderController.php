<?php

namespace App\Controller;

use App\Entity\Parameter;
use App\Repository\ApproachRepository;
use App\Repository\FooterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HeaderRepository;
use App\Repository\NetworkRepository;
use App\Service\Parameter as ServiceParameter;
use Doctrine\ORM\EntityManagerInterface;

class HeaderController extends AbstractController
{
    
    // public function index(EntityManagerInterface $em, ServiceParameter $parameter)
    // {

    //     // $parameter =new ServiceParameter($em);

    //     $headerPath = $parameter->get("headerImage");

    //     return $this->render('/_header.html.twig', [
    //         'pathPicture' => $headerPath
    //     ]);
    // } 
    
    
    public function indexMain(EntityManagerInterface $em, ServiceParameter $parameter)
    {

        //initialyse and insert data
        $listPicturesAndText = [];
        $listPicturesAndText[] = [
            "picturePath" => $parameter->get("mainHeaderImage1"),
            "text" => $parameter->get("mainHeaderText1"),
        ];
        $listPicturesAndText[] = [
            "picturePath" => $parameter->get("mainHeaderImage2"),
            "text" => $parameter->get("mainHeaderText2"),
        ];
        $listPicturesAndText[] = [
            "picturePath" => $parameter->get("mainHeaderImage3"),
            "text" => $parameter->get("mainHeaderText3"),
        ];

       
        return $this->render('/_headerMain.html.twig', [
            'headers' => $listPicturesAndText
        ]);
    } 

    public function index(ServiceParameter $parameter)
    {
        $headerPath = $parameter->get("header");
        return $this->render('/_header.html.twig', [
            'otherHeaders' => $headerPath
        ]);
    }
    
    
    public function indexBack(EntityManagerInterface $em)
    {
    
        return $this->render('/_headerBack.html.twig', [
            'controller_name' => 'HeaderController',
            'backHeader' => "",
        ]);
    }

    public function back(EntityManagerInterface $em)
    {
        return $this->render('/back_base.html.twig', [
            'controller_name' => 'HeaderController',
            'headers' => ""
        ]);
    }

    public function footer(ServiceParameter $parameter)
    {
        
        $listData = [
            "telephone" => $parameter->get("telephone"),
            "email" => $parameter->get("email"),
            "adress" =>$parameter->get("adress"),
            "open" => $parameter->get("open"),
            "closed" => $parameter->get("closed"),
            "text"=> $parameter->get("text"),
        ];
        return $this->render('/_footer.html.twig', [
            'footers' => $listData
        ]);
    }
}
