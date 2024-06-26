<?php
namespace App\Controller;

use App\Entity\Messages;
use App\Entity\Listings;
use App\Form\MessageType;
use App\Repository\ListingsRepository;
use App\Repository\MessagesRepository;
use App\Service\MessagingService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Requirement\Requirement;

class MessageController extends AbstractController
{
    #[Route('/messages/send/{id}', name: 'send_message',  requirements: ['id' => Requirement::DIGITS])]
    public function sendMessage($id, Request $request, ListingsRepository $listingsRepository, MessagingService $messagingService): Response
    {
        $message = new Messages();
        $listing = $listingsRepository->find($id);
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $messagingService->sendMessage($message, $this->getUser(), $listing->getUser(), $listing);
            $this->addFlash('success', 'Le message a été envoyé avec succès.');
            return $this->redirectToRoute('app_homeUser');
        }

        return $this->render('message/send.html.twig', [
            'form' => $form->createView(),
            'listing' => $listing,
        ]);
    }

    #[Route('/messages/inbox', name: 'inbox')]
    public function inbox(MessagesRepository $messagesRepository): Response
    {
        $user = $this->getUser();
        $messages = $messagesRepository->findBy(['receiverId' => $user]);

        return $this->render('message/inbox.html.twig', [
            'messages' => $messages,
        ]);
    }
}
