<?php

namespace App\Controller\Backend;

use App\Entity\Header;
use App\Entity\Footer;
use App\Entity\Contact;
use App\Entity\Network;
use App\Entity\Horaire;
use App\Form\HeaderType;
use App\Form\FooterType;
use App\Form\ContactType;
use App\Form\NetworkType;
use App\Form\HoraireType;
use App\Repository\HeaderRepository;
use App\Repository\FooterRepository;
use App\Repository\ContactRepository;
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
     * @Route("/", name="header_index", methods={"GET"})
     */
    public function index(HeaderRepository $headerRepository, FooterRepository $footerRepository, ContactRepository $contactRepository, NetworkRepository $networkRepository, HoraireRepository $horaireRepository, Request $request): Response
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

        $footer = new Footer();
        $footerForm = $this->createForm(FooterType::class, $footer);
        $footerForm->handleRequest($request);
        if ($footerForm->isSubmitted() && $footerForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($footer);
            $entityManager->flush();
            return $this->redirectToRoute('header_index');
        }

        $contact = new Contact();
        $contactForm = $this->createForm(ContactType::class, $contact);
        $contactForm->handleRequest($request);
        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
            return $this->redirectToRoute('header_index');
        }

        $network = new Network();
        $networkForm = $this->createForm(NetworkType::class, $network);
        $networkForm->handleRequest($request);
        if ($networkForm->isSubmitted() && $networkForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($network);
            $entityManager->flush();
            return $this->redirectToRoute('header_index');
        }

        $horaire = new Horaire();
        $horaireForm = $this->createForm(HoraireType::class, $horaire);
        $horaireForm->handleRequest($request);
        if ($horaireForm->isSubmitted() && $horaireForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($horaire);
            $entityManager->flush();
            return $this->redirectToRoute('header_index');
        }

        return $this->render('back/header/index.html.twig', [
            'headers' => $headerRepository->findAll(),
            'footers' => $footerRepository->findAll(),
            'contacts' => $contactRepository->findAll(),
            'networks' => $networkRepository->findAll(),
            'horaires' => $horaireRepository->findAll(),
            'header' => $header,
            'headerForm' => $headerForm->createView(),
            'footer' => $footer,
            'footerForm' => $footerForm->createView(),
            'contact' => $contact,
            'contactForm' => $contactForm->createView(),
            'network' => $network,
            'networkForm' => $networkForm->createView(),
            'horaire' => $horaire,
            'horaireForm' => $horaireForm->createView(),
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
