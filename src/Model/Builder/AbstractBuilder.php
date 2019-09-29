<?php

namespace App\Model\Builder;

use App\Model\DTO\ResultDTOInterface;
use App\Model\TripsInterface;
use InvalidArgumentException;

abstract class AbstractBuilder
{
    /**
     * @var ResultDTOInterface
     */
    protected $resultDTO;

    /**
     * @param ResultDTOInterface $resultDTO
     */
    public function setResultDTO(ResultDTOInterface $resultDTO): void
    {
        $this->resultDTO = $resultDTO;
    }

    /**
     * @param TripsInterface $trip
     * @return mixed
     * @throws InvalidArgumentException
     */
    abstract function build(TripsInterface $trip);
}