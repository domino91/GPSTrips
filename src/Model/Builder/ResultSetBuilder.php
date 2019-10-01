<?php


namespace App\Model\Builder;

use App\Model\TripsInterface;
use App\Model\Factory\ResultSetFactory;
use InvalidArgumentException;

/**
 * Class ResultSetBuilder
 * @codeCoverageIgnore
 * @package App\Model\Builder
 */
class ResultSetBuilder extends AbstractBuilder
{

    /**
     * @var ResultSetFactory
     */
    private $resultSetFactory;

    /**
     * ResultSetBuilder constructor.
     * @param ResultSetFactory $resultSetFactory
     */
    public function __construct(ResultSetFactory $resultSetFactory)
    {
        $this->resultSetFactory = $resultSetFactory;
    }

    /**
     * @param TripsInterface $trip
     * @return mixed
     * @throws InvalidArgumentException
     */
    function build(TripsInterface $trip)
    {
        $tripName = $this->resultDTO->getTrip($trip);
        $distance = $this->resultDTO->getDistance($trip);
        $measureInterval = $this->resultDTO->getMeasureInterval($trip);
        $avgSpeed = $this->resultDTO->getAvgSpeed($trip);

        $resultSet = $this->resultSetFactory->create();
        $resultSet->setTrip($tripName);
        $resultSet->setDistance($distance);
        $resultSet->setMeasureInterval($measureInterval);
        $resultSet->setAvgSpeed($avgSpeed);

        $this->resultDTO->addResultSet($resultSet);

    }
}