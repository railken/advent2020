<?php

namespace Railken\Advent2020\Day4;

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
            ->setName('day4:puzzleA')
            ->addArgument('path', InputArgument::REQUIRED, 'The path of the input.txt files containing all records')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!file_exists($input->getArgument('path'))) {
            $output->write("<error>File doesn't exists</error>");
            return 1;
        }

        $rows = Collection::make(preg_split("/(\r\n|\r|\n)(\r\n|\r|\n)/", file_get_contents($input->getArgument('path'))));


        $rows = $rows->map(function($i) {
            return preg_split("/(\r\n|\r|\n| )/", $i);
        });


        $rows = $rows->map(function($i) {
            return collect($i)->filter(function($r) {
                return !empty($r);
            })->mapWithKeys(function ($r) {

                [$key, $value] = explode(":", $r);

                return [$key => $value];
            });
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
        $required = ['ecl', 'pid', 'eyr', 'hcl', 'byr', 'iyr', 'hgt'];
        return $rows->filter(function ($row) use ($required) {
            return $row->has($required);
        })->count();
    }
}
