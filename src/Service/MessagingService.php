<?php
namespace App\Service;

use App\Entity\Messages;
use App\Entity\User;
use App\Entity\Listings;
use Doctrine\ORM\EntityManagerInterface;

class MessagingService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function sendMessage(Messages $message, User $sender, User $receiver, Listings $listing)
    {
        $message->setSenderId($sender);
        $message->setReceiverId($receiver);
        $message->setListing($listing);
        $message->setSentAt(new \DateTime());

        $this->entityManager->persist($message);
        $this->entityManager->flush();
    }
}
