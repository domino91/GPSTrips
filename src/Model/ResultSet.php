<?php

namespace App\Model;

class ResultSet implements ResultSetInterface
{
    /**
     * @var string
     */
    private $trip;

    /**
     * @var float
     */
    private $distance;

    /**
     * @var int
     */
    private $measureInterval;

    /**
     * @var float
     */
    private $avgSpeed;

    function getTrip(): string
    {
        return $this->trip;
    }

    function getDistance(): float
    {
       return $this->distance;
    }

    function getMeasureInterval(): int
    {
        return $this->measureInterval;
    }

    function getAvgSpeed(): float
    {
        return $this->avgSpeed;
    }

    function setTrip(string $tripName)
    {
        $this->trip = $tripName;
    }

    function setDistance(float $distance)
    {
        $this->distance = $distance;
    }

    function setMeasureInterval(int $measureInterval)
    {
        $this->measureInterval = $measureInterval;
    }

    function setAvgSpeed(float $avgSpeed)
    {
        $this->avgSpeed = $avgSpeed;
    }
}