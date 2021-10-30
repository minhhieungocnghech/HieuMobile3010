<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Mobile;
use App\Form\MobileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class MobileController extends AbstractController
{
    /**
     * @Route("/manager/mobile/create", name="createMobile")
     */
    public function create(Request $request): Response
    {
        $mobile = new Mobile();
        $form = $this->createForm(MobileType::class, $mobile); 
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $image = $form->get('ImageUpload')->getData();
            if ($image != null) {
                $fileName = md5(uniqid());
                $fileExtension = $image->guessExtension();
                $imageName = $fileName . '.' . $fileExtension;
                try {
                    $image->move(
                        $this->getParameter('images_directory'), $imageName
                    );
                } catch (FileException $e) {
                    return new Response(
                        json_encode(['error' => $e->getMessage()]),
                        Response::HTTP_INTERNAL_SERVER_ERROR,
                        [
                            'content-type' => 'application/json'
                        ]
                    );
                }
                $mobile->setImage($imageName);
            }
            $manager->persist($mobile);
            $manager->flush();
            $this->addFlash("Info", "Create mobile succeed!");
            return $this->redirectToRoute("mobileManager"); 
        }

        return $this->render('mobile/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/manager/mobile/update/{id}", name="updateMobile")
     */
    public function updateMobile(Request $request, $id): Response
    {
        $mobile = $this->getDoctrine()->getRepository(Mobile::class)->find($id);
        if ($mobile == null) {
            $this->addFlash("Error", "Update failed!");
            return $this->redirectToRoute("mobileManager");   
        }
        $form = $this->createForm(MobileType::class, $mobile); 
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $image = $form->get('ImageUpload')->getData();
            if ($image != null) {
                $fileName = md5(uniqid());
                $fileExtension = $image->guessExtension();
                $imageName = $fileName . '.' . $fileExtension;
                try {
                    $image->move(
                        $this->getParameter('images_directory'), $imageName
                    );
                } catch (FileException $e) {
                    return new Response(
                        json_encode(['error' => $e->getMessage()]),
                        Response::HTTP_INTERNAL_SERVER_ERROR,
                        [
                            'content-type' => 'application/json'
                        ]
                    );
                }
                $mobile->setImage($imageName);
            }
            $manager->persist($mobile);
            $manager->flush();
            $this->addFlash("Info", "Update mobile succeed!");
            return $this->redirectToRoute("mobileManager"); 
        }

        return $this->render('mobile/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/manager/mobile/delete/{id}", name="deleteMobile")
     */
    public function deleteMobile(Request $request, $id): Response
    {
        $mobile = $this->getDoctrine()->getRepository(Mobile::class)->find($id);
        if ($mobile == null) {
            $this->addFlash("Error", "Update failed!");
            return $this->redirectToRoute("mobileManager");   
        }
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($mobile);
        $manager->flush();
        $this->addFlash("Info", "Delete mobile succeed !");
        return $this->redirectToRoute("mobileManager"); 
    }
}
