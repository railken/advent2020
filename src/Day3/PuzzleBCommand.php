<?php

namespace Railken\Advent2020\Day3;

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
            ->setName('day3:puzzleB')
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

        $result = $this->getResult($rows);

        if (!$result) {
            $output->write("<error>No match found</error>");
            return 1;
        }

        $output->write("<info>$result</info>");

        return 0;
    }

    public function getIndex($i, $max)
    {
        return $i % $max;
    }

    public function getResult($rows)
    {
        $options = collect([
            [1,1],
            [3,1],
            [5,1],
            [7,1],
            [1,2]
        ]);
        
        return $options->map(function($opt) use ($rows) {
            return $this->calculate($rows, $opt[0], $opt[1]);
        })->reduce(function ($carry, $item) {
            return $carry * $item;
        }, 1);
    }

    public function calculate($rows, $x, $y)
    {

        $col = 0; 
        $n = 0;
        for ($row = 0; $row < count($rows); $row+=$y) {

            $s = $rows[$row];

            if (!empty($s)) {
                $index = $this->getIndex($col, strlen($s));

                if ($s[$index] === '#') {
                    $n++;
                }

                $col += $x;
            }

        }

        return $n;
    }
}
