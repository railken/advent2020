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

class PuzzleACommand extends Command
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
            ->setName('day1:puzzleA')
            ->setDescription('Specifically, they need you to find the two entries that sum to 2020 and then multiply those two numbers together.')
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

        $result = $this->getResult($rows);

        if (!$result) {
            $output->write("<error>No match found</error>");
            return 1;
        }

        $output->write("<info>$result</info>");

        return 0;
    }

    public function getResult($rows)
    {
        foreach ($rows as $row1) {
            foreach ($rows as $row2) {
                if ($row1 + $row2 === 2020) {
                    return $row1*$row2;
                }
            }
        }

    }
}
