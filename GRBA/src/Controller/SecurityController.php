<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Form\RegistrationType;
use App\Form\UserType;
// use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form =$this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            //on va enregistrer par défaut le role "user"
            //pour ca, on va rechercher le role
            $roleUser = $manager->getRepository(Role::class)->findOneBy(["name" => "Utilisateur"]);
            $user->setRole($roleUser);
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('main');
        }
        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // /**
    //  * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
    //  */
    // public function edit(Request $request, User $user): Response
    // {
    //     $userForm = $this->createForm(RegistrationType::class, $user);
    //     $userForm->handleRequest($request);
        
    //     if ($userForm->isSubmitted() && $userForm->isValid()) {
    //         dd($userForm);
    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('user_index');
    //     }

    //     return $this->render('back/user/edit.html.twig', [
    //         'user' => $user,
    //         'userForm' => $userForm->createView(),
    //     ]);
    // }
    /**
     * @Route("/connexion", name="security_login")
     *
     */
    public function login() {


        return $this->render('security/login.html.twig');
    }
    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout() {
    }

}
