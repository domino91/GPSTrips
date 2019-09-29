<?php

namespace App\Tests\Model\AvgSpeed\Decorator;

use App\Model\TripsInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use App\Model\AvgSpeed\Decorator\AbsoluteValueDecorator;
use App\Model\AvgSpeed\Strategy\CalculateStrategy;

class AbsoluteValueDecoratorTest extends TestCase
{
    /**
     * @var AbsoluteValueDecorator
     */
    private $absoluteValueDecorator;

    /**
     * @var CalculateStrategy | MockObject
     */
    private $calculateStrategyMock;

    /**
     * @var TripsInterface | MockObject
     */
    private $tripsMock;

    /**
     * @dataProvider provider
     * @param float $calculateStrategy
     * @param int $expectedCalculate
     */
    public function testCalculate(float $calculateStrategy, int $expectedCalculate)
    {
        $this->calculateStrategyMock
            ->expects($this->once())
            ->method('calculate')
            ->willReturn($calculateStrategy);

        $resultCalculate = $this->absoluteValueDecorator->calculate($this->tripsMock);
        $this->assertEquals($expectedCalculate, $resultCalculate);
    }

    public function provider()
    {
        return [
          [1,1],
          [1.0,1],
          [2.53,2],
          [3.01,3],
          [4.99999,4],
          [-5.999,-6],
        ];
    }

    protected function setUp()
    {
        $this->calculateStrategyMock = $this->getMockBuilder(CalculateStrategy::class)->getMock();
        $this->tripsMock = $this->getMockBuilder(TripsInterface::class)->getMock();
        $this->absoluteValueDecorator = new AbsoluteValueDecorator($this->calculateStrategyMock);
        parent::setUp();
    }
}