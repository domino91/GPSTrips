<?php

namespace App\Model\AvgSpeed\Decorator;

use App\Model\AvgSpeed\Strategy\CalculateStrategy;

interface CalculateDecorator extends CalculateStrategy
{
    public function __construct(CalculateStrategy $calculateStrategy);
}