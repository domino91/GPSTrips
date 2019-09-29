<?php

namespace App\Command;

use App\Service\ResultSetService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GPSTripsResult extends Command
{

    protected static $defaultName = 'app:gpsTrips-result';

    /**
     * @var ResultSetService
     */
    private $resultSetService;

    public function __construct(ResultSetService $resultSetService)
    {
        parent::__construct();
        $this->resultSetService = $resultSetService;
    }


    protected function configure()
    {
        $this
            ->setDescription('Render result from GPSTrips')
            ->setHelp('This command allows you display result from GPSTrips');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->printHeaders($output);
        $this->printRows($output);
    }

    private function printHeaders(OutputInterface $output)
    {
        $output->writeln('+--------+----------+------------------+-----------+!');
        $output->writeln('| trip   | distance | measure interval | avg speed  |');
        $output->writeln('+--------+----------+------------------+-----------+!');
    }

    private function printRows(OutputInterface $output)
    {
        $resultSetCollection = $this->resultSetService->prepareResult();
        foreach ($resultSetCollection as $resultSet) {
            $output->writeln
            (
                sprintf
                (
                    '| %s |     %s |               %s |         %s |',
                    $resultSet->getTrip(),
                    $resultSet->getDistance(),
                    $resultSet->getMeasureInterval(),
                    $resultSet->getAvgSpeed()
                )
            );
            $output->writeln('+--------+----------+------------------+-----------+!');
        }
    }
}