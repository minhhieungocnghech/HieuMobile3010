<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Mobile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        $brands = $this->getDoctrine()->getRepository(Brand::class)->findAll();  
        $mobiles = $this->getDoctrine()->getRepository(Mobile::class)->findAll(); 
        return $this->render('view/index.html.twig', [
            'brands' => $brands,
            'mobiles' => $mobiles,
        ]);
    }

    /**
     * @Route("/brand/{id}", name="viewByBrand")
     */
    public function viewByBrand($id): Response
    {
        $brands = $this->getDoctrine()->getRepository(Brand::class)->findAll(); 
        $brand = $this->getDoctrine()->getRepository(Brand::class)->find($id); 
       
        if ($brand == null) return $this->redirectToRoute("home");

        $mobiles = $brand->getMobiles(); 

        return $this->render('view/index.html.twig', [
            'brands' => $brands,
            'mobiles' => $mobiles,
        ]);
    }
}
