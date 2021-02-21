<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Abonnement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PaiementController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/paiement", name="paiement", methods={"GET"})
     */
    public function index(Cart $cart): Response
    {
        $abonnements = $this->entityManager->getRepository(Abonnement::class)->findAll();

        return $this->render('paiement/index.html.twig', [
            'abonnements' => $abonnements,
            'cart' => $cart->getFull()
        ]);
    }


    /**
     * @Route("/paiement/add/{id}", name="add_to_cart")
     */
    public function add(Cart $cart, $id)
    {
        $cart->add($id);

        return $this->redirectToRoute('paiement');
    }

    /**
     * @Route("/paiement/remove", name="remove_my_cart")
     */
    public function remove(Cart $cart)
    {
        $cart->remove();

        return $this->redirectToRoute('paiement');
    }

    /**
     * @Route("/paiement/delete/{id}", name="delete_to_cart")
     */
    public function delete(Cart $cart, $id)
    {
        $cart->delete($id);

        return $this->redirectToRoute('paiement');
    }

    /**
     * @Route("/paiement/decrease/{id}", name="decrease_to_cart")
     */
    public function decrease(Cart $cart, $id)
    {
        $cart->decrease($id);

        return $this->redirectToRoute('paiement');
    }



}
