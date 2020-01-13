<?php

namespace App\Controller\Backend;

use App\Entity\Approach;
use App\Form\ApproachType;
use App\Repository\ApproachRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/approach")
 */
class ApproachController extends AbstractController
{
    /**
     * @Route("/", name="approach_index", methods={"GET"})
     */
    public function index(ApproachRepository $approachRepository): Response
    {
        return $this->render('back/approach/index.html.twig', [
            'approachs' => $approachRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="approach_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $approach = new Approach();
        $approachForm = $this->createForm(ApproachType::class, $approach);
        $approachForm->handleRequest($request);

        if ($approachForm->isSubmitted() && $approachForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($approach);
            $entityManager->flush();

            return $this->redirectToRoute('approach_index');
        }

        return $this->render('back/approach/new.html.twig', [
            'approach' => $approach,
            'approachForm' => $approachForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="approach_show", methods={"GET"})
     */
    public function show(Approach $approach): Response
    {
        return $this->render('back/approach/show.html.twig', [
            'approach' => $approach,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="approach_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Approach $approach): Response
    {
        $approachForm = $this->createForm(ApproachType::class, $approach);
        $approachForm->handleRequest($request);

        if ($approachForm->isSubmitted() && $approachForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('header_index');
        }

        return $this->render('back/approach/edit.html.twig', [
            'approach' => $approach,
            'approachForm' => $approachForm->createView(),
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

        return $this->redirectToRoute('header_index');
    }
}
