<?php

namespace App\Model\AvgSpeed\Strategy;

use App\Model\TripMeasuresInterface;
use App\Model\TripsInterface;
use InvalidArgumentException;
use RuntimeException;

class DefaultCalculateStrategy implements CalculateStrategy
{
    const MAX_NUMBER_SKIP_TRIP = 1;

    /**
     * @inheritDoc
     */
    public function calculate(TripsInterface $trip): float
    {
        if (count($trip->getTripMeasures()) <= self::MAX_NUMBER_SKIP_TRIP) {
            return 0;
        }

        $time = $trip->getMeasureInterval();

        if ($time <= 0) {
            throw new InvalidArgumentException('The time has to be greater than zero!');
        }

        $avgSpeedArray = $this->generateAvgSpeedArray($trip, $time);
        return max($avgSpeedArray);
    }

    /**
     * @param TripsInterface $trips
     * @param int $time
     * @return array
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    private function generateAvgSpeedArray(TripsInterface $trips, int $time)
    {
        $avgSpeedArray = [];
        $lastDistance = 0;
        /** @var TripMeasuresInterface $tripMeasure */
        foreach ($trips->getTripMeasures() as $tripMeasure) {
            $distance = $tripMeasure->getDistance();

            if ($distance == 0) {
                continue;
            }
            $delta = $distance - $lastDistance;

            if ($delta <= 0) {
                 throw new InvalidArgumentException('The delta has to be greater than zero!');
             }

            $avgSpeed = (3600 * $delta) / $time;
            $avgSpeedArray[] = $avgSpeed;
            $lastDistance = $distance;
        }
        return $avgSpeedArray;
    }
}