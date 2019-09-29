<?php

namespace App\Tests\Model\Builder;

use App\Model\Builder\DistanceBuilder;
use App\Model\DTO\ResultDTOInterface;
use App\Model\TripMeasuresInterface;
use App\Model\TripsInterface;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DistanceBuilderTest extends TestCase
{
    /**
     * @var DistanceBuilder
     */
    private $distanceBuilder;

    /**
     * @var ResultDTOInterface | MockObject
     */
    private $resultDtoMock;

    /**
     * @var TripsInterface | MockObject
     */
    private $tripsMock;

    /**
     * @var Collection | MockObject
     */
    private $collectionMock;

    /**
     * @var TripMeasuresInterface | MockObject
     */
    private $tripMeasuresMock;

    public function testBuild()
    {
        $expectedDistance = 0.5;

        $this->resultDtoMock
            ->expects($this->once())
            ->method('setDistance')
            ->with($this->tripsMock, $expectedDistance);
        $this->tripMeasuresMock
            ->expects($this->once())
            ->method('getDistance')
            ->willReturn($expectedDistance);
        $this->tripsMock
            ->expects($this->once())
            ->method('getTripMeasures')
            ->willReturn($this->collectionMock);
        $this->collectionMock
            ->expects($this->once())
            ->method('count')
            ->willReturn(1);
        $this->collectionMock
            ->expects($this->once())
            ->method('last')
            ->willReturn($this->tripMeasuresMock);

        $this->distanceBuilder->build($this->tripsMock);
    }


    protected function setUp()
    {
        $this->resultDtoMock = $this->getMockBuilder(ResultDTOInterface::class)->getMock();
        $this->tripsMock = $this->getMockBuilder(TripsInterface::class)->getMock();
        $this->collectionMock = $this->getMockBuilder(Collection::class)->getMock();
        $this->tripMeasuresMock = $this->getMockBuilder(TripMeasuresInterface::class)->getMock();
        $this->distanceBuilder = new DistanceBuilder();
        $this->distanceBuilder->setResultDTO($this->resultDtoMock);

        parent::setUp();
    }
}