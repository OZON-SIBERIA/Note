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
    private TelNumber $number_1;

    /**
     * @ORM\ManyToOne(targetEntity="TelNumber", cascade={"persist"})
     * @ORM\JoinColumn(name="number_to_id", referencedColumnName="id")
     */
    private TelNumber $number_2;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTime $made_at;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="attached_at", cascade={"all"})
     */
    private ArrayCollection $comments;

    public function __construct(TelNumber $number_1, TelNumber $number_2, array $comments = [])
    {
        $this->number_1 = $number_1;
        $this->number_2 = $number_2;
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
}
