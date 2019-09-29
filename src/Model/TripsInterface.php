<?php

namespace App\Model;

use Doctrine\Common\Collections\Collection;

interface TripsInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     */
    public function setId(int $id): void;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name): void;

    /**
     * @return int
     */
    public function getMeasureInterval(): int;

    /**
     * @param int $measureInterval
     */
    public function setMeasureInterval(int $measureInterval): void;

    /**
     * @return Collection|TripMeasuresInterface[]
     */
    public function getTripMeasures(): Collection;
}