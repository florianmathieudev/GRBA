<?php

namespace App\Controller\Backend;

use App\Entity\Picture;
use App\Form\PictureType;
use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/picture")
 */
class PictureController extends AbstractController
{
    /**
     * @Route("/", name="picture_index", methods={"GET", "POST"})
     */
    public function index(PictureRepository $pictureRepository, Request $request): Response
    {
        $picture = new Picture();
        $pictureForm = $this->createForm(PictureType::class, $picture);
        $pictureForm->handleRequest($request);

        if ($pictureForm->isSubmitted() && $pictureForm->isValid()) {
            $file = $picture->getPath();
            $filePath = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $filePath);
            $picture->setPath($filePath);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($picture);
            $entityManager->flush();

            return $this->redirectToRoute('picture_index');
        }

        return $this->render('back/picture/index.html.twig', [
            'pictures' => $pictureRepository->findAll(),
            'pictureForm' => $pictureForm->createView(),
        ]);
    }

    /**
     * @Route("/new", name="picture_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $picture = new Picture();
        $pictureForm = $this->createForm(PictureType::class, $picture);
        $pictureForm->handleRequest($request);

        if ($pictureForm->isSubmitted() && $pictureForm->isValid()) {
            $file = $picture->getPath();
            $filePath = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $filePath);
            $picture->setPath($filePath);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($picture);
            $entityManager->flush();

            return $this->redirectToRoute('picture_index');
        }

        return $this->render('back/picture/new.html.twig', [
            'picture' => $picture,
            'pictureForm' => $pictureForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="picture_show", methods={"GET"})
     */
    public function show(Picture $picture): Response
    {
        return $this->render('back/picture/show.html.twig', [
            'picture' => $picture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="picture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Picture $picture): Response
    {
        $pictureForm = $this->createForm(PictureType::class, $picture);
        $pictureForm->handleRequest($request);

        if ($pictureForm->isSubmitted() && $pictureForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('picture_index');
        }

        return $this->render('back/picture/edit.html.twig', [
            'picture' => $picture,
            'pictureForm' => $pictureForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="picture_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Picture $picture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$picture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($picture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('picture_index');
    }
}
