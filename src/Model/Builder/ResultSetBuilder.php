<?php


namespace App\Model\Builder;

use App\Model\Factory\ResultSetFactoryInterface;
use App\Model\TripsInterface;
use InvalidArgumentException;

/**
 * Class ResultSetBuilder
 * @codeCoverageIgnore
 * @package App\Model\Builder
 */
class ResultSetBuilder extends AbstractBuilder
{

    /**
     * @var ResultSetFactoryInterface
     */
    private $resultSetFactory;

    /**
     * ResultSetBuilder constructor.
     * @param ResultSetFactoryInterface $resultSetFactory
     */
    public function __construct(ResultSetFactoryInterface $resultSetFactory)
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

        $resultSet = $this->resultSetFactory->factory();
        $resultSet->setTrip($tripName);
        $resultSet->setDistance($distance);
        $resultSet->setMeasureInterval($measureInterval);
        $resultSet->setAvgSpeed($avgSpeed);

        $this->resultDTO->addResultSet($resultSet);

    }
}