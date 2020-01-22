<?php

namespace App\Controller\Backend;

use App\Entity\Header;
use App\Entity\Footer;
use App\Entity\Approach;
use App\Entity\Network;
use App\Entity\Horaire;
use App\Form\HeaderType;
use App\Form\FooterType;
use App\Form\ApproachType;
use App\Form\NetworkType;
use App\Form\HoraireType;
use App\Repository\HeaderRepository;
use App\Repository\FooterRepository;
use App\Repository\ApproachRepository;
use App\Repository\NetworkRepository;
use App\Repository\HoraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/header")
 */
class HeaderController extends AbstractController
{
    /**
     * @Route("/", name="header_index", methods={"GET","POST"})
     */
    public function index(HeaderRepository $headerRepository, FooterRepository $footerRepository, ApproachRepository $approachRepository, NetworkRepository $networkRepository, Request $request): Response
    {

        $header = new Header();
        $headerForm = $this->createForm(HeaderType::class, $header);
        $headerForm->handleRequest($request);
        if ($headerForm->isSubmitted() && $headerForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($header);
            $entityManager->flush();
            return $this->redirectToRoute('header_index');
        }






        return $this->render('back/header/index.html.twig', [
            'headers' => $headerRepository->findAll(),
            'footers' => $footerRepository->findAll(),
            'header' => $header,
            'headerForm' => $headerForm->createView(),
        ]);
    }

    /**
     * @Route("/new", name="header_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $header = new Header();
        $headerForm = $this->createForm(HeaderType::class, $header);
        $headerForm->handleRequest($request);

        if ($headerForm->isSubmitted() && $headerForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($header);
            $entityManager->flush();

            return $this->redirectToRoute('header_index');
        }

        return $this->render('back/header/new.html.twig', [
            'header' => $header,
            'headerForm' => $headerForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="header_show", methods={"GET"})
     */
    public function show(Header $header): Response
    {
        return $this->render('back/header/show.html.twig', [
            'header' => $header,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="header_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Header $header): Response
    {
        $headerForm = $this->createForm(HeaderType::class, $header);
        $headerForm->handleRequest($request);

        if ($headerForm->isSubmitted() && $headerForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('header_index');
        }

        return $this->render('back/header/edit.html.twig', [
            'header' => $header,
            'headerForm' => $headerForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="header_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Header $header): Response
    {
        if ($this->isCsrfTokenValid('delete'.$header->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($header);
            $entityManager->flush();
        }

        return $this->redirectToRoute('header_index');
    }
}
