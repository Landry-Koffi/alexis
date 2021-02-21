<?php

namespace App\Controller;

use App\Entity\Emploi;
use App\Entity\Formation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $formations = $this->entityManager->getRepository(Formation::class)->findAll();
        $emplois = $this->entityManager->getRepository(Emploi::class)->findAll();
        return $this->render('home/index.html.twig', [
            'formations' => $formations,
            'emplois' => $emplois
        ]);
    }
}
