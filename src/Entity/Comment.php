<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1024)
     */
    private $text;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $attached_at;

    public function getId()
    {
        return $this->id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getAttachedAt()
    {
        return $this->attached_at;
    }

    public function setText($text): void
    {
        $this->text = $text;
    }

    public function setAttachedAt($attached_at): void
    {
        $this->attached_at = $attached_at;
    }
}
