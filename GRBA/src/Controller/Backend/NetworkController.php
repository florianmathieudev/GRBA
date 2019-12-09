<?php

namespace App\Controller\Backend;

use App\Entity\Network;
use App\Form\NetworkType;
use App\Repository\NetworkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/network")
 */
class NetworkController extends AbstractController
{
    /**
     * @Route("/", name="network_index", methods={"GET"})
     */
    public function index(NetworkRepository $networkRepository): Response
    {
        return $this->render('back/network/index.html.twig', [
            'networks' => $networkRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="network_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $network = new Network();
        $networkForm = $this->createForm(NetworkType::class, $network);
        $networkForm->handleRequest($request);

        if ($networkForm->isSubmitted() && $networkForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($network);
            $entityManager->flush();

            return $this->redirectToRoute('network_index');
        }

        return $this->render('back/network/new.html.twig', [
            'network' => $network,
            'networkForm' => $networkForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="network_show", methods={"GET"})
     */
    public function show(Network $network): Response
    {
        return $this->render('back/network/show.html.twig', [
            'network' => $network,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="network_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Network $network): Response
    {
        $networkForm = $this->createForm(NetworkType::class, $network);
        $networkForm->handleRequest($request);

        if ($networkForm->isSubmitted() && $networkForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('network_index');
        }

        return $this->render('back/network/edit.html.twig', [
            'network' => $network,
            'networkForm' => $networkForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="network_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Network $network): Response
    {
        if ($this->isCsrfTokenValid('delete'.$network->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($network);
            $entityManager->flush();
        }

        return $this->redirectToRoute('header_index');
    }
}
