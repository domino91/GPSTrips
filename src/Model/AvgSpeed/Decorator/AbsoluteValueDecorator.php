<?php

namespace App\Model\AvgSpeed\Decorator;

use App\Model\AvgSpeed\Strategy\CalculateStrategy;
use App\Model\TripsInterface;

class AbsoluteValueDecorator implements CalculateDecorator
{
    /**
     * @var CalculateStrategy
     */
    private $calculateStrategy;

    public function __construct(CalculateStrategy $calculateStrategy)
    {
        $this->calculateStrategy = $calculateStrategy;
    }

    public function calculate(TripsInterface $trip): float
    {
        $resultCalculate = $this->calculateStrategy->calculate($trip);
        $absoluteValue = floor($resultCalculate);

        return $absoluteValue;
    }
}