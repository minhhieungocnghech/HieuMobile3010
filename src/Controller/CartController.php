<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Mobile;
use App\Form\CartType;
use App\Form\MobileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(): Response
    {
        $cart = $this->getDoctrine()->getRepository(Cart::class)->findAll();
        return $this->render(
            'cart/index.html.twig',
            [
                'cart' => $cart
            ]
        );  
    }

    /**
     * @Route("/cart/add", name="cart_add")
     */

    public function cartAdd(Request $request) {
        
        $cart = new Cart();
        $form = $this->createForm(CartType::class,$cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($cart);
            $manager->flush();

            $this->addFlash("Success", "Add product to cart successfully !");
            return $this->redirectToRoute('cart');
        }

        return $this->render(
            "cart/add.html.twig", 
            [
                "form" => $form->createView()
            ]
        );
    }

    /**
     * @Route("/cart/delete{id}", name="cart_delete")
     */
    public function cartDelete($id) {
        $cart = $this->getDoctrine()->getRepository(Cart::class)->find($id);
         
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($cart);
            $manager->flush();
            $this->addFlash('Success', 'Delete magazine successfully !');
        
        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/cart/edit/{id}", name="cart_edit")
     */
    public function cartEdit(Request $request, $id) {
        $cart = $this->getDoctrine()->getRepository(Cart::class)->find($id);
        $form = $this->createForm(CartType::class,$cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($cart);
            $manager->flush();

            $this->addFlash("Success", "Add new magazine successfully !");
            return $this->redirectToRoute('cart');
        }

        return $this->render(
            "cart/edit.html.twig", 
            [
                "form" => $form->createView()
            ]
        );
    
    }
}
