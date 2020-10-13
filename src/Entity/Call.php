<?php

namespace App\Entity;

use App\Repository\CallRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CallRepository::class)
 */
class Call
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $number_1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $number_2;

    /**
     * @ORM\Column(type="datetime")
     */
    private $made_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber1(): ?string
    {
        return $this->number_1;
    }

    public function setNumber1(string $number_1): self
    {
        $this->number_1 = $number_1;

        return $this;
    }

    public function getNumber2(): ?string
    {
        return $this->number_2;
    }

    public function setNumber2(string $number_2): self
    {
        $this->number_2 = $number_2;

        return $this;
    }

    public function getMadeAt(): ?\DateTimeInterface
    {
        return $this->made_at;
    }

    public function setMadeAt(\DateTimeInterface $made_at): self
    {
        $this->made_at = $made_at;

        return $this;
    }
}
