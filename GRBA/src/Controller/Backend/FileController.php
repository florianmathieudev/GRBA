<?php

namespace App\Controller\Backend;

use App\Entity\File;
use App\Form\FilesType;
use App\Repository\FileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/file")
 */
class FileController extends AbstractController
{

    /**
     * @Route("/", name="file_index", methods={"GET", "POST"})
     */
    public function index(FileRepository $fileRepository, Request $request): Response
    {       
        $file = new File();
        $fileForm = $this->createForm(FilesType::class, $file);
        $fileForm->handleRequest($request);
        if ($fileForm->isSubmitted() && $fileForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($file);
            $entityManager->flush();
            return $this->redirectToRoute('file_index');
        }
        return $this->render('back/file/index.html.twig', [
            'files' => $fileRepository->findAll(),
            'file' => $file,
            'fileForm' => $fileForm->createView(),
        ]);
    }    
    
    /**
     * @Route("/", name="file_new", methods={"GET", "POST"})
     */
    public function new(Request $request): Response
    {       
        $file = new File();
        $fileForm = $this->createForm(FilesType::class, $file);
        $fileForm->handleRequest($request);
        if ($fileForm->isSubmitted() && $fileForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($file);
            $entityManager->flush();
            return $this->redirectToRoute('file_index');
        }
        return $this->render('back/file/index.html.twig', [
            'file' => $file,
            'fileForm' => $fileForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="file_show", methods={"GET"})
     */
    public function show(File $file): Response
    {
        return $this->render('back/file/show.html.twig', [
            'file' => $file,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="file_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, File $file): Response
    {
        $fileForm = $this->createForm(FilesType::class, $file);
        $fileForm->handleRequest($request);

        if ($fileForm->isSubmitted() && $fileForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('file_index');
        }

        return $this->render('back/file/edit.html.twig', [
            'file' => $file,
            'fileForm' => $fileForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="file_delete", methods={"DELETE"})
     */
    public function delete(Request $request, File $file): Response
    {
        if ($this->isCsrfTokenValid('delete'.$file->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($file);
            $entityManager->flush();
        }

        return $this->redirectToRoute('file_index');
    }
}
