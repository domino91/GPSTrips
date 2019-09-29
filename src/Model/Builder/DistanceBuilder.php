<?php

namespace App\Model\Builder;

use App\Model\TripsInterface;
use InvalidArgumentException;

class DistanceBuilder extends AbstractBuilder
{

    /**
     * @param TripInterface $trip
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function build(TripsInterface $trip)
    {
        $distance = $this->getDistance($trip);
        $this->resultDTO->setDistance($trip, $distance);
    }

    private function getDistance(TripsInterface $trip)
    {
        $tripMeasuresCollection = $trip->getTripMeasures();

        if (!count($tripMeasuresCollection)) {
            return 0;
        }

        $tripMeasures = $tripMeasuresCollection->last();
        return $tripMeasures->getDistance();
    }
}