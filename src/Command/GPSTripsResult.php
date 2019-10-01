<?php

namespace App\Command;

use App\Service\ResultSetService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use const STR_PAD_LEFT;
use const STR_PAD_RIGHT;

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
        $table = new Table($output);
        $tableStyle = new TableStyle();
        $tableStyle->setPadType(STR_PAD_LEFT);
        $table->setStyle($tableStyle);

        $table
            ->setHeaders(['trip', 'distance', 'measure interval', 'avg speed'])
            ->setRows($this->printRows());
        $table->render();
    }

    private function printRows()
    {
        $resultSetCollection = $this->resultSetService->prepareResult();
        $rows = [];
        foreach ($resultSetCollection as $resultSet) {
            $rows[] = [
                $resultSet->getTrip(),
                $resultSet->getDistance(),
                $resultSet->getMeasureInterval(),
                $resultSet->getAvgSpeed(),
            ];
        }
        return $rows;
    }
}