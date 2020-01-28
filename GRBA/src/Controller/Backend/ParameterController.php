<?php

namespace App\Controller\Backend;

use App\Entity\ContactPage;
use App\Entity\HeaderMainPage;
use App\Form\ContactPageType;
use App\Form\HeaderMainPageType;
use App\Service\Parameter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * le ParameterController va gérer tous les forms permettant de modifier les infos
 * de la table parameter
 * 
 * le fonctionnement de parameter est particulié, il ne possède que colonnes utiles :
 * - keyIndex cad, la clé de la valeur souhaité
 * - value, la valeur
 *  
 * @Route("/backend/parameter", name="backend_parameter_")
 */
class ParameterController extends AbstractController
{
    /**
     * permet de paramétrer les images et le texte du "header" de la page d'accueil
     * @Route("/HeaderMainPage", name="HeaderMainPage")
     */
    public function HeaderMainPage(Parameter $parameter, Request $request, EntityManagerInterface $em)
    {

        //$headerData va permettre d'être un modele tampon, cad que l'on ne va pas
        //directement prendre une entity relié à la bdd, mais juste une simple class
        //qui va stocker les infos, une fois le formulaire soumit, on redispachera les data
        //dans la table parameter
        $headerData = new HeaderMainPage();
        //on alimente $headerData afin d'afficher les infos dans le formulaire
        $headerData->text1 = $parameter->get("mainHeaderText1");
        $headerData->text2 = $parameter->get("mainHeaderText2");
        $headerData->text3 = $parameter->get("mainHeaderText3");
        //et on passe $headerData au formulaire
        $form = $this->createForm(HeaderMainPageType::class, $headerData);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            //todo lorsque le forumaire est soumi, on doit récupérer les images et le texte
            // si pas d'image envoyé, on garde les images précédentes
            $image1 = $form->get('picturePath1')->getData();

            if ($image1) {
                $originalImagename1 = pathinfo($image1->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalImagename1);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image1->guessExtension();

                try {
                    $image1->move(
                        $this->getParameter('imgHeaders_directory'), $newFilename
                    );
                    $parameter->set("mainHeaderImage1", $newFilename);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

            }
           

        
            //Récupération du Post de l'image2 dans $image2
            $image2 = $form->get('picturePath2')->getData();
            //test si $image2 existe
            if ($image2) {
                //on enregistre le nom du fichier pour pouvoir le rendre safe et le réutiliser
                $originalimage2name = pathinfo($image2->getClientOriginalName(), PATHINFO_FILENAME);
                $safeImage2Name = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalimage2name);
                //on concatene le nouveau nom avec un  id unique et l'extension du fichier pour qu'il n'y est pas d'écrasement de fichier
                $newImage2Name = $safeImage2Name.'-'.uniqid().'.'.$image2->guessExtension();
                //on met le fichier dans le dossier image
                try {
                    $image2->move(
                        $this->getParameter('imgHeaders_directory'),
                        $newImage2Name
                    );
                    //on enregistre le nom de l'image dans parameter sous la clé mainHeaderImage2
                    $parameter->set("mainHeaderImage2", $newImage2Name);
                } catch (FileException $e) {
                    $this->addFlash(
                        'error',
                        "Déplacement de image2 dans le dossier image impossible"
                    );
                }

            }

            //Récupération du Post de l'image3 dans $image3
            $image3 = $form->get('picturePath3')->getData();
            //test si $image2 existe
            if ($image3) {
                //on enregistre le nom du fichier pour pouvoir le rendre safe et le réutiliser
                $originalimage3name = pathinfo($image3->getClientOriginalName(), PATHINFO_FILENAME);
                $safeImage3Name = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalimage3name);
                //on concatene le nouveau nom avec un  id unique et l'extension du fichier pour qu'il n'y est pas d'écrasement de fichier
                $newImage3Name = $safeImage3Name.'-'.uniqid().'.'.$image3->guessExtension();
                //on met le fichier dans le dossier image
                try {
                    $image3->move(
                        $this->getParameter('imgHeaders_directory'),
                        $newImage3Name
                    );
                    //on enregistre le nom de l'image dans parameter sous la clé mainHeaderImage2
                    $parameter->set("mainHeaderImage3", $newImage3Name);
                } catch (FileException $e) {
                    $this->addFlash(
                        'error',
                        "Déplacement de image3 dans le dossier image impossible"
                    );
                }

            }
            
           
            

            $parameter->set("mainHeaderText1", $headerData->text1);
            $parameter->set("mainHeaderText2", $headerData->text2);
            $parameter->set("mainHeaderText3", $headerData->text3);

            
            $em->flush();

            $this->addFlash(
                'confirmation',
                "Le header a été sauvegardé."
            );

            return $this->redirectToRoute('backend_parameter_HeaderMainPage');
        };


        return $this->render('back/parameter/headerMainPage.html.twig', [
            "headerMainPageForm" => $form->createView()
        ]);
    }


    /**
     * @Route("/ContactPage", name="ContactPage")
     */
    public function ContactPage(Parameter $parameter, Request $request, EntityManagerInterface $em)
    {
        $contactData = new ContactPage();
    
        $contactData->telephone = $parameter->get("telephone");
        $contactData->email = $parameter->get("email");
        $contactData->adress = $parameter->get("adress");
        $contactData->open = $parameter->get("open");
        $contactData->closed = $parameter->get("closed");
        $form = $this->createForm(ContactPageType::class, $contactData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $parameter->set("telephone", $contactData->telephone);
            $parameter->set("email", $contactData->email);
            $parameter->set("adress", $contactData->adress);
            $parameter->set("open", $contactData->open);
            $parameter->set("closed", $contactData->closed);

            $em->flush();

            $this->addFlash(
                'confirmation',
                "Les contact one été sauvegardé."
            );
            return $this->redirectToRoute('backend_parameter_ContactPage');
        };
        return $this->render('back/parameter/contactPage.html.twig', [
            "contactPageForm" => $form->createView()
        ]);
    }
}
