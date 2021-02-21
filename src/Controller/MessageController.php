<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\User;
use App\Entity\Message;
use App\Form\MessageType;
use App\Form\ReplyMessageType;
use App\Repository\UserRepository;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/message")
 */
class MessageController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * @Route("/", name="message_index", methods={"GET"})
     */
    public function index(MessageRepository $messageRepository): Response
    {

        $messages = $messageRepository->findUserMessages($this->getUser('id'));
        return $this->render('message/index.html.twig', [
            'messages' => $messages,
        ]);
    }



    /**
     * @Route("/new", name="message_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setFromId($this->getUser());
            $message->setIsRead(0);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            $toId = $form["to_id"]->getData()->getEmail();
            $firstName = $form["to_id"]->getData()->getFirstName();

            $mail = new Mail();
            $content = "Bonjour ".$firstName."<br/> Vous avez reçu un nouveau message sur Jobissim.";
            $mail->send($toId, $firstName, 'Nouveau message sur Jobissim.', $content);

            return $this->redirectToRoute('message_index');
        }

        return $this->render('message/new.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
        ]);
    }


    
    /**
     * @Route("/{id}/edit", name="message_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Message $message): Response
    {
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('message_index');
        }

        return $this->render('message/edit.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{letter}/{id}", name="message_show", methods={"GET","POST"})
     */
    public function show($id, $letter, Request $request, Message $message, MessageRepository $messageRepository, UserRepository $userRepo): Response
    {
        // dd($id);
        // $to = $userRepo->findOneBy(['id' => $id]);
        $messages = $messageRepository->Message($this->getUser('id'), $letter);
        // Ouvrir le message
        $message->setIsRead(1);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($message);
            $manager->flush();

        // Répondre au message
        $messageBack = new Message();
        $form = $this->createForm(ReplyMessageType::class, $messageBack);
        $form->handleRequest($request);
        $messagerie = $this->entityManager->getRepository(Message::class)->findOneBy(['id' => $id]);
        
        if ($messagerie instanceof Message) {
            $toId = $messagerie->getFromId();
            $sujet = $messagerie->getSubject();
        } 

        if ($form->isSubmitted() && $form->isValid()) {
            $messageBack->setFromId($this->getUser());
            $messageBack->setToId($toId);
            $messageBack->setSubject("Re : " . $sujet);
            $messageBack->setIsRead(0);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($messageBack);
            $entityManager->flush();

            return $this->redirectToRoute('message_index');
        }

        return $this->render('message/show.html.twig', [
            'message' => $message,
            'messageBack' => $messageBack,
            'form' => $form->createView(),
            'messages' => $messages
        ]);
    }



    /**
     * @Route("/{id}", name="message_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Message $message): Response
    {
        if ($this->isCsrfTokenValid('delete'.$message->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($message);
            $entityManager->flush();
        }

        return $this->redirectToRoute('message_index');
    }
}
