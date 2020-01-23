<?php

namespace App\Controller\Backend;

use App\Entity\HeadersPicture;
use App\Form\HeadersPictureType;
use App\Repository\HeadersPictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/headers/picture")
 */
class HeadersPictureController extends AbstractController
{
    /**
     * @Route("/", name="headers_picture_index", methods={"GET", "POST"})
     */
    public function index(HeadersPictureRepository $headersPictureRepository, Request $request): Response
    {
        $picture = new HeadersPicture();
        $pictureForm = $this->createForm(HeadersPictureType::class, $picture);
        $pictureForm->handleRequest($request);
        if ($pictureForm->isSubmitted() && $pictureForm->isValid()) {
            $pictureFiles = $pictureForm->get('path')->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $pictureName = $picture->getName();
            $i = 0;
            foreach ($pictureFiles as $pictureFile)
            {
                $i++;
                $picture = new HeadersPicture();
                $filePath = md5(uniqid()).'.'.$pictureFile->guessExtension();
                $pictureFile->move($this->getParameter('upload_picture_header_directory'), $filePath);
                $picture->setPath($filePath);
                $picture->setName($pictureName . "-" .$i);
                $entityManager->persist($picture);
            }
            
            $entityManager->flush();
            return $this->redirectToRoute('headers_picture_index');
        }

        // $picture = new HeadersPicture();
        // $pictureForm = $this->createForm(HeadersPictureType::class, $picture);
        // $pictureForm->handleRequest($request);

        // if ($pictureForm->isSubmitted() && $pictureForm->isValid()) {
        //     $file = $pictureForm->get('path')->getData();
        //     $filePath = md5(uniqid()).'.'.$file->guessExtension();
        //     $file->move($this->getParameter('upload_picture_header_directory'), $filePath);
        //     $picture->setPath($filePath);

        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->persist($picture);
        //     $entityManager->flush();

        //     return $this->redirectToRoute('headers_picture_index');
        // }
            

        return $this->render('back/headers_picture/index.html.twig', [
            'headers_pictures' => $headersPictureRepository->findAll(),
            'picture' => $picture,
            'pictureForm' => $pictureForm->createView(),
        ]);
    }

    /**
     * @Route("/new", name="headers_picture_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $headersPicture = new HeadersPicture();
        $form = $this->createForm(HeadersPictureType::class, $headersPicture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($headersPicture);
            $entityManager->flush();

            return $this->redirectToRoute('headers_picture_index');
        }

        return $this->render('headers_picture/new.html.twig', [
            'headers_picture' => $headersPicture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="headers_picture_show", methods={"GET"})
     */
    public function show(HeadersPicture $headersPicture): Response
    {
        return $this->render('headers_picture/show.html.twig', [
            'headers_picture' => $headersPicture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="headers_picture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, HeadersPicture $headersPicture): Response
    {
        $form = $this->createForm(HeadersPictureType::class, $headersPicture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('headers_picture_index');
        }

        return $this->render('headers_picture/edit.html.twig', [
            'headers_picture' => $headersPicture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="headers_picture_delete", methods={"DELETE"})
     */
    public function delete(Request $request, HeadersPicture $headersPicture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$headersPicture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($headersPicture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('headers_picture_index');
    }
}
