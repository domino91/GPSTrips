<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Model\TripsInterface;

/**
 * Trips
 *
 * @ORM\Table(name="trips")
 * @ORM\Entity
 * @codeCoverageIgnore
 */
class Trips implements TripsInterface
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=20, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="measure_interval", type="integer", nullable=false)
     */
    private $measureInterval;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TripMeasures", mappedBy="trips")
     * @ORM\OrderBy({"id" = "ASC"})
     */
    private $tripMeasures;

    /**
     * Trips constructor.
     */
    public function __construct()
    {
        $this->tripMeasures = new ArrayCollection();
    }

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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getMeasureInterval(): int
    {
        return $this->measureInterval;
    }

    /**
     * @param int $measureInterval
     */
    public function setMeasureInterval(int $measureInterval): void
    {
        $this->measureInterval = $measureInterval;
    }

    /**
     * @return Collection|TripMeasures[]
     */
    public function getTripMeasures(): Collection
    {
        return $this->tripMeasures;
    }
}
