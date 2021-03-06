<?php

namespace App\Controller\Backend;

use App\Entity\Role;
use App\Form\RoleType;
use App\Repository\RoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/role")
 */
class RoleController extends AbstractController
{
    /**
     * @Route("/", name="role_index", methods={"GET", "POST"})
     */
    public function index(RoleRepository $roleRepository, Request $request): Response
    {
        $role = new Role();
        $roleForm = $this->createForm(RoleType::class, $role);
        $roleForm->handleRequest($request);
        if ($roleForm->isSubmitted() && $roleForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($role);
            $entityManager->flush();
            $this->addFlash(
                'confirmation',
                "Le rôle a été sauvegardé"
            );
            return $this->redirectToRoute('role_index');
        }
        return $this->render('back/role/index.html.twig', [
            'roles' => $roleRepository->findAll(),
            'role' => $role,
            'roleForm' => $roleForm->createView(),
        ]);
    }

    /**
     * @Route("/new", name="role_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $role = new Role();
        $roleForm = $this->createForm(RoleType::class, $role);
        $roleForm->handleRequest($request);

        if ($roleForm->isSubmitted() && $roleForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($role);
            $entityManager->flush();

            return $this->redirectToRoute('role_index');
        }

        return $this->render('back/role/new.html.twig', [
            'role' => $role,
            'roleForm' => $roleForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="role_show", methods={"GET"})
     */
    public function show(Role $role): Response
    {
        return $this->render('back/role/show.html.twig', [
            'role' => $role,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="role_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Role $role): Response
    {
        $roleForm = $this->createForm(RoleType::class, $role);
        $roleForm->handleRequest($request);

        if ($roleForm->isSubmitted() && $roleForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('role_index');
        }

        return $this->render('back/role/edit.html.twig', [
            'role' => $role,
            'roleForm' => $roleForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="role_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Role $role): Response
    {
        if ($this->isCsrfTokenValid('delete'.$role->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($role);
            $entityManager->flush();
        }

        return $this->redirectToRoute('role_index');
    }
}
