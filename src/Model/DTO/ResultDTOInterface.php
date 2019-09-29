<?php

namespace App\Model\DTO;

use App\Model\ResultSetInterface;
use App\Model\TripsInterface;
use \Serializable;

interface ResultDTOInterface extends Serializable
{
    public function setAvgSpeed(TripsInterface $trips, float $avgSpeed);
    public function setDistance(TripsInterface $trips, float $distance);
    public function setTrip(TripsInterface $trips, string $name);
    public function setMeasureInterval(TripsInterface $trips, int $measureInterval);
    public function getAvgSpeed(TripsInterface $trips): float;
    public function getDistance(TripsInterface $trips): float;
    public function getTrip(TripsInterface $trips): string;
    public function getMeasureInterval(TripsInterface $trips): int;
    public function addResultSet(ResultSetInterface $resultSet);
    public function getResultSet(): array;
}