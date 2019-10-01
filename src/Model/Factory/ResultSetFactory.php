<?php


namespace App\Model\Factory;

use App\Model\ResultSet;
use App\Model\ResultSetInterface;

/**
 * Class ResultSetFactory
 * @codeCoverageIgnore
 * @package App\Model\Factory
 */
class ResultSetFactory
{
    public function create(): ResultSetInterface
    {
        return new ResultSet();
    }
}