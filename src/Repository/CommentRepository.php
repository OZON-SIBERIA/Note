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

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findAll() {
        return $this->entityManager->getRepository(Comment::class)->findAll();
    }
    public function findAllBy($criteria)
    {
        return $this->entityManager->getRepository(Comment::class)->findBy($criteria);
    }
}
