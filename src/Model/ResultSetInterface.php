<?php

namespace App\Model;

interface ResultSetInterface
{
    function getTrip(): string;
    function getDistance(): float;
    function getMeasureInterval(): int;
    function getAvgSpeed(): float;
    function setTrip(string $tripName);
    function setDistance(float $distance);
    function setMeasureInterval(int $measureInterval);
    function setAvgSpeed(float $avgSpeed );
}