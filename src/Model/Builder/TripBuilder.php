<?php

namespace App\Model\Builder;

use App\Model\TripsInterface;
use InvalidArgumentException;

/**
 * Class TripBuilder
 * @codeCoverageIgnore
 * @package App\Model\Builder
 */
class TripBuilder extends AbstractBuilder
{

    /**
     * @param TripsInterface $trip
     * @return mixed
     * @throws InvalidArgumentException
     */
    function build(TripsInterface $trip)
    {
        $tripName = $trip->getName();
        $measureInterval = $trip->getMeasureInterval();

        $this->resultDTO->setTrip($trip, $tripName);
        $this->resultDTO->setMeasureInterval($trip, $measureInterval);
    }
}