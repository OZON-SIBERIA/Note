<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;


class CommentRepository
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    private \DateTime $createdAt;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->createdAt = new \DateTime();
        $this->entityManager = $entityManager;
    }

    public function findAllBy($criteria)
    {
        return $this->entityManager->getRepository(Comment::class)->findBy($criteria);
    }
}
