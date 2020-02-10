<?php

namespace App\Controller\Backend;

use App\Entity\Type;
use App\Form\TypeType;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/type")
 */
class TypeController extends AbstractController
{
    /**
     * @Route("/", name="type_index", methods={"GET", "POST"})
     */
    public function index(TypeRepository $typeRepository, Request $request): Response
    {
        $type = new Type();
        $typeForm = $this->createForm(TypeType::class, $type);
        $typeForm->handleRequest($request);

        if ($typeForm->isSubmitted() && $typeForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($type);
            $entityManager->flush();
            $this->addFlash(
                'confirmation',
                "Le type a été sauvegardé"
            );
            return $this->redirectToRoute('type_index');
        }
        return $this->render('back/type/index.html.twig', [
            'types' => $typeRepository->findAll(),
            'type' => $type,
            'typeForm' => $typeForm->createView()
        ]);
    }

    /**
     * @Route("/new", name="type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $type = new Type();
        $typeForm = $this->createForm(TypeType::class, $type);
        $typeForm->handleRequest($request);

        if ($typeForm->isSubmitted() && $typeForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($type);
            $entityManager->flush();

            return $this->redirectToRoute('type_index');
        }

        return $this->render('back/type/new.html.twig', [
            'type' => $type,
            'typeForm' => $typeForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_show", methods={"GET"})
     */
    public function show(Type $type): Response
    {
        return $this->render('back/type/show.html.twig', [
            'type' => $type,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Type $type): Response
    {
        $typeForm = $this->createForm(TypeType::class, $type);
        $typeForm->handleRequest($request);

        if ($typeForm->isSubmitted() && $typeForm->isValid()) {
            $image =  $typeForm->get('pathPicture')->getData();
            if ($image) {
                $originalImagename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeImagename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalImagename);
                $newImageName = $safeImagename.'-'.uniqid().'.'.$image->guessExtension();

            //    dd($image);
                    $image->move(
                        $this->getParameter('upload_picture_type_directory'),
                        $newImageName
                    );
                    
                    $type->setPathPicture($newImageName);
                }
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'confirmation',
                "Le type été sauvegardé"
            );

            return $this->redirectToRoute('type_index');
        }

        return $this->render('back/type/edit.html.twig', [
            'type' => $type,
            'typeForm' => $typeForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Type $type): Response
    {
        if ($this->isCsrfTokenValid('delete'.$type->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($type);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_index');
    }
}
