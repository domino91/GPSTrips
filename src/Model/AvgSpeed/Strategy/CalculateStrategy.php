<?php

namespace App\Model\AvgSpeed\Strategy;

use App\Model\TripsInterface;
use InvalidArgumentException;
use RuntimeException;

interface CalculateStrategy
{
    /**
     * @param TripsInterface $trip
     * @return float
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function calculate(TripsInterface $trip): float;
}