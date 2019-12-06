<?php

namespace App\Controller\Backend;

use App\Entity\Horaire;
use App\Form\HoraireType;
use App\Repository\HoraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/horaire")
 */
class HoraireController extends AbstractController
{
    /**
     * @Route("/", name="horaire_index", methods={"GET"})
     */
    public function index(HoraireRepository $horaireRepository): Response
    {
        return $this->render('back/horaire/index.html.twig', [
            'horaires' => $horaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="horaire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $horaire = new Horaire();
        $horaireForm = $this->createForm(HoraireType::class, $horaire);
        $horaireForm->handleRequest($request);

        if ($horaireForm->isSubmitted() && $horaireForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($horaire);
            $entityManager->flush();

            return $this->redirectToRoute('horaire_index');
        }

        return $this->render('back/horaire/new.html.twig', [
            'horaire' => $horaire,
            'horaireForm' => $horaireForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="horaire_show", methods={"GET"})
     */
    public function show(Horaire $horaire): Response
    {
        return $this->render('back/horaire/show.html.twig', [
            'horaire' => $horaire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="horaire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Horaire $horaire): Response
    {
        $horaireForm = $this->createForm(HoraireType::class, $horaire);
        $horaireForm->handleRequest($request);

        if ($horaireForm->isSubmitted() && $horaireForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('horaire_index');
        }

        return $this->render('back/horaire/edit.html.twig', [
            'horaire' => $horaire,
            'horaireForm' => $horaireForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="horaire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Horaire $horaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$horaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($horaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('horaire_index');
    }
}
