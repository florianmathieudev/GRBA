<?php

namespace App\Controller\Backend;

use App\Entity\TypesPicture;
use App\Form\TypesPictureType;
use App\Repository\TypesPictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/types/picture")
 */
class TypesPictureController extends AbstractController
{
    /**
     * @Route("/", name="types_picture_index", methods={"GET", "POST"})
     */
    public function index(TypesPictureRepository $typesPictureRepository, Request $request): Response
    {
        $picture = new TypesPicture();
        $pictureForm = $this->createForm(TypesPictureType::class, $picture);
        $pictureForm->handleRequest($request);

        if ($pictureForm->isSubmitted() && $pictureForm->isValid()) {
            $file = $pictureForm->get('path')->getData();
            $filePath = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_picture_type_directory'), $filePath);
            $picture->setPath($filePath);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($picture);
            $entityManager->flush();

            return $this->redirectToRoute('types_picture_index');
        }
            

        return $this->render('back/types_picture/index.html.twig', [
            'types_pictures' => $typesPictureRepository->findAll(),
            'picture' => $picture,
            'pictureForm' => $pictureForm->createView(),
        ]);
    }

    /**
     * @Route("/new", name="types_picture_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typesPicture = new TypesPicture();
        $form = $this->createForm(TypesPictureType::class, $typesPicture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typesPicture);
            $entityManager->flush();

            return $this->redirectToRoute('types_picture_index');
        }

        return $this->render('back/types_picture/new.html.twig', [
            'types_picture' => $typesPicture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="types_picture_show", methods={"GET"})
     */
    public function show(TypesPicture $typesPicture): Response
    {
        return $this->render('back/types_picture/show.html.twig', [
            'types_picture' => $typesPicture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="types_picture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypesPicture $typesPicture): Response
    {
        $form = $this->createForm(TypesPictureType::class, $typesPicture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('types_picture_index');
        }

        return $this->render('back/types_picture/edit.html.twig', [
            'types_picture' => $typesPicture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="types_picture_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypesPicture $typesPicture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typesPicture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typesPicture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('types_picture_index');
    }
}
