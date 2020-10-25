<?php

namespace App\Repository;

use App\Entity\TelNumber;
use Doctrine\ORM\EntityManagerInterface;

class NumberRepository
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return TelNumber[]
     */
    public function findAll(): array
    {
        return $this->entityManager->getRepository(TelNumber::class)->findAll();
    }

}
