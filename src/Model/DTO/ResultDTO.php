<?php

namespace App\Model\DTO;

use App\Model\ResultSetInterface;
use App\Model\TripsInterface;

class ResultDTO implements ResultDTOInterface
{
    /**
     * @var array
     */
    private $tripMap = array();

    /**
     * @var array
     */
    private $measureInterval = array();

    /**
     * @var array
     */
    private $avgSpeedMap = array();

    /**
     * @var array
     */
    private $distanceMap = array();

    /**
     * @var ResultSetInterface[]
     */
    private $resultSet = array();

    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        // TODO: Implement serialize() method.
    }

    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        // TODO: Implement unserialize() method.
    }

    public function setAvgSpeed(TripsInterface $trips, float $avgSpeed)
    {
        $this->avgSpeedMap[$trips->getId()] = $avgSpeed;
    }

    public function setDistance(TripsInterface $trips, float $distance)
    {
        $this->distanceMap[$trips->getId()] = $distance;
    }

    public function setTrip(TripsInterface $trips, string $name)
    {
        $this->tripMap[$trips->getId()] = $name;
    }

    public function addResultSet(ResultSetInterface $resultSet)
    {
        $this->resultSet[] = $resultSet;
    }

    public function getResultSet(): array
    {
        return $this->resultSet;
    }

    public function getAvgSpeed(TripsInterface $trips): float
    {
        return $this->avgSpeedMap[$trips->getId()];
    }

    public function getDistance(TripsInterface $trips): float
    {
        return $this->distanceMap[$trips->getId()];
    }

    public function getTrip(TripsInterface $trips): string
    {
        return $this->tripMap[$trips->getId()];
    }

    public function getMeasureInterval(TripsInterface $trips): int
    {
        return $this->measureInterval[$trips->getId()];
    }

    public function setMeasureInterval(TripsInterface $trips, int $measureInterval)
    {
        $this->measureInterval[$trips->getId()] = $measureInterval;
    }
}