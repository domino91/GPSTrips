<?php

namespace App\Service;

use App\Entity\Trips;
use App\Model\Builder\AvgSpeedBuilder;
use App\Model\Builder\DistanceBuilder;
use App\Model\Builder\ResultSetBuilder;
use App\Model\Builder\TripBuilder;
use App\Model\DTO\ResultDTOInterface;
use App\Model\ResultSetInterface;
use App\Model\TripsInterface;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use Psr\Log\LoggerInterface;

class ResultSetService
{
    /**
     * @var AvgSpeedBuilder
     */
    private $avgSpeedBuilder;

    /**
     * @var DistanceBuilder
     */
    private $distanceBuilder;

    /**
     * @var ResultSetBuilder
     */
    private $resultSetBuilder;

    /**
     * @var TripBuilder
     */
    private $tripBuilder;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ResultDTOInterface
     */
    private $resultDto;

    /**
     * GPSTripsResult constructor.
     *
     * @param AvgSpeedBuilder $avgSpeedBuilder
     * @param DistanceBuilder $distanceBuilder
     * @param ResultSetBuilder $resultSetBuilder
     * @param TripBuilder $tripBuilder
     * @param EntityManagerInterface $entityManager
     * @param LoggerInterface $logger
     * @param ResultDTOInterface $resultDto
     */
    public function __construct(
        AvgSpeedBuilder $avgSpeedBuilder,
        DistanceBuilder $distanceBuilder,
        ResultSetBuilder $resultSetBuilder,
        TripBuilder $tripBuilder,
        EntityManagerInterface $entityManager,
        LoggerInterface $logger,
        ResultDTOInterface $resultDto
    ) {
        $this->avgSpeedBuilder = $avgSpeedBuilder;
        $this->distanceBuilder = $distanceBuilder;
        $this->resultSetBuilder = $resultSetBuilder;
        $this->tripBuilder = $tripBuilder;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
        $this->resultDto = $resultDto;
    }


    /**
     * @return ResultSetInterface[]
     */
    public function prepareResult()
    {
        $tripsCollection = $this->fetchTrips();

        /** @var TripsInterface $trip */
        foreach ($tripsCollection as $trip) {
            try {
                $this->tripBuilder->setResultDTO($this->resultDto);
                $this->tripBuilder->build($trip);

                $this->distanceBuilder->setResultDTO($this->resultDto);
                $this->distanceBuilder->build($trip);

                $this->avgSpeedBuilder->setResultDTO($this->resultDto);
                $this->avgSpeedBuilder->build($trip);

                $this->resultSetBuilder->setResultDTO($this->resultDto);
                $this->resultSetBuilder->build($trip);
            } catch (InvalidArgumentException $ex) {
                $this->logger->error($ex->getMessage());
            }
        }

        return $this->resultDto->getResultSet();
    }

    private function fetchTrips()
    {
        $tripsRepository = $this->entityManager->getRepository(Trips::class);
        return $tripsRepository->findAll();
    }
}