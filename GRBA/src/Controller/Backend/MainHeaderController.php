<?php

namespace App\Controller\Backend;

use App\Entity\MainHeader;
use App\Form\MainHeaderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/mainHeader", name="main_header_")
 */
class MainHeaderController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request, EntityManagerInterface $entity)
    {
        $headers = $entity->getRepository(MainHeader::class)->findAll();


        $header = new MainHeader();
        $headerForm = $this->createForm(MainHeaderType::class, $header);
        $headerForm->handleRequest($request);
        if ($headerForm->isSubmitted() && $headerForm->isValid()) {

            $image1File = $headerForm->get('image1')->getData();

            if ($image1File) {
                $originalImage1Filename = pathinfo($image1File->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalImage1Filename);
                
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image1File->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $image1File->move(
                        $this->getParameter('imgHeaders_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $header->setImage1($newFilename);

                
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($header);
            $entityManager->flush();
            return $this->redirectToRoute('main_header_index');
        }
        return $this->render('back/main_header/index.html.twig', [
            'headers' => $headers,
            'header' => $header,
            'headerForm' => $headerForm->createView(),
        ]);
    }
}
