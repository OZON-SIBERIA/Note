<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Call
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="TelNumber", cascade={"persist"})
     * @ORM\JoinColumn(name="number_from_id", referencedColumnName="id")
     */
    private TelNumber $number_from;

    /**
     * @ORM\ManyToOne(targetEntity="TelNumber", cascade={"persist"})
     * @ORM\JoinColumn(name="number_to_id", referencedColumnName="id")
     */
    private TelNumber $number_to;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTime $made_at;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="attached_at", cascade={"all"})
     */
    private ArrayCollection $comments;

    public function __construct(TelNumber $number_from, TelNumber $number_to, array $comments = [])
    {
        $this->number_from = $number_from;
        $this->number_to = $number_to;
        $this->made_at = new DateTime();
        $this->comments = new ArrayCollection($comments);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMadeAt(): \DateTimeInterface
    {
        return $this->made_at;
    }

    /**
     * @param DateTime $made_at
     */
    public function setMadeAt(DateTime $made_at): void
    {
        $this->made_at = $made_at;
    }

    /**
     * @param TelNumber $number_from
     */
    public function setNumberFrom(TelNumber $number_from): void
    {
        $this->number_from = $number_from;
    }

    /**
     * @param TelNumber $number_to
     */
    public function setNumberTo(TelNumber $number_to): void
    {
        $this->number_to = $number_to;
    }
    
}
