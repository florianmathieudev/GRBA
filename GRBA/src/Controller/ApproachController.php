<?php

namespace App\Controller;

use App\Entity\Approach;
use App\Form\ApproachType;
use App\Form\Approach1Type;
use App\Repository\ApproachRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/approach")
 */
class ApproachController extends AbstractController
{
    /**
     * @Route("/", name="approach_index", methods={"GET"})
     */
    public function index(ApproachRepository $approachRepository): Response
    {
        return $this->render('approach/index.html.twig', [
            'approaches' => $approachRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="approach_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $approach = new Approach();
        $form = $this->createForm(ApproachType::class, $approach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($approach);
            $entityManager->flush();

            return $this->redirectToRoute('approach_index');
        }

        return $this->render('approach/new.html.twig', [
            'approach' => $approach,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="approach_show", methods={"GET"})
     */
    public function show(Approach $approach): Response
    {
        return $this->render('approach/show.html.twig', [
            'approach' => $approach,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="approach_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Approach $approach): Response
    {
        $form = $this->createForm(ApproachType::class, $approach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('approach_index');
        }

        return $this->render('approach/edit.html.twig', [
            'approach' => $approach,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="approach_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Approach $approach): Response
    {
        if ($this->isCsrfTokenValid('delete'.$approach->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($approach);
            $entityManager->flush();
        }

        return $this->redirectToRoute('approach_index');
    }
}