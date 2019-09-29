<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Model\TripMeasuresInterface;

/**
 * TripMeasures
 *
 * @ORM\Table(name="trip_measures")
 * @ORM\Entity
 */
class TripMeasures implements TripMeasuresInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="trip_id", type="integer", nullable=false)
     */
    private $tripId;

    /**
     * @var float
     *
     * @ORM\Column(name="distance", type="decimal", precision=5, scale=2, nullable=false)
     */
    private $distance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trips", inversedBy="tripMeasures")
     * @ORM\JoinColumn(name="trip_id", referencedColumnName="id")
     */
    private $trips;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getTripId(): int
    {
        return $this->tripId;
    }

    /**
     * @param int $tripId
     */
    public function setTripId(int $tripId): void
    {
        $this->tripId = $tripId;
    }

    /**
     * @return float
     */
    public function getDistance(): float
    {
        return $this->distance;
    }

    /**
     * @param string $distance
     */
    public function setDistance(string $distance): void
    {
        $this->distance = $distance;
    }
}
