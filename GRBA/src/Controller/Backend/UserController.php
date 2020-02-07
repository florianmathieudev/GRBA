<?php

namespace App\Controller\Backend;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Role;
use App\Form\RoleType;
use App\Form\UserRoleType;
use App\Repository\UserRepository;
use App\Repository\RoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET","POST"})
     */
    public function index(UserRepository $userRepository, Request $request, RoleRepository $roleRepository): Response
    {
        $user = new User();
        $userForm = $this->createForm(UserType::class, $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('user_index');
        }

        return $this->render('back/user/index.html.twig', [
            'users' => $userRepository->findAll(),
            'user' => $user,
            'userForm' => $userForm->createView(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $userForm = $this->createForm(UserType::class, $user);
        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $role =$entityManager->getRepository(Role::class)->findOneBy(["code" => "1"]);
            $user->setRole($role);//  pour formulaire visiteur
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('back/user/new.html.twig', [
            'user' => $user,
            'userForm' => $userForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('back/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        //je recupere le mot de passe
        $oldPassword = $user->getPassword();
        $userForm = $this->createForm(UserRoleType::class, $user);
        $userForm->handleRequest($request);
        $user->setPassword($oldPassword);
        //je le set dans confirmPassword
        $user->setConfirmPassword($oldPassword);
        
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $user->setPassword($oldPassword);
            $user->setConfirmPassword($oldPassword);
            
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirectToRoute('user_index');
        }
        // dd($userForm);

        return $this->render('back/user/edit.html.twig', [
            'user' => $user,
            'userRoleForm' => $userForm->createView(),
            
        ]);
        
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
