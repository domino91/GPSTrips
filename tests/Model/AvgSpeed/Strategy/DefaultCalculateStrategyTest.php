<?php

namespace App\Tests\Model\AvgSpeed\Strategy;

use App\Model\AvgSpeed\Strategy\CalculateStrategy;
use Doctrine\Common\Collections\Collection;
use App\Model\AvgSpeed\Strategy\DefaultCalculateStrategy;
use App\Model\TripMeasuresInterface;
use App\Model\TripsInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DefaultCalculateStrategyTest extends TestCase
{
    /**
     * @var DefaultCalculateStrategy
     */
    private $defaultCalculateStrategy;

    /**
     * @var Collection | MockObject
     */
    private $collectionMock;

    /**
     * @var TripMeasuresInterface | MockObject
     */
    private $tripMeasuresMock;

    /**
     * @var TripsInterface | MockObject
     */
    private $tripsMock;

    /**
     * @param float $calculateStrategy
     * @param int $expectedCalculate
     */
    public function testCalculateNoTripMeasures()
    {
        $maxNumberSkipTrip = 1;
        $this->tripsMock
            ->expects($this->once())
            ->method('getTripMeasures')
            ->willReturn($this->collectionMock);
        $this->collectionMock
            ->expects($this->once())
            ->method('count')
            ->willReturn($maxNumberSkipTrip);
        $this->tripsMock
            ->expects($this->never())
            ->method('getMeasureInterval');

        $resultCalculate = $this->defaultCalculateStrategy->calculate($this->tripsMock);
        $this->assertEquals(0, $resultCalculate);
        $this->assertEquals($maxNumberSkipTrip, DefaultCalculateStrategy::MAX_NUMBER_SKIP_TRIP);
    }

    public function testCalculate()
    {
        $expectedCalculate = 74.4;
        $items = $this->prepareTripMeasuresMock();
        $this->tripsMock
            ->expects($this->exactly(2))
            ->method('getTripMeasures')
            ->willReturn($this->collectionMock);
        $this->collectionMock
            ->expects($this->once())
            ->method('count')
            ->willReturn(10);
        $this->collectionMock
            ->expects($this->once())
            ->method('getIterator')
            ->willReturn(new \ArrayObject($items));
        $this->tripsMock
            ->expects($this->once())
            ->method('getMeasureInterval')
            ->willReturn(15);

        $resultCalculate = $this->defaultCalculateStrategy->calculate($this->tripsMock);
        $this->assertEquals($expectedCalculate, $resultCalculate);
    }

    private function prepareTripMeasuresMock()
    {
        $values = [
          0.0,
          0.19,
          0.5,
          0.75,
          1.0,
          1.25,
          1.5,
          1.75,
          2.0,
          2.25
        ];

        $i = 0;
        $items = [];
        foreach ($values as $value) {
            $this->tripMeasuresMock
                ->expects($this->at($i++))
                ->method('getDistance')
                ->willReturn($value);
            $items[] = $this->tripMeasuresMock;
        }

        return $items;
    }

    protected function setUp()
    {
        $this->tripMeasuresMock = $this->getMockBuilder(TripMeasuresInterface::class)->getMock();
        $this->tripsMock = $this->getMockBuilder(TripsInterface::class)->getMock();
        $this->collectionMock = $this->getMockBuilder(Collection::class)->getMock();
        $this->defaultCalculateStrategy = new DefaultCalculateStrategy();
        parent::setUp();
    }
}