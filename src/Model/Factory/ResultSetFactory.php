<?php


namespace App\Model\Factory;

use App\Model\ResultSet;
use App\Model\ResultSetInterface;

/**
 * Class ResultSetFactory
 * @codeCoverageIgnore
 * @package App\Model\Factory
 */
class ResultSetFactory implements ResultSetFactoryInterface
{
    public function factory(): ResultSetInterface
    {
        return new ResultSet();
    }
}