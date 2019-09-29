<?php


namespace App\Model\Factory;

use App\Model\ResultSetInterface;

interface ResultSetFactoryInterface
{
    public function factory(): ResultSetInterface;
}