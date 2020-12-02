<?php

namespace Railken\Advent2020\Day2;

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
            ->setName('day2:puzzleA')
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
            preg_match_all("/^([\d]*)-([\d]*) ([\w]{1})\: ([\w]*)$/", $row, $result);


            return isset($result[0][0]) ? [intval($result[1][0]), intval($result[2][0]), $result[3][0], $result[4][0]] : null;
        })->filter(function ($i) {
            return isset($i[0]);
        });

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
        // 0 min
        // 1 max
        // 2 char
        // 3 string

        return $rows->filter(function ($row) {

            $count = substr_count($row[3], $row[2]);
            return $count >= $row[0] && $count <= $row[1];
        })->count();
    }
}
