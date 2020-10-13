<?php

namespace App\Entity;

use DateTime;
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
     * @ORM\OneToOne(targetEntity="TelNumber")
     * @ORM\JoinColumn(name="number_from_id", referencedColumnName="id")
     */
    private TelNumber $number_1;

    /**
     * @ORM\OneToOne(targetEntity="TelNumber")
     * @ORM\JoinColumn(name="number_to_id", referencedColumnName="id")
     */
    private TelNumber $number_2;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTime $made_at;

    public function __construct(TelNumber $number_1, TelNumber $number_2)
    {
        $this->number_1 = $number_1;
        $this->number_2 = $number_2;
        $this->made_at = new DateTime();
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
