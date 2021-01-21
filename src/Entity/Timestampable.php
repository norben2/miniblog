<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeInterface;
use Symfony\Component\Serializer\Annotation\Groups;

trait Timestampable
{
    /**
     * DateTimeInterface
     * @ORM\Column(type="datetime")
     * @Groups({"user_read", "user_details_read", "article_details_read", "article_read"})
     */
    private \DateTimeInterface $createdAt;
    /**
     * DateTimeInterface
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"user_read", "user_details_read", "article_details_read", "article_read"})
     */
    private ?\DateTimeInterface $updatedAt;

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
