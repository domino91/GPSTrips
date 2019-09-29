<?php

namespace App\Model\Builder;

use App\Model\AvgSpeed\Strategy\CalculateStrategy;
use App\Model\TripsInterface;

/**
 * Class AvgSpeedBuilder
 * @codeCoverageIgnore
 * @package App\Model\Builder
 */
class AvgSpeedBuilder extends AbstractBuilder
{
    /**
     * @var CalculateStrategy
     */
    private $calculateStrategy;

    /**
     * AvgSpeedBuilder constructor.
     * @param CalculateStrategy $calculateStrategy
     */
    public function __construct(CalculateStrategy $calculateStrategy)
    {
        $this->calculateStrategy = $calculateStrategy;
    }

    public function build(TripsInterface $trip)
    {
        $avgSpeedResult = $this->calculateStrategy->calculate($trip);
        $this->resultDTO->setAvgSpeed($trip, $avgSpeedResult);
    }
}