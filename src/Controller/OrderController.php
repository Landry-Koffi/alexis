<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use App\Entity\OderDetails;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/commande/recapitulatif", name="order_recap", methods={"POST", "GET"})
     */
    public function add(Cart $cart)
    {
            $date = new \DateTime();
            $order = new Order();
            $reference = $date->format('dmY').'-'.uniqid();
            $order->setReference($reference);
            $order->setUser($this->getUser());
            $order->setCreatedAt($date);
            $order->setIsPaid(0);

            $this->entityManager->persist($order);

            foreach ($cart->getFull() as $product) {
                $orderDetails = new OderDetails();
                $orderDetails->setMyOrder($order);
                $orderDetails->setProduct($product['product']->getSubtitle());
                $orderDetails->setQuantity($product['quantity']);
                $orderDetails->setPrice($product['product']->getTotal());
                $orderDetails->setTotal($product['product']->getTotal() * $product['quantity']);
                $this->entityManager->persist($orderDetails);
            }

            $this->entityManager->flush();

            return $this->render('order/index.html.twig', [
                'cart' => $cart->getFull(),
                'reference' => $order->getReference()
            ]);

        return $this->redirectToRoute('paiement');
    }
}
