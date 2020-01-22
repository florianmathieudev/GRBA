<?php

namespace App\Controller\Backend;

use App\Entity\Footer;
use App\Form\FooterType;
use App\Repository\FooterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/footer")
 */
class FooterController extends AbstractController
{
    /**
     * @Route("/", name="footer_index", methods={"GET"})
     */
    public function index(FooterRepository $footerRepository, Request $request): Response
    {
        $footer = new Footer();
        $footerForm = $this->createForm(FooterType::class, $footer);
        $footerForm->handleRequest($request);
        if ($footerForm->isSubmitted() && $footerForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($footer);
            $entityManager->flush();
            return $this->redirectToRoute('footer_index');
        }
        return $this->render('back/footer/index.html.twig', [
            'footers' => $footerRepository->findAll(),
            'footer' => $footer,
            'footerForm' => $footerForm->createView(),
        ]);
    }

    /**
     * @Route("/new", name="footer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $footer = new Footer();
        $footerForm = $this->createForm(FooterType::class, $footer);
        $footerForm->handleRequest($request);

        if ($footerForm->isSubmitted() && $footerForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($footer);
            $entityManager->flush();

            return $this->redirectToRoute('footer_index');
        }

        return $this->render('back/footer/new.html.twig', [
            'footer' => $footer,
            'footerForm' => $footerForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="footer_show", methods={"GET"})
     */
    public function show(Footer $footer): Response
    {
        return $this->render('back/footer/show.html.twig', [
            'footer' => $footer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="footer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Footer $footer): Response
    {
        $footerForm = $this->createForm(FooterType::class, $footer);
        $footerForm->handleRequest($request);

        if ($footerForm->isSubmitted() && $footerForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('footer_index');
        }

        return $this->render('back/footer/edit.html.twig', [
            'footer' => $footer,
            'footerForm' => $footerForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="footer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Footer $footer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$footer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($footer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('footer_index');
    }
}
