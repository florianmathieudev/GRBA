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
     * @Route("/{id}", name="file_show", methods={"GET"})
     */
    public function show(File $file): Response
    {
        return $this->render('back/uploads/file/show.html.twig', [
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

            return $this->redirectToRoute('uploads_index');
        }

        return $this->render('back/uploads/file/edit.html.twig', [
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

        return $this->redirectToRoute('uploads_index');
    }
}
