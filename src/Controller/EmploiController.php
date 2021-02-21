<?php

namespace App\Controller;

use App\Entity\Emploi;
use App\Entity\Message;
use App\Data\SearchData;
use App\Form\EmploiType;
use App\Form\SearchForm;
use App\Entity\EmploiLike;
use App\Form\CandidatureType;
use App\Repository\EmploiRepository;
use App\Repository\EmploiLikeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmploiController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }



    /**
     * @Route("/emplois", name="emplois")
     */
    public function index(EmploiRepository $repository, Request $request, PaginatorInterface $paginator): Response
    {
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        $emplois = $repository->findSearch($data);
        [$min, $max] = $repository->findMinMax($data);

        if (isset($_POST['search']) && !empty($_POST['search'])) {
            $emplois = $paginator->paginate(
                $repository->search($_POST['search']),
                $request->query->getInt('page', 1), 
                3
            );
        }

        if (isset($_POST['search2']) && !empty($_POST['search2'])) {
            $emplois = $paginator->paginate(
                $repository->search2($_POST['search2']),
                $request->query->getInt('page', 1), 
                3
            );
        }

        return $this->render('emploi/index.html.twig', [
            'emplois' => $emplois,
            'form' => $form->createView(),
            'min' => $min,
            'max' => $max
            
        ]);
    }



    /**
     * @Route("/emploi/{id}", name="emploi")
     */
    public function show($id): Response
    {
        $emploi = $this->entityManager->getRepository(Emploi::class)->findOneById($id);

        if (!$emploi) {
            return $this->redirectToRoute('emplois');
        }

        return $this->render('emploi/show.html.twig', [
            'emploi' => $emploi,
        ]);
    }


    
    /**
     * @Route("/new-emploi", name="emploi_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $emploi = new Emploi();
        $form = $this->createForm(EmploiType::class, $emploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $emploi->setAuteur($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($emploi);
            $entityManager->flush();

            return $this->redirectToRoute('emplois');
        }

        return $this->render('emploi/new.html.twig', [
            'emploi' => $emploi,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/emplois/favoris", name="favoris_emploi")
     */
    public function favoris(EmploiRepository $repository): Response
    {
        $user = $this->getUser();
        $emplois = $repository->findEmploisLikedByUser($user);

        return $this->render('emploi/favoris.html.twig', [
            'emplois' => $emplois,
        ]);
    }


    /**
     * Liker un emploi
     * 
     * @Route("/emploi/{id}/like", name="emploi_like")
     *
     * @param Emploi $emploi
     * @param EntityManagerInterface $manager
     * @param EmploiLikeRepository $likeRepo
     * @return Response
     */
    public function likes(Emploi $emploi, EntityManagerInterface $manager, EmploiLikeRepository $likeRepo) : Response
    {
        $user = $this->getUser();

        if(!$user) return $this->json([
            'code'=>403,
            'message'=> "Non autorisé"
        ], 403);

        if($emploi->isLikeByUser($user)) {
            $like = $likeRepo->findOneBy([
                'emploi' => $emploi,
                'user' =>  $user
            ]);

            $manager->remove($like);
            $manager->flush();

            return $this->json([
                'code'=>200,
                'message'=> "supprimé des favoris"
            ], 200);
        }

        $like = new EmploiLike();
        $like->setEmploi($emploi)
            ->setUser($user);
        
        $manager->persist($like);
        $manager->flush();

        return $this->json([
            'code'=> 200, 
            'message'=>'ajouté aux favoris'
        ], 200);
    }


    // Postuler


    /**
     * @Route("/emploi/{id}/candidature", name="emploi_candidature", methods={"GET","POST"})
     */
    public function candidature($id, Request $request): Response
    {
        $message = new Message();
        $form = $this->createForm(CandidatureType::class, $message);
        $form->handleRequest($request);
        $formation = $this->entityManager->getRepository(Emploi::class)->findOneBy(['id' =>  $id]);
        
        if ($formation instanceof Emploi) {
            $auteur = $formation->getAuteur();
            $nom = $formation->getNom();
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setFromId($this->getUser());
            $message->setToId($auteur);
            $message->setSubject("*Candidature : " . $nom);
            $message->setIsRead(0);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            return $this->redirectToRoute('candidature_confirmation');
        }

        return $this->render('candidature/new.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/emploi/candidature/confirmation", name="candidature_confirmation", methods={"GET"})
     */
    public function confirmation(): Response
    {

        return $this->render('candidature/confirmation.html.twig', [
        ]);
    }
}
