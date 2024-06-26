<?php

namespace App\Entity;

use App\Repository\MessagesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessagesRepository::class)]
class Messages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    private ?User $senderId = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    private ?User $receiverId = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    private ?Listings $listing = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $sentAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSenderId(): ?User
    {
        return $this->senderId;
    }

    public function setSenderId(?User $senderId): static
    {
        $this->senderId = $senderId;

        return $this;
    }

    public function getReceiverId(): ?User
    {
        return $this->receiverId;
    }

    public function setReceiverId(?User $receiverId): static
    {
        $this->receiverId = $receiverId;

        return $this;
    }

    public function getListing(): ?Listings
    {
        return $this->listing;
    }

    public function setListing(?Listings $listing): static
    {
        $this->listing = $listing;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getSentAt(): ?\DateTime
    {
        return $this->sentAt;
    }

    public function setSentAt(\DateTime $sentAt): static
    {
        $this->sentAt = $sentAt;

        return $this;
    }
}
