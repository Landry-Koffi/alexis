<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{
    /**
     * @Route("/commande/create-session/{reference}", name="stripe_create_session")
     */
    public function index(EntityManagerInterface $entityManager, Cart $cart, $reference)
    {
        $products_for_stripe = [];
        $YOUR_DOMAIN = 'https://jobissim.alexismoren.fr';

        $order = $entityManager->getRepository(Order::class)->findOneByReference($reference);

        if (!$order) {
            new JsonResponse(['error' => 'order']);
        }

        foreach ($order->getOderDetails()->getValues() as $product) {
            $products_for_stripe[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $product->getPrice()*100,
                    'product_data' => [
                        'name' => $product->getProduct(),
                    ],
                ],
                'quantity' => $product->getQuantity(),
            ];
        }

        Stripe::setApiKey('sk_test_51IGkdAH6KGzD4QaIYi0LwZRq9RkoDnvo5d29n0hmP9jIBu39t7M6BICk5mgwEzIoifFKguIFA6aOkWOL4CS7juTU00i3lcwCZ4');

        $checkout_session = Session::create([
            'customer_email' => $this->getUser()->getEmail(),
            'payment_method_types' => ['card'],
            'line_items' => [
                $products_for_stripe
            ],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/commande/merci/{CHECKOUT_SESSION_ID}',
            'cancel_url' => $YOUR_DOMAIN . '/commande/erreur/{CHECKOUT_SESSION_ID}',
        ]);

        $order->setStripeSessionId($checkout_session->id);
        $entityManager->flush();
        $response = new JsonResponse(['id' => $checkout_session->id]);
        return $response;
    }
}
