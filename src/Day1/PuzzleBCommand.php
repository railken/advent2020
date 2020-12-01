<?php

namespace Railken\Advent2020\Day1;

use Eloquent\Composer\Configuration\ConfigurationReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Illuminate\Support\Collection;

class PuzzleBCommand extends Command
{
    /**
     * @var \Eloquent\Composer\Configuration\ConfigurationReader
     */
    protected $composerReader;

    /**
     * Create a new instance of the command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('day1:puzzleB')
            ->setDescription('They offer you a second one if you can find three numbers in your expense report that meet the same criteria: they need you to find the three entries that sum to 2020 and then multiply those thee numbers together.')
            ->addArgument('path', InputArgument::REQUIRED, 'The path of the input.txt files containing all records')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!file_exists($input->getArgument('path'))) {
            $output->write("<error>File doesn't exists</error>");
            return 1;
        }

        $rows = Collection::make(explode("\n", file_get_contents($input->getArgument('path'))));

        $rows = $rows->map(function ($row) {
            return intval($row);
        });

        $invertedSort = $rows->sort()->values()->toArray();

        $result = $this->getResult($invertedSort);

        if (!$result) {
            $output->write("<error>No match found</error>");
            return 1;
        }

        $output->write("<info>$result</info>");

        return 0;
    }

    protected function getResult($rows)
    {
        $length = count($rows);

        for ($x1 = 0; $x1 < $length; $x1++) {
            for ($x2 = 0; $x2 < $length; $x2++) {
                for ($x3 = 0; $x3 < $length; $x3++) {
                    if ($rows[$x1] + $rows[$x2] + $rows[$x3] === 2020) {
                        return $rows[$x1] * $rows[$x2] * $rows[$x3];
                    }
                }
            }
        }

        return null;
    }
}
