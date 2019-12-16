<?php

namespace App\Controller\Backend;

use App\Entity\File;
use App\Form\FilesType;
use App\Entity\Picture;
use App\Form\PictureType;
use App\Repository\FileRepository;
use App\Repository\PictureRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/uploads")
 */
class UploadsController extends AbstractController
{
    /**
     * @Route("/", name="uploads_index", methods={"GET", "POST"})
     */
    public function index(FileRepository $fileRepository, PictureRepository $pictureRepository, Request $request): Response
    {
        $picture = new Picture();
        $pictureForm = $this->createForm(PictureType::class, $picture);
        $pictureForm->handleRequest($request);
        if ($pictureForm->isSubmitted() && $pictureForm->isValid()) {
            $pictureFile = $picture->getPath();
            $filePath = md5(uniqid()).'.'.$pictureFile->guessExtension();
            $pictureFile->move($this->getParameter('upload_picture_directory'), $filePath);
            $picture->setPath($filePath);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($picture);
            $entityManager->flush();
            return $this->redirectToRoute('uploads_index');
        }

        $file = new File();
        $fileForm = $this->createForm(FilesType::class, $file);
        $fileForm->handleRequest($request);
        if ($fileForm->isSubmitted() && $fileForm->isValid()) {
            $fileFile = $file->getPath();
            $filePath = md5(uniqid()).'.'.$fileFile->guessExtension();
            $fileFile->move($this->getParameter('upload_file_directory'), $filePath);
            $file->setPath($filePath);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($file);
            $entityManager->flush();
            return $this->redirectToRoute('uploads_index');
        }

        return $this->render('back/uploads/index.html.twig', [
            'pictures' => $pictureRepository->findAll(),
            'pictureForm' => $pictureForm->createView(),
            'files' => $fileRepository->findAll(),
            'fileForm' => $fileForm->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="picture_show", methods={"GET"})
     */
    public function show(Picture $picture): Response
    {
        return $this->render('back/uploads/picture/show.html.twig', [
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

        return $this->render('back/uploads/picture/edit.html.twig', [
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